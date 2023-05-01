<?php
include 'dbconfig.php';

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // Initialize error array
   $errors = array();
   // Sanitize and validate input fields
   $email = trim($_POST['email']);
   if (empty($email)) {
      $errors[] = "Email is required";
   } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email format";
   }
   $password = trim($_POST['password']);
   if (empty($password)) {
      $errors[] = "Password is required";
   }
   // If there are no validation errors, check the credentials against the database
   if (empty($errors)) {
      // Establish database connection
      $conn = new PDO("mysql:host=localhost:3307;dbname=real_estate", "root", "");
      // Prepare and execute query
      $select = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
      $select->execute([$email, $password]);
      $row = $select->fetch();
      // If there is a matching record, set the session variable
      if ($select->rowCount() > 0) {
         $_SESSION['role_name'] = $row['role'];
         $_SESSION['user_id'] = $row['id'];
         // Redirect to home page
         header('location: home.php');
         exit;
      } else {
         $errors[] = 'Incorrect email or password!';
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
   <title>Login - Real Estate Web App</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
      .loginbox {
         background-color: #fff;
         border-radius: 6px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         display: flex;
         margin: 1.875rem auto;
         max-width: 400px;
         min-height: 500px;
         width: 100%;
      }

      .loginbox .login-left {
         align-items: center;
         background: linear-gradient(180deg, #3949ab, #2962ff);
         border-radius: 6px 0 0 6px;
         flex-direction: column;
         justify-content: center;
         padding: 80px;
         width: 400px;
         display: flex;
      }

      .loginbox .login-right {
         align-items: center;
         display: flex;
         justify-content: center;
         padding: 40px;
         width: 400px;
      }

      .loginbox .login-right .login-right-wrap {
         max-width: 100%;
         flex: 0 0 100%;
      }

      .loginbox .login-right h1 {
         font-size: 26px;
         font-weight: 500;
         margin-bottom: 5px;
         text-align: center;
      }

      .login-or {
         color: #a0a0a0;
         margin-bottom: 20px;
         margin-top: 20px;
         padding-bottom: 10px;
         padding-top: 10px;
         position: relative;
      }

      .or-line {
         background-color: #e5e5e5;
         height: 1px;
         margin-bottom: 0;
         margin-top: 0;
         display: block;
      }

      .span-or {
         background-color: #fff;
         display: block;
         left: 50%;
         margin-left: -20px;
         position: absolute;
         text-align: center;
         text-transform: uppercase;
         top: 0;
         width: 42px;
      }

      .loginbox .login-right .dont-have {
         color: #a0a0a0;
         margin-top: 1.875rem;
      }

      .loginbox .login-right .dont-have a {
         color: red;
      }
   </style>
</head>

<body>
   <?php include("mini-header.php"); ?>
   <?php
   include('navigation.php');
   ?>
   <?php if (!empty($errors)): ?>
      <div class="alert alert-danger container">
         <ul>
            <?php foreach ($errors as $error): ?>
               <li>
                  <?php echo $error; ?>
               </li>
            <?php endforeach; ?>
         </ul>
      </div>
   <?php endif; ?>
   <div class="min-vh-100 d-flex justify-content-center align-items-center"
      style="position: relative; width: 100%; padding: 50px 0; background-color: #f5f5f5;">
      <div class="container">
         <div class="loginbox">
            <div class="login-right">
               <div class="login-right-wrap">
                  <h1 class="mb-3 fs-2">ВЛЕЗТЕ В ПРОФИЛА СИ</h1>
                  <hr>
                  <form method="post" action="login.php">
                     <div class="form-group mb-3">
                        <label for="email" class="mb-2">Имейл:</label>
                        <input type="email" name="email" class="form-control" placeholder="Вашият имейл..."
                           style="border: 1px solid black;">
                     </div>
                     <div class="form-group mb-3">
                        <label for="password" class="mb-2">Парола:</label>
                        <input type="password" name="password" class="form-control" placeholder="Вашата парола..."
                           style="border: 1px solid black;">
                     </div>

                     <button class="btn btn-success w-100" name="login" value="Login" type="submit">Влезте в профила си</button>
                  </form>
                  <div class="login-or">
                     <span class="or-line"></span>
                     <span class="span-or">или</span>
                  </div>
                  <div class="text-center dont-have">Нямате все още акаунт? <a href="register.php">Създайте си</a></div>
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