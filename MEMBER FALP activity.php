<?php
session_start();
require_once('mysql_connect.php');

    if ($_SESSION['usertype'] != 1) {

        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
        
    }

    $query = "SELECT MAX(LOAN_ID), LOAN_STATUS from loans where member_id = {$_SESSION['idnum']} ";
    $result = mysqli_query($dbc,$query);

    $row = mysqli_fetch_assoc($result);

    if($row['LOAN_STATUS'] = 1){ //checks if you have a pending loan

        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/MEMBER FALP failed.php");

    }
    
    $query = "SELECT * FROM LOANS where MEMBER_ID = {$_SESSION['idnum']} 
              AND loan_detail_id = 1 AND 	loan_status != 3";
    $result = mysqli_query($dbc,$query);
    $ans = mysqli_fetch_assoc($result);

    $query = "SELECT * FROM txn_reference where LOAN_REF = {$ans['LOAN_ID']} AND txn_type = 2";
    $result = mysqli_query($dbc,$query);

    $page_title = 'Loans - FALP Activity';
    include 'GLOBAL_TEMPLATE_Header.php';
    include 'LOAN_TEMPLATE_NAVIGATION_Member.php';
?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                
                    <div class="col-lg-12">

                        <h1 class="page-header">FALP Loan Activity</h1>
                    
                    </div>

                </div>

                    <div class="row">

                        <div class="col-lg-12">

                            <div class="panel panel-green">

                                <div class="panel-heading">

                                    <b>FALP Loan Payment Activity</b>

                                </div>

                                <div class="panel-body">

                                    <table class="table table-bordered">
                                        
                                        <thread>
											
                                            <tr>

                                            <td align="center"><b>Date</b></td>
                                            <td align="center"><b>Deducted Amount</b></td>
                                            <td align="center"><b>Status</b></td>

                                            </tr>

                                        </thread>

                                        <tbody>
											<?php
											
											
											while($ans= mysqli_fetch_assoc($result)){
											$dt = new DateTime($ans['TXN_DATE']);
											$date = $dt->format('d/m/Y');
											$amount = $ans['AMOUNT'];
											$status = "Complete";
											
											?>
                                            <tr>
											
                                            <td align="center"><?php echo $date;?></td>
                                            <td align="center">₱ <?php echo $amount;?></td>
                                            <td align="center">Completed</td>
											
                                            </tr>
											<?php } ?>
                                            

                                            

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="row">

                        <div class="col-lg-12">

                            <div align="center">

                            <a href="MEMBER FALP summary.php" class="btn btn-default" role="button">Go Back</a>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-12">

                            &nbsp;

                        </div>

                    </div>

                </div>

                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
    <?php include 'GLOBAL_TEMPLATE_Footer.php' ?>
