<?php
// Database connection
// include('includes/dbconn.php');
session_start();
include 'myclass/connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $_GET['id'] <= 0) {
    echo "Invalid PG ID.";
    exit;
}

$pg_id = intval($_GET['id']);

// Fetch PG details
$query = $connection->prepare("SELECT * FROM tbl_pgmaster WHERE pg_id = ?");
$query->bind_param("i", $pg_id);
$query->execute();
$result = $query->get_result();
$pg = $result->fetch_assoc();

if (!$pg) {
    echo "PG not found.";
    exit;
}



// Update on form submission
if (isset($_POST['update'])) {
    $pg_name = $_POST['pg_name'];
    $pg_type = $_POST['pg_type'];
    $location = $_POST['location'];
    $city = $_POST['city'];
    $price = $_POST['price'];
    $amenities = $_POST['amenities'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $update = $connection->prepare("UPDATE tbl_pgmaster SET pg_name=?, pg_type=?, location=?, city=?, price=?, amenities=?, description=?, status=?, updated_at=NOW() WHERE pg_id=?");
    $update->bind_param("ssssssssi", $pg_name, $pg_type, $location, $city, $price, $amenities, $description, $status, $pg_id);

    if ($update->execute()) {
        $success = "PG details updated successfully!";
    } else {
        $error = "Failed to update PG: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit PG Master</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit PG Details</h2>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="pg_name" class="form-label">PG Name</label>
            <input type="text" class="form-control" id="pg_name" name="pg_name" value="<?= htmlspecialchars($pg['pg_name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="pg_type" class="form-label">PG Type</label>
            <select name="pg_type" id="pg_type" class="form-control" required>
                <option value="Boys" <?= $pg['pg_type'] == 'Boys' ? 'selected' : '' ?>>Boys</option>
                <option value="Girls" <?= $pg['pg_type'] == 'Girls' ? 'selected' : '' ?>>Girls</option>
                <option value="Co-ed" <?= $pg['pg_type'] == 'Co-ed' ? 'selected' : '' ?>>Co-ed</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" name="location" id="location" value="<?= htmlspecialchars($pg['location']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" name="city" id="city" value="<?= htmlspecialchars($pg['city']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Monthly Price</label>
            <input type="number" step="0.01" class="form-control" name="price" id="price" value="<?= htmlspecialchars($pg['price']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="amenities" class="form-label">Amenities (comma separated)</label>
            <textarea class="form-control" name="amenities" id="amenities"><?= htmlspecialchars($pg['amenities']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description"><?= htmlspecialchars($pg['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Active" <?= $pg['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                <option value="Inactive" <?= $pg['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update PG</button>
    </form>
</div>
</body>
</html>
