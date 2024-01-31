<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from tblbooks  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Category deleted scuccessfully ";
        header('location:manage-books.php');
    }


?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Central Library | Issued Books</title>
        <link rel="shortcut icon" href="../assets/img/logo.png">

        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/extra/css/jquery.dataTables.min.css
">
        <link rel="stylesheet" href="assets/extra/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="assets/extra/css/responsive.dataTables.min.css">
    </head>

    <body>

        <?php include('includes/header.php'); ?>

        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <img src="./assets/img/issued_books.png" class="img-responsive" style="height: 40px;" alt="Add category" srcset="">
                        <h4 class="header-line title">Issued Books</h4>
                    </div>


                    <div class="row">
                        <div class="col-md-12">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Issued Books
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Book Name</th>
                                                    <th>ISBN </th>
                                                    <th>Issued Date</th>
                                                    <th>Return Date</th>
                                                    <th>Fine in(Taka)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sid = $_SESSION['stdid'];
                                                $sql = "SELECT tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by tblissuedbookdetails.id desc";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {               ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->BookName); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->ISBNNumber); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->IssuesDate); ?></td>
                                                            <td class="center"><?php if ($result->ReturnDate == "") { ?>
                                                                    <span style="color:red">
                                                                        <?php echo htmlentities("Not Return Yet"); ?>
                                                                    </span>
                                                                <?php } else {
                                                                                    echo htmlentities($result->ReturnDate);
                                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="center"><?php echo htmlentities($result->fine); ?></td>

                                                        </tr>
                                                <?php $cnt = $cnt + 1;
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
        </div>


        <?php include('includes/footer.php'); ?>

        <!-- ============JS================== -->
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

    </body>

    </html>
<?php } ?>