<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link href="vendor/jquery.bootgrid-1.3.1/jquery.bootgrid.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="vendor/jquery.bootgrid-1.3.1/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="vendor/jquery.bootgrid-1.3.1/jquery.bootgrid.min.js"></script>
  </head>
  <body>
    <?php
        include 'template/mainmenu.html';
    ?>

    <script type="text/javascript" language="JavaScript">
        $(window).load(function () {
            $("li").removeClass();
            $("#hom").addClass("active");
        });
    </script>
  </body>
</html>
