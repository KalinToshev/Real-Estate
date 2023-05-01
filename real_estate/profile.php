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
   <div style="position: relative; width: 100%; padding: 50px 0;">
      <div class="container">
         <h1>Редактиране на профила</h1>
         <hr>
         <div class="container">
            <div class="row">
               <!-- Колона за показване на информация за текущия потребител -->
               <div class="col-md-6">
                  <?php
                  // Взимане на информацията за текущия потребител от базата данни
                  $user_id = $_SESSION['user_id'];
                  $query = "SELECT * FROM users WHERE id = $user_id";
                  $result = mysqli_query($conn, $query);
                  $user = mysqli_fetch_assoc($result);
                  ?>
                  <h2>Информация за потребителя</h2>
                  <p><strong>Име:</strong>
                     <?php echo $user['name']; ?>
                  </p>
                  <p><strong>Email:</strong>
                     <?php echo $user['email']; ?>
                  </p>
                  <p><strong>Телефонен номер:</strong>
                     <?php echo $user['phone_number']; ?>
                  </p>
                  <p><strong>Роля:</strong>
                     <?php echo $user['role']; ?>
                  </p>
               </div>

               <!-- Колона за формата за редактиране на данните на потребителя -->
               <div class="col-md-6">
                  <h2>Редактиране на информацията за потребителя</h2>
                  <form method="POST">
                     <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                     <div class="mb-3">
                        <label for="name" class="form-label">Име</label>
                        <input type="text" class="form-control" id="name" name="name"
                           value="<?php echo $user['name']; ?>">
                     </div>
                     <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                           value="<?php echo $user['email']; ?>">
                     </div>
                     <div class="mb-3">
                        <label for="phone_number" class="form-label">Телефонен номер</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                           value="<?php echo $user['phone_number']; ?>">
                     </div>
                     <button type="submit" class="btn btn-primary">Запазване</button>
                  </form>
                  <?php
                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                     // Извличане на данните от POST заявката
                     $id = $_POST['id'];
                     $name = $_POST['name'];
                     $email = $_POST['email'];
                     $phone_number = $_POST['phone_number'];

                     // Заявка за обновяване на данните на потребителя
                     $query = "UPDATE users SET name = '$name', email = '$email', phone_number = '$phone_number' WHERE id = $id";
                     mysqli_query($conn, $query);
                  }
                  ?>
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