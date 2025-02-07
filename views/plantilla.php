<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!--=============== REMIXICONS ===============-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">

   <!--=============== CSS ===============-->
   <link rel="stylesheet" href="views/assets/css/styles.css">
   <link rel="stylesheet" href="views/assets/css/yimi.css">


   <!-- jQuery -->
   <script src="views/assets/js/jquery.js"></script>


   <title>POS Venta</title>
</head>

<body>




   <!-- Incluyendo aside y navbar -->
   <?php
   include "plantillaComponentes/header.php";
   include "plantillaComponentes/sidebar.php";
   ?>


   <!--=============== MAIN ===============-->
   <main class="main container" id="main">
      <?php include "views/dashboard.php"; ?>
   </main>






   <!-- Para cargar el contenido dinamico  -->
   <script>
      function cargarContenido(paginaPhp, main) {
         $("." + main).load(paginaPhp);

      }
   </script>



   <!--=============== MAIN JS ===============-->
   <script src="views/assets/js/main.js"></script>
</body>

</html>