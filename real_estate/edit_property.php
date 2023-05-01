<?php
include 'dbconfig.php';

$errors = [];

// Проверка дали е зададено ID на имот
if (isset($_GET['pid'])) {
    $property_id = $_GET['pid'];

    // Извличане на данни за имота
    $property_sql = "SELECT * FROM properties WHERE pid = '$property_id'";
    $property_result = mysqli_query($conn, $property_sql);
    $property = mysqli_fetch_assoc($property_result);
}

if (isset($_POST['submit'])) {

    $required_fields = [
        'pname' => 'Property Name',
        'pdescription' => 'Property Description',
        'ptype' => 'Property Type',
        'bedroom' => 'Bedroom',
        'bathroom' => 'Bathroom',
        'balcony' => 'Balcony',
        'kitchen' => 'Kitchen',
        'hall' => 'Hall',
        'floor' => 'Floor',
        'size' => 'Size',
        'price' => 'Price',
        'location' => 'Location',
        'city' => 'City',
        'region' => 'Region',
        'features' => 'Features',
        'pimages' => 'Property Images',
        'status' => 'Status',
        'uid' => 'User ID',
        'totalfloor' => 'Total Floor',
        'isFeatured' => 'Is Featured'
    ];

    foreach ($required_fields as $field => $label) {
        if (empty($_POST[$field])) {
            $errors[] = "{$label} is required.";
        }
    }

    // Ако няма грешки, актуализирайте записа
    if (empty($errors)) {
        // Обновяване на данни за имота
        // Запазете промените в базата данни
        $pname = mysqli_real_escape_string($conn, $_POST['pname']);
        $pdescription = mysqli_real_escape_string($conn, $_POST['pdescription']);
        $ptype = mysqli_real_escape_string($conn, $_POST['ptype']);
        $bedroom = $_POST['bedroom'];
        $bathroom = $_POST['bathroom'];
        $balcony = $_POST['balcony'];
        $kitchen = $_POST['kitchen'];
        $hall = $_POST['hall'];
        $floor = mysqli_real_escape_string($conn, $_POST['floor']);
        $size = $_POST['size'];
        $price = $_POST['price'];
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $region = mysqli_real_escape_string($conn, $_POST['region']);
        $features = mysqli_real_escape_string($conn, $_POST['features']);
        $pimages = mysqli_real_escape_string($conn, $_POST['pimages']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $uid = $_POST['uid'];
        $totalfloor = mysqli_real_escape_string($conn, $_POST['totalfloor']);
        $isFeatured = $_POST['isFeatured'];

        $update_sql = "UPDATE properties SET pname = '$pname', pdescription = '$pdescription', ptype = '$ptype', bedroom = '$bedroom', bathroom = '$bathroom', balcony = '$balcony', kitchen = '$kitchen', hall = '$hall', floor = '$floor', size = '$size', price = '$price', location = '$location', city = '$city', region = '$region', features = '$features', pimages = '$pimages', status = '$status', uid = '$uid', totalfloor = '$totalfloor', isFeatured = '$isFeatured' WHERE pid = '$property_id'";
        if (mysqli_query($conn, $update_sql)) {
            header('Location: admin.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
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
    <title>Edit Property</title>
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
            <h2>Редактиране на имот</h2>
            <hr>
            <form method="POST">
                <div class="mb-3">
                    <label for="pname" class="form-label">Име на имота</label>
                    <input type="text" class="form-control" id="pname" name="pname"
                        value="<?php echo $property['pname']; ?>">
                </div>
                <div class="mb-3">
                    <label for="pdescription" class="form-label">Описание на имота</label>
                    <textarea class="form-control" id="pdescription" name="pdescription"
                        rows="3"><?php echo $property['pdescription']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="ptype" class="form-label">Тип на имота</label>
                    <select class="form-control" id="ptype" name="ptype">
                        <option value="Apartment" <?php echo ($property['ptype'] == 'Apartment') ? 'selected' : ''; ?>>
                            Apartment</option>
                        <option value="House" <?php echo ($property['ptype'] == 'House') ? 'selected' : ''; ?>>House
                        </option>
                        <option value="Office" <?php echo ($property['ptype'] == 'Office') ? 'selected' : ''; ?>>Office
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bedroom" class="form-label">Спални</label>
                    <input type="number" class="form-control" id="bedroom" name="bedroom"
                        value="<?php echo $property['bedroom']; ?>">
                </div>
                <div class="mb-3">
                    <label for="bathroom" class="form-label">Бани</label>
                    <input type="number" class="form-control" id="bathroom" name="bathroom"
                        value="<?php echo $property['bathroom']; ?>">
                </div>
                <div class="mb-3">
                    <label for="balcony" class="form-label">Балкони</label>
                    <input type="number" class="form-control" id="balcony" name="balcony"
                        value="<?php echo $property['balcony']; ?>">
                </div>
                <div class="mb-3">
                    <label for="kitchen" class="form-label">Кухни</label>
                    <input type="number" class="form-control" id="kitchen" name="kitchen"
                        value="<?php echo $property['kitchen']; ?>">
                </div>
                <div class="mb-3">
                    <label for="hall" class="form-label">Холове</label>
                    <input type="number" class="form-control" id="hall" name="hall"
                        value="<?php echo $property['hall']; ?>">
                </div>
                <div class="mb-3">
                    <label for="floor" class="form-label">Етаж</label>
                    <input type="number" class="form-control" id="floor" name="floor"
                        value="<?php echo $property['floor']; ?>">
                </div>
                <div class="mb-3">
                    <label for="size" class="form-label">Размер</label>
                    <input type="number" class="form-control" id="size" name="size"
                        value="<?php echo $property['size']; ?>">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Цена</label>
                    <input type="number" class="form-control" id="price" name="price"
                        value="<?php echo $property['price']; ?>">
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Локация</label>
                    <input type="text" class="form-control" id="location" name="location"
                        value="<?php echo $property['location']; ?>">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">Град</label>
                    <input type="text" class="form-control" id="city" name="city"
                        value="<?php echo $property['city']; ?>">
                </div>
                <div class="mb-3">
                    <label for="region" class="form-label">Регион</label>
                    <input type="text" class="form-control" id="region" name="region"
                        value="<?php echo $property['region']; ?>">
                </div>
                <div class="mb-3">
                    <label for="features" class="form-label">Характеристики</label>
                    <input type="text" class="form-control" id="features" name="features"
                        value="<?php echo $property['features']; ?>">
                </div>
                <div class="mb-3">
                    <label for="pimages" class="form-label">Снимки</label>
                    <input type="text" class="form-control" id="pimages" name="pimages"
                        value="<?php echo $property['pimages']; ?>">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Статус</label>
                    <input type="text" class="form-control" id="status" name="status"
                        value="<?php echo $property['status']; ?>">
                </div>
                <div class="mb-3">
                    <label for="totalfloor" class="form-label">Общ брой етажи</label>
                    <input type="number" class="form-control" id="totalfloor" name="totalfloor"
                        value="<?php echo $property['totalfloor']; ?>">
                </div>
                <div class="mb-3">
                    <label for="isFeatured" class="form-label">Представен</label>
                    <input type="text" class="form-control" id="isFeatured" name="isFeatured"
                        value="<?php echo $property['isFeatured']; ?>">
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