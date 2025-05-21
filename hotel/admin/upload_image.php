<?php
include '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['username'] !== 'admin') {
    die("Access denied");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_id = $_POST['room_id'];
    
    // File upload handling
    $target_dir = "../assets/images/rooms/";
    $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $new_filename = "room-$room_id-" . uniqid() . ".$file_extension";
    $target_file = $target_dir . $new_filename;

    // Validate image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if(!$check) die("File is not an image");
    if ($_FILES["image"]["size"] > 5000000) die("File too large (>5MB)");
    if(!in_array($file_extension, ['jpg','jpeg','png','gif'])) die("Invalid format");

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Update database
        $stmt = $pdo->prepare("UPDATE rooms SET image_url = ? WHERE id = ?");
        $stmt->execute([$new_filename, $room_id]);
        header("Location: ../index.php");
    } else {
        echo "Error uploading file";
    }
}
