<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) header("Location: login.php");
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT r.*, rm.room_number, rm.room_type, rm.price 
                      FROM reservations r
                      JOIN rooms rm ON r.room_id = rm.id
                      WHERE user_id = ?
                      ORDER BY check_in DESC");
$stmt->execute([$user_id]);
$bookings = $stmt->fetchAll();
include 'header.php';
?>

<div class="row">
    <?php if(empty($bookings)): ?>
        <div class="col-12">
            <div class="alert alert-info">
                <h4 class="alert-heading">No bookings found!</h4>
                <p>Start by <a href="index.php" class="alert-link">exploring our rooms</a></p>
            </div>
        </div>
    <?php else: ?>
        <?php foreach($bookings as $b): ?>
        <div class="col-md-6 mb-4">
            <div class="card booking-card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="card-title"><?= $b['room_type'] ?> Room <?= $b['room_number'] ?></h5>
                            <small class="text-muted"><?= $b['confirmation_number'] ?></small>
                        </div>
                        <span class="badge bg-<?= strtotime($b['check_out']) > time() ? 'success' : 'secondary' ?>">
                            <?= strtotime($b['check_out']) > time() ? 'Upcoming' : 'Completed' ?>
                        </span>
                    </div>
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="booking-detail">
                                <i class="fas fa-calendar-check me-2"></i>
                                <?= date('M j, Y', strtotime($b['check_in'])) ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="booking-detail">
                                <i class="fas fa-calendar-times me-2"></i>
                                <?= date('M j, Y', strtotime($b['check_out'])) ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="text-primary">$<?= number_format($b['price'] * 
                                date_diff(date_create($b['check_in']), date_create($b['check_out']))->days, 2) ?>
                            </h4>
                        </div>
                        <div>
                            <a href="confirmation.php?cn=<?= $b['confirmation_number'] ?>" 
                               class="btn btn-sm btn-outline-primary me-2">
                                <i class="fas fa-eye"></i>
                            </a>
                            <?php if(strtotime($b['check_out']) > time()): ?>
                            <button onclick="confirmCancel('<?= $b['confirmation_number'] ?>')" 
                                    class="btn btn-sm btn-danger">
                                <i class="fas fa-times"></i>
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
