<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else { ?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Central Library| User Dash Board</title>
    <link rel="shortcut icon" href="../assets/img/logo.png">
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/extra/css/jquery.dataTables.min.css
">
    <link rel="stylesheet" href="assets/extra/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/extra/css/responsive.dataTables.min.css">
    <link href="assets/css/hover-min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>

  <body>

    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
      <div class="container">
        <div class="row pad-botm">
          <div class="col-md-12">
            <img src="./assets/img/dashboard.png" class="img-responsive" style="height: 40px;" alt="Add category" srcset="">
            <h4 class="header-line title">DASHBOARD <span style="text-transform: lowercase ;">(<i><?php echo $_SESSION['login']; ?></i>)</span></h4>

          </div>

        </div>

        <div class="row">




          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-info back-widget-set text-center hvr-bounce-to-right" style="width: 100%;">
              <i class="fa fa-bars fa-5x"></i>
              <?php
              $sid = $_SESSION['stdid'];
              $sql1 = "SELECT id from tblissuedbookdetails where StudentID=:sid";
              $query1 = $dbh->prepare($sql1);
              $query1->bindParam(':sid', $sid, PDO::PARAM_STR);
              $query1->execute();
              $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
              $issuedbooks = $query1->rowCount();
              ?>

              <!-- <h3><?php echo htmlentities($issuedbooks); ?> </h3> -->
              <h3 id="issuedbooks"></h3>
              Book Issued
            </div>
          </div>

          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-warning back-widget-set text-center hvr-bounce-to-right" style="width: 100%;">
              <i class="fa fa-recycle fa-5x"></i>
              <?php
              $sql2 = "SELECT id from tblissuedbookdetails where StudentID=:sid and RetrunStatus IS NULL";
              $query2 = $dbh->prepare($sql2);
              $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
              // $query2->bindParam(':rsts', $rsts, PDO::PARAM_STR);
              $query2->execute();
              $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
              $notreturnedbooks = $query2->rowCount();
              ?>

              <!-- <h3><?php echo htmlentities($returnedbooks); ?></h3> -->
              <h3 id="notreturnedbooks"></h3>
              Books Not Returned Yet
            </div>
          </div>

          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-warning back-widget-set text-center hvr-bounce-to-right" style="width: 100%;">
              <i class="fa fa-recycle fa-5x"></i>
              <?php
              $rsts = 1;
              $sql2 = "SELECT id from tblissuedbookdetails where StudentID=:sid and RetrunStatus=:rsts";
              $query2 = $dbh->prepare($sql2);
              $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
              $query2->bindParam(':rsts', $rsts, PDO::PARAM_STR);
              $query2->execute();
              $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
              $returnedbooks = $query2->rowCount();
              ?>

              <!-- <h3><?php echo htmlentities($returnedbooks); ?></h3> -->
              <h3 id="returnedbooks"></h3>
              Return Books
            </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-warning back-widget-set text-center hvr-bounce-to-right" style="width: 100%;">
              <!-- <i class="fa fa-recycle fa-5x"></i> -->
              <i class="fa fa-gavel fa-5x"></i>

              <?php

              $sql2 = "SELECT * from tblissuedbookdetails where StudentID=:sid";
              $query2 = $dbh->prepare($sql2);
              $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
              $query2->execute();
              $results2 = $query2->fetchAll(PDO::FETCH_ASSOC);
              $cnt = 0;
              foreach ($results2 as $result) {
                if ($result['fine']) {
                  $cnt += $result['fine'];
                }
              }

              ?>

              <!-- <h3><?php echo htmlentities($cnt); ?></h3> -->
              <h3 id="fines"></h3>
              Total Fined Taka
            </div>
          </div>





        </div>



      </div>
    </div>

    <?php include('includes/footer.php'); ?>


    <script src="assets/js/countUp.js"></script>
    <script src=" assets/extra/jquery-3.7.0.js"></script>
    <!-- <script src="assets/js/jquery-1.10.2.js"></script> -->
    <script src="assets/js/custom.js"></script>
    <script src=" assets/extra/jquery.dataTables.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <!-- <script src="assets/js/dataTables/jquery.dataTables.js"></script> -->
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="assets/extra/dataTables.buttons.min.js"></script>
    <script src="assets/extra/jszip.min.js"></script>
    <script src="assets/extra/pdfmake.min.js"></script>
    <script src="assets/extra/vfs_fonts.js"></script>
    <script src="assets/extra/buttons.html5.min.js"></script>
    <script src="assets/extra/buttons.print.min.js"></script>
    <script src="assets/extra/dataTables.responsive.min.js"></script>


    <script src="assets/aos/aos.js"></script>
    <script src="assets/aos/anime.min.js"></script>
    <!-- <script src="assets/aos/typeit.js"></script> -->
    <script src="assets/aos/typeit.js
"></script>
    <script>
      let issuedbooks = '<?php echo $issuedbooks; ?>';
      let notreturnedbooks = '<?php echo $notreturnedbooks; ?>';
      let returnedbooks = '<?php echo htmlentities($returnedbooks); ?>';
      let fines = '<?php echo htmlentities($cnt); ?>';
      console.log(notreturnedbooks)

      // console.log(listdbooks)

      const countUp2 = new CountUp('issuedbooks', issuedbooks);
      const countUp3 = new CountUp('notreturnedbooks', notreturnedbooks);
      const countUp5 = new CountUp('returnedbooks', returnedbooks);
      const countUp4 = new CountUp('fines', fines);


      // console.log(listdbooks);

      countUp2.start();
      countUp4.start();
      countUp5.start();
      countUp3.start();
    </script>

  </body>

  </html>
<?php } ?>