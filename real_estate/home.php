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
   <style>
      .hover-bg-white:hover {
         transition: all 300ms ease-in-out 0s;
         background-color: white;
         -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
         -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
         box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
      }

      .overlay-secondary-half {
         background-color: rgba(13, 20, 50, 0.7);
         width: 50%;
         -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
         -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
         box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
         padding: 20px;
      }

      @media screen and (max-width: 991px) {
         .overlay-secondary-half {
            width: 100%;
         }
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
         style="background-image: url('images/banner.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat; width: 100%; height: 520px; min-height: 400px;background-attachment: fixed;">
         <div class="container h-100">
            <div class="row h-100 align-items-center">
               <div class="col-lg-12">
                  <div class="text-white">
                     <h1><span class="bg-success text-white p-3 rounded-pill">Позволи ни</span><br><br><span
                           class="bg-success text-white p-3 rounded-pill">Да намерим вашия дом</span></h1>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div style="position: relative; width: 100%; padding: 50px 0; background-color: #f5f5f5;">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <h2 class="text-dark text-center mb-5">Какво правим ние</h2>
                  <hr>
               </div>
            </div>
            <div>
               <div class="row d-flex justify-content-center">
                  <div class="col-lg-3 col-md-6">
                     <div class="p-4 text-center hover-bg-white rounded mb-4">
                        <i class="fa-solid fa-money-bill text-success fa-2x" aria-hidden="true"></i>
                        <h5 class="text-dark py-3 m-0">Продажба на услуги</h5>
                        <p>Предлагаме широка гама от услуги за продажба на недвижими имоти. Нашите експерти ще Ви
                           помогнат да намерите най-доброто решение за Вашите нужди, като осигурят професионална оценка
                           на имота, маркетингова подкрепа и преговори с потенциални купувачи....</p>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                     <div class="p-4 text-center hover-bg-white rounded mb-4">
                        <i class="fa-solid fa-house text-success fa-2x" aria-hidden="true"></i>
                        <h5 class="text-dark py-3 m-0">Отдаване под наем</h5>
                        <p>Отдаване на качествени и удобни жилища на ниски цени в града и на околните местности. Ние
                           предлагаме гъвкави опции за наем, за да удовлетворим нуждите на всеки клиент....</p>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                     <div class="p-4 text-center hover-bg-white rounded mb-4">
                        <i class="fa-solid fa-list text-success fa-2x" aria-hidden="true"></i>
                        <h5 class="text-dark py-3 m-0">Обява за имоти</h5>
                        <p>Разгледайте най-добрите обяви за недвижими имоти сега - отлични възможности за купуване на
                           вашия идеален дом...</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div
         style="background-image: url('images/why-choose-us.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; position: relative; width: 100%; padding: 50px 0;">
         <div class="container">
            <div class="row overlay-secondary-half rounded">
               <h3 class="text-white">Защо да изберете нас?</h3>
               <div class="bg-white w-100 mt-2 mb-2" style="height: 2px;"></div>
               <div class="col-md-12 col-lg-6">
                  <div class="pr-4">
                     <ul class="m-0 p-0">
                        <li class="mb-4 text-white d-flex">
                           <i class="fa-solid fa-crown fa-2x me-3 text-success" aria-hidden="true"></i>
                           <div class="ps-2">
                              <h5 class="mb-3">Най-високо оценени</h5>
                              <p>Ние сме една от най-високо оценените фирми за недвижими имоти. Разполагаме с голяма
                                 аудитория от доволни клиенти и опит с много години назад.</p>
                           </div>
                        </li>
                        <li class="mb-4 text-white d-flex">
                           <i class="fa-solid fa-vial fa-2x me-3 text-success" aria-hidden="true"></i>
                           <div class="ps-2">
                              <h5 class="mb-3">Насладете се на качеството</h5>
                              <p>Ние можем да ви гарантираме, че за кратък срок от време ще намерим най-подходящия имот
                                 за вас, спрямо вашите внимателно изслушани изисквания.</p>
                           </div>
                        </li>
                        <li class="mb-4 text-white d-flex">
                           <i class="fa-brands fa-magento fa-2x me-3 text-success" aria-hidden="true"></i>
                           <div class="ps-2">
                              <h5 class="mb-3">Опитни агенти</h5>
                              <p>Без нашите агенти ние нямаше да бъдем такива, каквито сме сега. Разполагаме с
                                 най-добрите агенти на имоти на пазара до този момент и сме горди с този факт.</p>
                           </div>
                        </li>
                     </ul>
                  </div>
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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
   <!-- Изчисляване и задаване на размери за височината на всяка кутия от секцията "Какво правим ние" за по-добър изглед на кутиите. Височината се определя спрямо кутията с най-много информация в нея и се прибавят още 30 пиксела. -->
   <script>
      // изчисляване на височината на кутиите
      var max_height = 0;
      $('.hover-bg-white').each(function () {
         if ($(this).height() > max_height) {
            max_height = $(this).height() + 30;
         }
      });

      // задаване на височина за всички кутии
      $('.hover-bg-white').css('height', max_height);

   </script>
</body>

</html>