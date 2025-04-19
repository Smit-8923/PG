<?php
session_start();
include 'myclass/connection.php';

$id = $_GET['id'] ?? $_POST['pg_id'] ?? null;

if (!$id) {
    echo "<script>alert('Invalid ID'); window.location='pgmaster_table.php';</script>";
    exit;
}

$q = mysqli_query($connection, "SELECT * FROM tbl_pgmaster WHERE pg_id = '{$id}'") or die(mysqli_error($connection));
$row = mysqli_fetch_array($q);

if (isset($_POST['btn'])) {
    $pg_name = $_POST['pg_name'];
    $pg_details = $_POST['pg_details'];
    $pg_areaid = $_POST['pg_areaid'];
    $pg_address = $_POST['pg_address'];
    $pg_amount = $_POST['pg_amount'];
    $category_id = $_POST['category_id'];
    $owner_id = $_POST['owner_id'];

    if ($_FILES['pg_photos']['name'] != "") {
        $pg_photos = $_FILES['pg_photos']['name'];
        $filepath = $_FILES['pg_photos']['tmp_name'];
        move_uploaded_file($filepath, "uploads/" . $pg_photos);

        $updateQuery = "UPDATE tbl_pgmaster SET 
            pg_name='{$pg_name}', 
            pg_details='{$pg_details}', 
            pg_areaid='{$pg_areaid}', 
            pg_address='{$pg_address}', 
            pg_photos='{$pg_photos}', 
            pg_amount='{$pg_amount}', 
            category_id='{$category_id}', 
            owner_id='{$owner_id}' 
            WHERE pg_id='{$id}'";
    } else {
        $updateQuery = "UPDATE tbl_pgmaster SET 
            pg_name='{$pg_name}', 
            pg_details='{$pg_details}', 
            pg_areaid='{$pg_areaid}', 
            pg_address='{$pg_address}', 
            pg_amount='{$pg_amount}', 
            category_id='{$category_id}', 
            owner_id='{$owner_id}' 
            WHERE pg_id='{$id}'";
    }

    if (mysqli_query($connection, $updateQuery)) {
        echo "<script>alert('Record Updated Successfully'); window.location = 'pgmaster_table.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit PG Master</title>
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet">
    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
</head>

<body class="animastistion">

    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <?php
            include('./themepart/sidebar.php');
        ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php
                include('./themepart/header.php');
            ?>
            <!-- END HEADER DESKTOP-->
            <div class="container mt-5">
                <h2>Edit PG Master</h2>
                <form method="post" enctype="multipart/form-data" action="edit-package-master.php?id=<?= $id ?>">
                <input type="hidden" name="pg_id" value="<?= $id ?>">
                    <div class="form-group">
                        <label>PG Name</label>
                        <input type="text" name="pg_name" class="form-control" value="<?= $row['pg_name'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>PG Details</label>
                        <textarea name="pg_details" id="editor" class="form-control"><?= $row['pg_details'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>PG Area ID</label>
                        <input type="text" name="pg_areaid" class="form-control" value="<?= $row['pg_areaid'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>PG Address</label>
                        <input type="text" name="pg_address" class="form-control" value="<?= $row['pg_address'] ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label>PG Amount</label>
                        <input type="text" name="pg_amount" class="form-control" value="<?= $row['pg_amount'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control" required>
                            <?php
                    $q = mysqli_query($connection, "SELECT * FROM tbl_category");
                    while ($cat = mysqli_fetch_array($q)) {
                        $selected = ($cat['category_id'] == $row['category_id']) ? 'selected' : '';
                        echo "<option value='{$cat['category_id']}' $selected>{$cat['category_name']}</option>";
                    }
                    ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Owner</label>
                        <select name="owner_id" class="form-control" required>
                            <?php
                    $q = mysqli_query($connection, "SELECT * FROM tbl_owner");
                    while ($owner = mysqli_fetch_array($q)) {
                        $selected = ($owner['owner_id'] == $row['owner_id']) ? 'selected' : '';
                        echo "<option value='{$owner['owner_id']}' $selected>{$owner['owner_name']}</option>";
                    }
                    ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Existing Photo:</label><br>
                        <img src="uploads/<?= $row['pg_photos'] ?>" width="150"><br><br>
                        <label>Upload New Photo (Optional)</label>
                        <input type="file" name="pg_photos" class="form-control">
                    </div>
                    <button type="submit" name="btn" class="btn btn-primary">Update</button>
                    <a href="pgmaster_table.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor')).catch(error => {
            console.error(error);
        });
    </script>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

</body>

</html>