<?php
include 'dbconfig.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // // Проверка дали е зададено ID на потребител
    $user_sql = "SELECT * FROM users WHERE id = '$user_id'";
    $user_result = mysqli_query($conn, $user_sql);
    $user = mysqli_fetch_assoc($user_result);
}

if (isset($_POST['submit'])) {
    // Обновяване на данни за потребителя
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $role = $_POST['role'];


    $update_sql = "UPDATE users SET name = '$name', email = '$email', phone_number = '$phone_number', role = '$role' WHERE id = '$user_id'";
    if (mysqli_query($conn, $update_sql)) {
        header('Location: index.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<?php include("gdpr.php"); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['gdpr_consent'])) {
        setcookie('gdpr_consent', '1', time() + 3600 * 24 * 365); // Създаване на бисквитка за съгласие на GDPR
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include("mini-header.php"); ?>
    <?php include('navigation.php'); ?>

    <div style="position: relative; width: 100%; padding: 50px 0;">
        <div class="container">
            <h2>Редактиране на потребител</h2>
            <hr>
            <form method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Име на потребителя</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Имейл</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?php echo $user['email']; ?>">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Телефонен номер</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                        value="<?php echo $user['phone_number']; ?>">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role">
                        <option value="User" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                        <option value="Admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Запази промените</button>
            </form>
        </div>
    </div>

    <?php include("footer.php"); ?>
    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>