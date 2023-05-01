<?php
require_once('dbconfig.php');
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
   <title>Real Estate Web App - Properties</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="styles.css">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
      .featured-thumb .quantity li span {
         color: #0d1432;
      }

      .featured-thumb .price,
      .featured-thumb .appartment {
         position: absolute;
         bottom: 20px;
         left: 20px;
         z-index: 99;
         font-size: 21px;
      }

      .featured-thumb .price.right {
         left: inherit;
         right: 20px;
      }

      .featured-thumb .price span {
         font-size: 13px;
         display: block;
      }

      .featured-thumb .starmark {
         position: absolute;
         bottom: 20px;
         right: 20px;
         font-size: 21px;
         z-index: 99;
      }

      .featured-thumb .starmark.top {
         bottom: inherit;
         top: 15px;
         right: 120px;
      }

      .featured-thumb .location svg {
         font-size: 14px;
      }

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

      .featured-thumb.list {
         display: flex;
      }

      .featured-thumb.list .image-area {
         width: 40%;
         float: left;
      }

      .featured-thumb.list .featured-thumb-data {
         width: 60%;
         float: right;
      }

      .featured-thumb.list .quantity li span {
         display: inherit;
      }

      .bg-gray {
         background-color: #f5f5f5;
      }
   </style>
</head>

<body>
   <?php include("mini-header.php"); ?>
   <?php
   include('navigation.php');
   ?>
   <div class="w-100 position-relative"
      style="background-image: url('images/banner.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; width: 100%; height: 520px; min-height: 400px;">
      <div class="container h-100">
         <div class="row h-100 align-items-center">
            <div class="col-lg-12">
               <div class="text-white">
                  <h1 class="mb-5"><span class="bg-success text-white p-3 rounded-pill">Позволи ни</span><br><br><span
                        class="bg-success text-white p-3 rounded-pill">Да намерим вашия дом</span></h1>
                  <form method="post" action="properties.php">
                     <div class="row">
                        <div class="col-md-6 col-lg-2">
                           <div class="form-group">
                              <select class="form-control" name="property-type" style="border: 2px solid black;">
                                 <option value="">Изберете тип на имота</option>
                                 <option value="Apartment">Апартамент</option>
                                 <option value="Building">Сграда</option>
                                 <option value="House">Къща</option>
                                 <option value="Villa">Вила</option>
                                 <option value="Office">Офис</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                           <div class="form-group">
                              <input type="text" class="form-control" name="price-range" placeholder="Въведете цена..."
                                 style="border: 2px solid black;">
                           </div>
                        </div>
                        <div class="col-md-8 col-lg-6">
                           <div class="form-group">
                              <input type="text" class="form-control" name="city" placeholder="Въведете град..."
                                 style="border: 2px solid black;">
                           </div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                           <div class="form-group">
                              <button type="submit" name="filter" class="btn btn-success w-100">Намерете имоти</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div style="position: relative; width: 100%; padding: 50px 0;">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <h2 class="text-dark text-center mb-4 text-uppercase">Списък с имоти</h2>
               <hr>
            </div>
            <div class="col-md-12">
               <div class="tab-content mt-4" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home">
                     <div class="row">
                        <?php
                        $servername = "localhost:3307";
                        $username = "root";
                        $password = "";
                        $dbname = "real_estate";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if (isset($_POST['filter'])) {
                           $property_type = $_POST['property-type'];
                           $price_range = $_POST['price-range'];
                           $city = $_POST['city'];

                           $result = $database->getFilteredData($property_type, $price_range, $city);
                        } else {
                           // Get all data
                           $query = "SELECT * FROM properties";
                           $result = mysqli_query($conn, $query);
                        }

                        if (mysqli_num_rows($result) > 0) {
                           while ($row = mysqli_fetch_assoc($result)) {
                              // get the first image path from the list of images
                              $images = explode('|', $row['pimages']);
                              $first_image = trim($images[0]);

                              ?>
                              <div class="col-md-6 col-lg-4 shadow pt-2">
                                 <div class="featured-thumb mb-4">
                                    <div class="overflow-hidden position-relative">
                                       <img src="<?php echo $first_image; ?>" alt="pimage"
                                          style="width: 100%; height: 350px;">
                                       <div class="price text-white"><span
                                             class="bg-success ps-3 pe-3 pt-2 pb-2 rounded-pill text-center shadow">$<?php echo $row['price']; ?>
                                          </span><span
                                             class="text-white bg-success ps-3 pe-3 pt-2 pb-2 text-center rounded-pill mt-3 shadow"><?php echo $row['size']; ?>
                                             Кв. м.</span></div>
                                    </div>
                                    <div class="featured-thumb-data">
                                       <div class="p-3">
                                          <h5 class="text-dark mb-2 text-capitalize">
                                             <?php echo $row['pname']; ?>
                                          </h5>
                                          <span class="location text-capitalize"><i
                                                class="fas fa-map-marker-alt text-success"></i>
                                             <?php echo $row['location']; ?>
                                          </span>
                                       </div>
                                       <div class="bg-gray quantity pt-4 text-center">
                                          <ul>
                                             <li><span>
                                                   <?php echo $row['bedroom']; ?>
                                                </span> Спални</li>
                                             <li><span>
                                                   <?php echo $row['bathroom']; ?>
                                                </span> Бани</li>
                                             <li><span>
                                                   <?php echo $row['balcony']; ?>
                                                </span> Балкони</li>
                                             <li><span>
                                                   <?php echo $row['kitchen']; ?>
                                                </span> Кухни</li>
                                             <li><span>
                                                   <?php echo $row['hall']; ?>
                                                </span> Холове</li>
                                          </ul>
                                       </div>
                                       <div class="p-4 d-inline-block w-100">
                                          <div class="float-right"><i class="far fa-calendar-alt text-success mr-1"></i>
                                             <?php echo $row['date']; ?>
                                          </div>
                                       </div>
                                       <div class="p-4 d-inline-block w-100 bg-success text-white text-center rounded-pill">
                                          <a class="text-white text-decoration-none fw-bold"
                                             href="property-detail.php?pid=<?php echo $row['pid']; ?>">ДЕТАЙЛИ</a>
                                          <input type="hidden" name="property_id" value="<?php echo $row['pid']; ?>">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php
                           }
                        } else {
                           echo
                              '
                           <div class="alert alert-danger" role="alert">
                           <i class="fa-solid fa-triangle-exclamation"></i> No properties found.
                           </div>
                           ';
                        }

                        mysqli_close($conn);
                        ?>


                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php include("footer.php"); ?>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"></script>

</body>

</html>