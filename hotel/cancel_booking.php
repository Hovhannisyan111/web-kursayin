<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "You must be logged in to cancel bookings";
    header("Location: login.php");
    exit();
}

if (isset($_GET['cn'])) {
    try {
        $pdo->beginTransaction();
        
        $stmt = $pdo->prepare("SELECT r.id, r.room_id FROM reservations r
                              WHERE confirmation_number = ? AND user_id = ?");
        $stmt->execute([$_GET['cn'], $_SESSION['user_id']]);
        $reservation = $stmt->fetch();
        
        if ($reservation) {
            $pdo->prepare("DELETE FROM reservations WHERE id = ?")->execute([$reservation['id']]);
            $pdo->prepare("UPDATE rooms SET status = 'available' WHERE id = ?")->execute([$reservation['room_id']]);
            $pdo->commit();
            $_SESSION['success'] = "Booking cancelled successfully";
        } else {
            $_SESSION['error'] = "Booking not found";
        }
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = "Error cancelling booking: " . $e->getMessage();
    }
}

header("Location: my_bookings.php");
exit();
?>
