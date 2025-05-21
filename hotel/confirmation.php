<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) header("Location: login.php");
$cn = $_GET['cn'];
$stmt = $pdo->prepare("SELECT r.*, rm.room_number, rm.room_type FROM reservations r
                      JOIN rooms rm ON r.room_id = rm.id
                      WHERE confirmation_number = ?");
$stmt->execute([$cn]);
$res = $stmt->fetch();
include 'header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg">
            <div class="card-body p-5 text-center">
                <div class="icon-circle bg-success mb-4">
                    <i class="fas fa-check fa-2x text-white"></i>
                </div>
                <h1 class="text-success mb-3">Booking Confirmed!</h1>
                
                <div class="confirmation-details text-start">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5><i class="fas fa-hashtag me-2"></i>Confirmation Number</h5>
                            <p class="fs-5"><?= $res['confirmation_number'] ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-door-open me-2"></i>Room Details</h5>
                            <p class="fs-5"><?= $res['room_number'] ?> (<?= $res['room_type'] ?>)</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-calendar-check me-2"></i>Check-in</h5>
                            <p class="fs-5"><?= date('M j, Y', strtotime($res['check_in'])) ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-calendar-times me-2"></i>Check-out</h5>
                            <p class="fs-5"><?= date('M j, Y', strtotime($res['check_out'])) ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-5">
                    <a href="my_bookings.php" class="btn btn-outline-primary me-3">
                        <i class="fas fa-list me-2"></i>My Bookings
                    </a>
                    <a href="index.php" class="btn btn-custom">
                        <i class="fas fa-home me-2"></i>Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
