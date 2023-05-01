<?php
include 'dbconfig.php';
?>

<?php include("gdpr.php"); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['gdpr_consent'])) {
        setcookie('gdpr_consent', '1', time() + 3600 * 24 * 365); // Създаване на бисквитка за съгласие на GDPR
        header("Location: " . $_SERVER['PHP_SELF']);
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
                <h1>ЗА НАС</h1>
                <hr>
                <div class="row">
                    <div class="col">
                        <p>
                            Ние в Real Estate сме посветени на предоставянето на най-добрите услуги за недвижими
                            имоти за нашите клиенти. Нашата мисия е да улесним процеса на търсене, купуване, продажба
                            или наемане на недвижим имот в най-гладкия и безопасен начин възможен.
                        </p>
                        <p>
                            Нашата екип от професионалисти се стреми да създаде висококачествен опит за нашите клиенти,
                            като им предоставяме персонализирани решения, които отговарят на техните нужди и
                            предпочитания. Ние знаем, че купуването или продажбата на недвижим имот може да бъде сложен
                            процес, затова сме тук, за да Ви помогнем да вземете правилното решение.
                        </p>
                        <p>
                            В Real Estate вярваме в доверието и прозрачността и затова стремим се да изградим здрава
                            връзка с нашите клиенти. Ние сме готови да Ви помогнем във всеки един момент, когато имате
                            нужда от нашата помощ.
                        </p>
                        <p>
                            С надеждата да Ви помогнем да намерите Вашия идеален недвижим имот, Ви благодарим, че
                            избрахте Real Estate.
                        </p>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <img src="images/about-us-image.png" alt="About us">
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