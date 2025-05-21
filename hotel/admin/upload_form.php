<?php include '../header.php'; ?>

<div class="container mt-5">
    <h2>Upload Room Image</h2>
    <form action="upload_image.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Room ID</label>
            <input type="number" name="room_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Select Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-custom">Upload Image</button>
    </form>
</div>

<?php include '../footer.php'; ?>
