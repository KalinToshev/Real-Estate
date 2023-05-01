<?php
include 'dbconfig.php';
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
    <title>Real Estate Web App - Home</title>
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
    <?php
    include('navigation.php');
    ?>
    <?php
    // Fetch users
    $users_sql = "SELECT * FROM users WHERE role != 'Admin'";
    $users_result = mysqli_query($conn, $users_sql);
    // Fetch properties
    $properties_sql = "SELECT * FROM properties";
    $properties_result = mysqli_query($conn, $properties_sql);
    $user_sql = "SELECT * FROM users WHERE role != 'Admin'";
    ?>
    <div style="position: relative; width: 100%; padding: 50px 0;">
        <div class="container">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Администраторски панел</h1>
                <hr>
            </div>
            <h2>Потребители</h2>
            <hr>
            <div class="table-responsive my-4">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Име</th>
                            <th>Имейл</th>
                            <th>Телефонен номер</th>
                            <th>Роля</th>
                            <th>Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($user = mysqli_fetch_assoc($users_result)) {
                            echo "<tr>
                                    <td>{$user['id']}</td>
                                    <td>{$user['name']}</td>
                                    <td>{$user['email']}</td>
                                    <td>{$user['phone_number']}</td>
                                    <td>{$user['role']}</td>
                                    <td>
                                        <a href='edit_user_admin.php?id={$user['id']}' class='btn btn-success'>Промени</a>
                                    </td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="container-fluid">
                <h2>Имоти</h2>
                <hr>
                <div class="table-responsive my-4">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Име</th>
                                <th>Локация</th>
                                <th>Град</th>
                                <th>Регион</th>
                                <th>Цена</th>
                                <th>Статус</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($property = mysqli_fetch_assoc($properties_result)) {
                                echo "<tr>
                                    <td>{$property['pid']}</td>
                                    <td>{$property['pname']}</td>
                                    <td>{$property['location']}</td>
                                    <td>{$property['city']}</td>
                                    <td>{$property['region']}</td>
                                    <td>\${$property['price']}</td>
                                    <td>{$property['status']}</td>
                                    <td>
                                        <a href='edit_property.php?pid={$property['pid']}' class='btn btn-success'>Промени</a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container-fluid">
                <h2>Съобщения</h2>
                <hr>
                <div class="table-responsive my-4">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Име</th>
                                <th>Имейл</th>
                                <th>Телефон</th>
                                <th>Тема</th>
                                <th>Съобщение</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Свързване с базата данни и изпълнение на заявка за извличане на всички съобщения
                            $query = "SELECT * FROM messages";
                            $result = mysqli_query($conn, $query);

                            // Извеждане на всички редове от таблицата съобщения
                            while ($message = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                        <td>{$message['id']}</td>
                        <td>{$message['name']}</td>
                        <td>{$message['email']}</td>
                        <td>{$message['phone']}</td>
                        <td>{$message['subject']}</td>
                        <td>{$message['message']}</td>
                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>