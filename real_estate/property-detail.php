<?php session_start(); ?>

<?php include("gdpr.php"); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['gdpr_consent'])) {
        setcookie('gdpr_consent', '1', time() + 3600 * 24 * 365); // Създаване на бисквитка за съгласие на GDPR
    }
}
?>

<?php
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    // Конфигурация за връзка с базата данни
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "real_estate";
    // Връзка с базата данни
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Проверка за грешки
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Изпълнение на SQL заявката за извличане на информацията за имота със съответното ID
    $sql = "SELECT * FROM properties WHERE pid = $pid";
    $result = $conn->query($sql);
    // Проверка за наличието на информация за имота
    if ($result->num_rows > 0) {
        // Извличане на информацията за имота от базата данни и записване на данните в променливи
        while ($row = $result->fetch_assoc()) {
            $pname = $row['pname'];
            $ptype = $row['ptype'];
            $bedroom = $row['bedroom'];
            $bathroom = $row['bathroom'];
            $balcony = $row['balcony'];
            $kitchen = $row['kitchen'];
            $hall = $row['hall'];
            $floor = $row['floor'];
            $size = $row['size'];
            $price = $row['price'];
            $location = $row['location'];
            $city = $row['city'];
            $region = $row['region'];
            $pdescription = $row['pdescription'];
            $features = $row['features'];
            $pimages = $row['pimages'];
            $status = $row['status'];
            $totalfloor = $row['totalfloor'];
            $isFeatured = $row['isFeatured'];
        }
    } else {
        echo "Няма информация за този имот.";
    }
} else {
    echo "Не е избран имот.";
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Property-Detail</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <style>
        .property-quantity li,
        .featured-thumb .quantity li {
            display: inline-block;
            font-weight: 500;
            padding-bottom: 20px;
            padding-right: 15px;
        }

        .property-quantity li span,
        .featured-thumb .quantity li span {
            display: table;
            padding-bottom: 5px;
        }
    </style>
</head>

<body>
    <?php include("mini-header.php"); ?>
    <?php
    include('navigation.php');
    ?>
    <div class="container-fluid p-0 min-vh-100">
        <div class="w-100 position-relative"
            style="background-image: url('images/banner.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; width: 100%; height: 250px;">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-lg-12">
                        <div class="text-white text-center">
                            <h1><span class="bg-success text-white p-3 rounded-pill">ДЕТАЙЛИ ЗА ИМОТА</span></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="position: relative; width: 100%; padding: 50px 0;">
            <h1>
                <?php echo $pname; ?>
            </h1>
            <hr>

            <?php
            // Вземане на информацията за избрания имот по ID
            $sql = "SELECT * FROM properties WHERE pid=$pid";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            // Вземане на пътищата към снимките и разделяне на стойностите
            $pimages = $row["pimages"];
            $pimages_array = explode(" | ", $pimages);
            // Генериране на HTML за слайдшоуто с динамични снимки
            echo '<div id="carouselExampleControls" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner">';
            foreach ($pimages_array as $key => $pimage) {
                if ($key == 0) {
                    echo '<div class="carousel-item active">';
                } else {
                    echo '<div class="carousel-item">';
                }
                echo '<img src="' . $pimage . '" class="d-block w-100 img-fluid" alt="..." style="height: 550px;">
                        </div>';
            }
            echo '</div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>';
            ?>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="bg-success d-table px-3 py-2 rounded text-white text-capitalize">
                        <?php echo $status; ?>
                    </div>
                    <span class="mb-sm-20 d-block text-capitalize mt-2">
                        <i class="fas fa-map-marker-alt text-success"></i> &nbsp;
                        <?php echo $city; ?>,
                        <?php echo $region; ?>,
                        <?php echo $location; ?>
                    </span>
                </div>
                <div class="col-md-6">
                    <div class="text-success text-left h5 my-2 text-md-right">$
                        <?php echo $price; ?>
                    </div>
                    <div class="text-left text-md-right">Цена</div>
                </div>
            </div>
            <div class="property-details">
                <div class="property-quantity px-4 pt-4 w-100" style="background-color: #f5f5f5;">
                    <ul>
                        <li><span class="text-dark">
                                <?php echo $size; ?>
                            </span> Кв. м.</li>
                        <li><span class="text-dark">
                                <?php echo $bedroom; ?>
                            </span> Спални</li>
                        <li><span class="text-dark">
                                <?php echo $bathroom; ?>
                            </span> Бани</li>
                        <li><span class="text-dark">
                                <?php echo $balcony; ?>
                            </span> Балкони</li>
                        <li><span class="text-dark">
                                <?php echo $hall; ?>
                            </span> Холове</li>
                        <li><span class="text-dark">
                                <?php echo $kitchen; ?>
                            </span> Кухни</li>
                    </ul>
                </div>
                <h4 class="text-dark my-4">Описание</h4>
                <p>
                    <?php echo $pdescription; ?>
                </p>

                <h5 class="mt-5 mb-4 text-dark">Характеристики</h5>
                <p>
                    <?php echo $features; ?>
                </p>

                <h5 class="mt-5 mb-4 text-dark position-relative">Контакт с агента</h5>
                <div>
                    <div class="row">
                        <div class="col-sm-4 col-lg-3">
                            <img src="images/agent.jpg" alt="Agent" height="200" width="170">
                        </div>
                        <div class="col-sm-8 col-lg-9">
                            <div style="margin-top: 20px;">
                                <h6 class="text-success text-capitalize">Момчил Никифоров</h6>
                                <ul class="mb-3">
                                    <li>+359 88 248 9370</li>
                                    <li>momchilll@gmail.com</li>
                                </ul>

                                <div class="mt-3 text-dark hover-text-success">
                                    <ul class="d-flex p-0" style="list-style-type: none;">
                                        <li class="me-3"><a href="#"><i class="fab fa-facebook-f text-success"></i></a>
                                        </li>
                                        <li class="me-3"><a href="#"><i class="fab fa-twitter text-success"></i></a>
                                        </li>
                                        <li class="me-3"><a href="#"><i
                                                    class="fab fa-google-plus-g text-success"></i></a>
                                        </li>
                                        <li class="me-3"><a href="#"><i class="fab fa-linkedin-in text-success"></i></a>
                                        </li>
                                        <li class="me-3"><a href="#"><i class="fas fa-rss text-success"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("footer.php"); ?>
    <script src="js/property-detail.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>