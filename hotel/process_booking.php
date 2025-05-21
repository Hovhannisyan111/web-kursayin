<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $data = [
        'room_id' => $_POST['room_id'],
        'check_in' => $_POST['check_in'],
        'check_out' => $_POST['check_out'],
        'cn' => uniqid()
    ];

    try {
        $pdo->beginTransaction();
        
        // Check room availability
        $stmt = $pdo->prepare("SELECT status FROM rooms WHERE id = ? FOR UPDATE");
        $stmt->execute([$data['room_id']]);
        $room = $stmt->fetch();
        
        if ($room['status'] !== 'available') {
            throw new Exception("Room is no longer available");
        }

        // Create reservation
        $stmt = $pdo->prepare("INSERT INTO reservations (user_id, room_id, check_in, check_out, confirmation_number)
                              VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $data['room_id'], $data['check_in'], $data['check_out'], $data['cn']]);

        // Update room status
        $pdo->prepare("UPDATE rooms SET status = 'booked' WHERE id = ?")->execute([$data['room_id']]);

        $pdo->commit();
        header("Location: confirmation.php?cn=" . $data['cn']);
        exit();
        
    } catch (Exception $e) {
        $pdo->rollBack();
        die("Booking failed: " . $e->getMessage());
    }
}
?>
