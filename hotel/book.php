<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) header("Location: login.php");
$room_id = $_GET['room_id'];
$stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->execute([$room_id]);
$room = $stmt->fetch();
include 'header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body p-4">
                <h2 class="mb-4">Book Room <?= $room['room_number'] ?></h2>
                <form action="process_booking.php" method="post">
                    <input type="hidden" name="room_id" value="<?= $room_id ?>">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Check-in Date</label>
                            <input type="date" name="check_in" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Check-out Date</label>
                            <input type="date" name="check_out" class="form-control" required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-custom w-100">Confirm Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
