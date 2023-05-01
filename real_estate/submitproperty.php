<?php
session_start();
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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    // Извличане на данните от формата
    $pname = mysqli_real_escape_string($conn, $_POST["pname"]);
    $ptype = mysqli_real_escape_string($conn, $_POST["ptype"]);
    $bedroom = mysqli_real_escape_string($conn, $_POST["bedroom"]);
    $bathroom = mysqli_real_escape_string($conn, $_POST["bathroom"]);
    $balcony = mysqli_real_escape_string($conn, $_POST["balcony"]);
    $kitchen = mysqli_real_escape_string($conn, $_POST["kitchen"]);
    $hall = mysqli_real_escape_string($conn, $_POST["hall"]);
    $floor = mysqli_real_escape_string($conn, $_POST["floor"]);
    $size = mysqli_real_escape_string($conn, $_POST["size"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    $region = mysqli_real_escape_string($conn, $_POST["region"]);
    $pdescription = mysqli_real_escape_string($conn, $_POST["pdescription"]);
    $features = mysqli_real_escape_string($conn, $_POST["features"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);
    $totalfloor = mysqli_real_escape_string($conn, $_POST["totalfloor"]);
    $isFeatured = mysqli_real_escape_string($conn, $_POST["isFeatured"]);
    // Генериране на пътищата до снимките
    $pimages_path = "";
    if (isset($_FILES["pimages"]["name"])) {
        $pimages_array = array();
        foreach ($_FILES["pimages"]["name"] as $key => $pimage_name) {
            $target_dir = "images/";
            $target_file = $target_dir . basename($pimage_name);
            if (move_uploaded_file($_FILES["pimages"]["tmp_name"][$key], $target_file)) {
                $pimages_array[] = $target_file;
            } else {
                error_log("Не може да се качи снимка: " . $_FILES["pimages"]["error"][$key]);
            }
        }
        $pimages_path = implode(" | ", $pimages_array);
    }
    // SQL заявка за вмъкване на данните в таблицата `properties`
    $sql = "INSERT INTO properties (pname, ptype, bedroom, bathroom, balcony, kitchen, hall, floor, size, price, location, city, region, pdescription, features, pimages, status, totalfloor, isFeatured) VALUES ('$pname', '$ptype', '$bedroom', '$bathroom', '$balcony', '$kitchen', '$hall', '$floor', '$size', '$price', '$location', '$city', '$region', '$pdescription', '$features', '$pimages_path', '$status', '$totalfloor', '$isFeatured')";
    // Изпълнение на SQL заявката
    if ($conn->query($sql) === TRUE) {
        echo "Данните са въведени успешно.";
    } else {
        echo "Грешка при вмъкването на данните: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Submit Property</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include("mini-header.php"); ?>
    <?php include("navigation.php"); ?>
    <div style="position: relative; width: 100%; padding: 50px 0;">
        <div class="container mt-5">
            <h1>Добавяне на имот</h1>
            <hr>
            <form method="POST" action="submitproperty.php" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="pname" class="form-label">Име на имота:</label>
                        <input type="text" class="form-control" id="pname" name="pname" required>
                    </div>
                    <div class="col-md-6">
                        <label for="ptype" class="form-label">Тип на имота:</label>
                        <select class="form-select" id="ptype" name="ptype" required>
                            <option value="">Изберете тип на имота</option>
                            <option value="Apartment">Апартамент</option>
                            <option value="Building">Сграда</option>
                            <option value="House">Къща</option>
                            <option value="Villa">Вила</option>
                            <option value="Office">Офис</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="bedroom" class="form-label">Брой спални:</label>
                        <input type="number" class="form-control" id="bedroom" name="bedroom" required>
                    </div>
                    <div class="col-md-6">
                        <label for="bathroom" class="form-label">Брой бани:</label>
                        <input type="number" class="form-control" id="bathroom" name="bathroom" required>
                    </div>
                    <div class="col-md-6">
                        <label for="balcony" class="form-label">Брой тераси:</label>
                        <input type="number" class="form-control" id="balcony" name="balcony" required>
                    </div>
                    <div class="col-md-6">
                        <label for="kitchen" class="form-label">Брой кухни:</label>
                        <input type="number" class="form-control" id="kitchen" name="kitchen" required>
                    </div>
                    <div class="col-md-6">
                        <label for="hall" class="form-label">Брой холове:</label>
                        <input type="number" class="form-control" id="hall" name="hall" required>
                    </div>
                    <div class="col-md-6">
                        <label for="floor" class="form-label">Етаж:</label>
                        <input type="text" class="form-control" id="floor" name="floor" required>
                    </div>
                    <div class="col-md-6">
                        <label for="size" class="form-label">Размер (в кв.м.):</label>
                        <input type="number" class="form-control" id="size" name="size" required>
                    </div>
                    <div class="col-md-6">
                        <label for="price" class="form-label">Цена (в лв.):</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="col-md-6">
                        <label for="location" class="form-label">Адрес:</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">Град:</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="col-md-6">
                        <label for="region" class="form-label">Район:</label>
                        <input type="text" class="form-control" id="region" name="region" required>
                    </div>
                    <div class="col-md-12">
                        <label for="pdescription" class="form-label">Описание:</label>
                        <textarea class="form-control" id="pdescription" name="pdescription" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="features" class="form-label">Характеристики:</label>
                        <textarea class="form-control" id="features" name="features" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="pimages" class="form-label">Снимки</label>
                        <input type="file" class="form-control" id="pimages" name="pimages[]" accept="image/*" multiple
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Статус:</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">Изберете статус</option>
                            <option value="available">Наличен</option>
                            <option value="sold">Продаден</option>
                            <option value="rent">Под наем</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="totalfloor" class="form-label">Общ
                            брой етажи:</label>
                        <input type="text" class="form-control" id="totalfloor" name="totalfloor" required>
                    </div>
                    <div class="col-md-6">
                        <label for="isFeatured" class="form-label">Представен:</label>
                        <select class="form-select" id="isFeatured" name="isFeatured">
                            <option value="no">Не</option>
                            <option value="yes">Да</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Добави имот</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>