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

<?php
// Проверка дали формата е била изпратена
if (isset($_POST['send'])) {
    // Извличане на данните от POST заявката
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    // Проверка за грешки при изпълнението на заявката + Валидация на данните
    if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
        echo '<div class="alert alert-danger mb-0" role="alert">Грешка при изпращането на съобщението.</div>';
    } else {
        // Извършване на заявката за вмъкване на нов запис в таблицата messages
        $query = "INSERT INTO messages (name, email, phone, subject, message) VALUES ('$name', '$email', '$phone', '$subject', '$message')";
        $result = mysqli_query($conn, $query);
        echo '<div class="alert alert-success mb-0" role="alert">Съобщението е изпратено успешно.</div>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Real Estate Web App</title>
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
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col">
                <h1>КОНТАКТИ</h1>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="container mb-4">
                            <div class="row">
                                <div class="col-lg-4 mb-5 bg-dark">
                                    <div style="border-right: 2px dashed #f5f5f5;height: 100%;padding: 50px 0;">
                                        <ul>
                                            <li class="d-flex mb-4">
                                                <i class="fas fa-map-marker-alt text-white mt-1"
                                                    style="margin-right: 5px;"></i>
                                                <div class="contact-address">
                                                    <h5 class="text-white">Адреси</h5>
                                                    <span class="text-white">ул. „Перуша“ 4, гр. Правец 2161</span>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4"> <i class="fas fa-phone-alt text-white mt-1"
                                                    style="margin-right: 5px;"></i>
                                                <div class="contact-address">
                                                    <h5 class="text-white">Обадете ни се</h5>
                                                    <span class="d-table text-white">+359 88 248 9370</span>
                                                    <span class="text-white">+359 88 88 62265</span>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4"> <i class="fas fa-envelope text-white mt-1"
                                                    style="margin-right: 5px;"></i>
                                                <div class="contact-address">
                                                    <h5 class="text-white">Имейл адреси</h5>
                                                    <span class="d-table text-white">momchil@gmail.com</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-1"></div>
                                <div class="col-md-12 col-lg-7">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h2 class="text-dark text-center mb-5">Моля, попълнете формата</h2>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form class="w-100" method="post">
                                                    <div class="row">
                                                        <div class="row mb-4">
                                                            <div class="form-group col-lg-6">
                                                                <input type="text" name="name" class="form-control mb-4"
                                                                    placeholder="Вашето име...">
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <input type="text" name="email"
                                                                    class="form-control mb-4"
                                                                    placeholder="Вашият имейл...">
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <input type="text" name="phone"
                                                                    class="form-control mb-4"
                                                                    placeholder="Телефон за контакт..." maxlength="10">
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <input type="text" name="subject"
                                                                    class="form-control mb-4" placeholder="Тема....">
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <textarea name="message" class="form-control"
                                                                        rows="5" placeholder="Съобщение...."></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" value="send message" name="send"
                                                            class="btn btn-success p-2 rounded-pill">Изпратете
                                                            съобщение</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29505.378280860015!2d23.90090691348331!3d42.89113104559203!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40aa4fe45b37beab%3A0xf29418a82b4be35f!2zMjE2MSDQn9GA0LDQstC10YY!5e1!3m2!1sbg!2sbg!4v1682784199994!5m2!1sbg!2sbg"
                            height="450" style="border:0;width: 100%;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
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