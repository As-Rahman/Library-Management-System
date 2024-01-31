<?php
session_start();
error_reporting(0);
include('includes/config.php');
echo '<script> console.log(' . $_SESSION['alogin'] . ')</script>';
if ($_SESSION['login'] != '') {
  $_SESSION['login'] = '';
  // header('location: dashboard.php');
}
if (isset($_POST['login'])) {
  //code for captach verification
  if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
    echo "<script>alert('Incorrect verification code');</script>";
  } else {
    $email = $_POST['emailid'];
    $password = md5($_POST['password']);
    $sql = "SELECT EmailId,Password,StudentId,Status FROM tblstudents WHERE EmailId=:email and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
      foreach ($results as $result) {
        $_SESSION['stdid'] = $result->StudentId;
        if ($result->Status == 1) {
          $_SESSION['login'] = $_POST['emailid'];
          echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
        } else {
          echo "<script>alert('Your Account Has been blocked .Please contact admin');</script>";
        }
      }
    } else {
      echo "<script>alert('Invalid Details');</script>";
    }
  }
}

if (isset($_POST['complainSubmit'])) {

  $email = $_POST['useremail'];
  $complain = $_POST['complain'];
  // echo "<script>alert('" . $email . "');</script>";

  $sql = "INSERT INTO complain(email,complain,status) VALUES(:email,:complain,0)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->bindParam(':complain', $complain, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);

  if ($query->rowCount() > 0) {
    echo '<script>alert("Successfully inserted your complain")</script>';
  } else {
    echo "<script>alert('There is an problem');</script>";
  }
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

  <title>Central Library</title>
  <link rel="shortcut icon" href="../assets/img/logo.png">

  <link href="assets/css/bootstrap.css" rel="stylesheet" />

  <link href="assets/css/font-awesome.css" rel="stylesheet" />

  <link href="assets/css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/aos/aos.css">



</head>

<body>

  <?php include('includes/header.php'); ?>
  <!-- <marquee>This text will scroll from right to left</marquee> -->






  <div class="container-wrapper">
    <div class="container" class="text-align:center">
      <h1 style="text-align:center" class="title"></h1>
      <!-- <h1 style="text-align:center" class="title">Welcome to the BSFMSTU Central Library</h1> -->
    </div>
    <div class="container" style="margin-top:10px;">
      <div class="row" style="margin: 0 auto">
        <div class="col-md-3 catalog-home">
          <div class="img"><img src="./assets/img/reading.png" style="height: 50px" alt=""></div>
          <div>
            <h3>Library Timing</h3>
            <div><b>Sunday - Thursday:</b> 9.00AM to 5.00PM</div>
            <div>Friday,Saturday and Govt holydays are closed.</div>
          </div>
        </div>
        <div class="col-md-3 col-md-offset-1 catalog-home" style="background-color: #097dab;">
          <div class="img"><img src="./assets/img/resources.png" style="height: 50px" alt=""></div>
          <h3>E-Resources</h3>
          <div>
            <p>We have 100+ online journals in different discipline and access by online.</p>
          </div>
        </div>
        <div class="col-md-3 col-md-offset-1 catalog-home">
          <div class="img"><img src="./assets/img/remote.png" style="height: 50px" alt=""></div>
          <h3>Remote Access</h3>
          <div>
            <p>Remote access is a cloud-based service that allows users to access digital resources such as eDatabases, eJournals, and eBooks anytime anywhere.</p>
          </div>
        </div>

      </div>

    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div>
            <h3 style="font-family:'Marcellus SC'" class="border-style"><b>About Library</b></h3>
          </div>
          <div style=" text-align: justify;">
            <p>
              Central Library continues to expand and develop its services and take new initiatives throughout the year to facilitate students to learn and acquire knowledge. The library continues to keep its focus on making library services more accessible and fulfilling the need of the students and faculty.
              All the students and faculty members of BSFMSTU have full access to the central library. The library hosts a vast and diverse collection of books, journals, monographs and periodicals of academic interest. Each book is labeled and arranged in such a manner that any individual can get access to his preferred book, without any inconvenience.
            </p>
          </div>
        </div>
      </div>
    </div>


    <div class="container">
      <div>
        <h3 style="font-family:'Marcellus SC'" class="border-style "><b>Library Gallary</b></h3>
      </div>
      <div class="row row-homepage">

        <div class="col-md-12 col-sm-12  col-xs-12 col-md-offset-1" style="margin:10px;padding:0">

          <div id="carousel-example" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner">
              <div class="item active">

                <img src="assets/img/1.jpg" style="margin: auto; width: 100%;height:400px;" alt="" />
                <div class="carousel-caption">

                  <p>Nothing is pleasanter than exploring a library.</p>
                </div>

              </div>
              <div class="item">
                <img src="assets/img/2.jpg" style="margin: auto;width: 100%;height:400px;" alt="" />
                <div class="carousel-caption">

                  <p>When in doubt go to the library.</p>
                </div>
              </div>
              <div class="item">
                <img src="assets/img/3.jpg" style="margin: auto;width: 100%;height:400px;" alt="" />
                <div class="carousel-caption">

                  <p>The only thing that you absolutely have to know, is the location of the library."</p>
                </div>
              </div>
            </div>
            <!--INDICATORS-->
            <ol class="carousel-indicators">
              <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example" data-slide-to="1"></li>
              <li data-target="#carousel-example" data-slide-to="2"></li>
            </ol>
            <!--PREVIUS-NEXT BUTTONS-->
            <a class="left carousel-control" href="#carousel-example" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div>
        </div>
      </div>
    </div>


    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div>
            <h3 style="font-family:'Marcellus SC'" class="border-style "><b>Library Collections</b></h3>
          </div>
          <div>
            The Central Library offered services through books and journals are shown below at a glance.
            <ul>
              <li>Books 21,000 (Approximately)</li>
              <li>E-Journals 30,000 (Approximately)</li>
              <li>E-books 20,500 (Approximately)</li>
            </ul>
            (E-journals & e-books subscribed through LiCoB and UDL, UGC).
            <p></p>
            <p>
              Besides, BSFMSTU students and faculty members can access 71,196 e-books and 41,172 e-journals via Research4life database which covers five important databases of different subject areas (HINARI, AGORA, ARDI, OARE and GOALI) at free of cost.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div>
            <h3 style="font-family:'Marcellus SC';" class="border-style"><b>E-resources access</b></h3>
          </div>
          <div>
            BSFMSTU Central Library supports its users and patrons in their studies, research and teaching through providing access to e-resources. Some leading databases are mentioned below:
            <ul>
              <li><a href="https://www.emerald.com/insight/register">Emerald Insites</a></li>
            </ul>
            <p>
              The institute has access to 197 Journals from Emerald. The subject-wise breakdown of the journals is:
            </p>
            <ul>
              <li>Accounting, Finance & Economics - 24 Journals</li>
              <li>Business, Management & Strategy - 31 Journals</li>
              <li>Education - 14 Journals</li>
              <li>Engineering - 26 Journals</li>
              <li>Health & Social Care - 6 Journals</li>
              <li> HR, Learning & Organization Studies - 19 Journals</li>
              <li>Information & Knowledge Management - 11 Journals</li>
              <li>Library & Information Sciences - 16 Journals</li>
              <li>Marketing - 16 Journals</li>
              <li>Operations, Logistics & Quality - 12 Journals</li>
              <li>Property Management & Built Environment - 11 Journals</li>
              <li>Public Policy & Environmental Management - 8 Journals</li>
              <li>Tourism & Hospitality Management – 3 Journals</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div>
            <h3 style="font-family:'Marcellus SC'" class="border-style "><b>Helplines</b></h3>
          </div>
          <div class="row">
            <div class="col-md-3  col-xs-12">
              <h4 style="font-family:'Marcellus SC';color:green"><b>Library Card/Fine/E-Resources</b></h4>
              <p><b>Md. Mahbubur Rahman
                </b></p>
              <p>Additional Librarian</p>
              <p><b>Email:</b><a href="mailto:mahbub@library.bsfmstu.ac.bd">mahbub@library.bsfmstu.ac.bd</a></p>
              <p><b>Tel:</b>Ext. 126/+88041769468-75</p>
            </div>
            <div class=" col-md-3 col-md-offset-1 col-xs-12">
              <h4 style="font-family:'Marcellus SC';color:green"><b>Theses/Question Bank</b></h4>
              <p><b>Md. Mehedi Hasan
                </b></p>
              <p>Assistant Librarian</p>
              <p><b>Email:</b><a href="mailto:mehedi@library.bsfmstu.ac.bd">mehedi@library.bsfmstu.ac.bd</a></p>
              <p><b>Tel:</b>Ext. 127/+88041769468-75</p>
            </div>
            <div class="col-md-4 col-md-offset-1 col-xs-12">
              <h4 style="font-family:'Marcellus SC';color:green"><b>Library Password/Library Website/IT</b></h4>
              <p><b>Rezaul Karim Shibly
                </b></p>
              <p>Assistant Programmer</p>
              <p><b>Email:</b><a href="mailto:shibly@library.bsfmstu.ac.bd">shibly@library.bsfmstu.ac.bd</a></p>
              <p><b>Tel:</b>Ext. 133/+88041769468-75</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row" style="margin: 40px 0px;">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <div>
        <h3 style="font-family:'Marcellus SC';text-align:center;margin:20px 10px" class="border-style "><b>Submit your Complain</b></h3>
      </div>
      <div class="panel panel-info">

        <div class="panel-body">
          <form role="form" method="post">

            <div class="form-group">
              <label>Enter your Email</label>
              <input class="form-control" type="email" name="useremail" autocomplete="off" required />
            </div>
            <div class="form-group">
              <label>Enter your complain:</label>
              <textarea class="form-control" name="complain" id="complain" cols="30" rows="10" required></textarea>

            </div>
            <div class="text-center">
              <button type="submit" name="complainSubmit" class="btn btn-info">Submit </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  </div>

  <?php include('includes/footer.php'); ?>

  <script src="assets/js/jquery-1.10.2.js"></script>

  <script src="assets/js/bootstrap.js"></script>

  <script src="assets/js/custom.js"></script>
  <script src="assets/js/dataTables/jquery.dataTables.js"></script>
  <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>

  <script src="assets/aos/aos.js"></script>
  <script src="assets/aos/anime.min.js"></script>
  <!-- <script src="assets/aos/typeit.js"></script> -->
  <script src="assets/aos/typeit.js
"></script>

  <script>
    AOS.init();




    new TypeIt('.title', {
      strings: 'Welcome to the BSFMSTU Central Library',
      speed: 50,
      afterComplete: function(instance) {
        instance.destroy();
      }
    }).go();
  </script>
</body>

</html>