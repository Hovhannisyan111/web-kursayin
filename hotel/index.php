<?php include 'config.php'; ?>
<?php include 'header.php'; ?>

<div class="container content-padding">
    <h2 class="text-center mb-5 display-5 fw-medium">Our Rooms & Suites</h2>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php
        // Function to return image path based on room type
        function getRoomImage($type) {
            $images = [
                'Standard'     => 'images/rooms/standard.jpg',
                'Deluxe'       => 'images/rooms/deluxe.jpg',
                'Suite'        => 'images/rooms/suite.jpg',
                'Economy'      => 'images/rooms/economy.jpg',
                'Presidential' => 'images/rooms/presidential.jpg',
                'King'         => 'images/rooms/king.jpg'
            ];

            // Return the image path if exists, otherwise use a fallback
            return $images[$type] ?? 'images/rooms/default.jpeg';
        }

        $stmt = $pdo->query("SELECT * FROM rooms WHERE status = 'available'");
        while ($room = $stmt->fetch()):
        ?>
        <div class="col">
            <div class="card h-100 room-card shadow">
                <img src="<?= getRoomImage($room['room_type']) ?>" 
                     class="card-img-top" 
                     alt="Room image" 
                     style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title">Room <?= $room['room_number'] ?></h5>
                            <span class="badge bg-primary"><?= $room['room_type'] ?></span>
                        </div>
                        <div class="text-end">
                            <div class="h4 text-primary">$<?= $room['price'] ?></div>
                            <small class="text-muted">per night</small>
                        </div>
                    </div>
                    <ul class="list-unstyled mt-3">
                        <li><i class="fas fa-wifi text-primary me-2"></i>Free WiFi</li>
                        <li><i class="fas fa-tv text-primary me-2"></i>Smart TV</li>
                        <li><i class="fas fa-bed text-primary me-2"></i>King Bed</li>
                    </ul>
                </div>
                <?php if(isset($_SESSION['user_id'])): ?>
                <div class="card-footer bg-transparent">
                    <a href="book.php?room_id=<?= $room['id'] ?>" class="btn btn-custom w-100">
                        <i class="fas fa-calendar-check me-2"></i>Book Now
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'footer.php'; ?>

