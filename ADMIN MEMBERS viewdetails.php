<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
require_once("mysql_connect_FA.php");
if ($_SESSION['usertype'] == 1) {

header("Location: http://".$_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF'])."/index.php");

}
if(isset($_POST['action'])){
    if($_POST['action']=="Reactivate Account"){
        $query1 = "UPDATE member
                  set USER_STATUS = 1
                  where MEMBER_ID = {$_POST['details']}  ";
    }
    else if($_POST['action']=="Deactivate Account"){
        $query1 = "UPDATE member
                  set USER_STATUS = 4
                  where MEMBER_ID = {$_POST['details']}  ";
    }
    mysqli_query($dbc,$query1);

}
$query = "SELECT * FROM member m join ref_department d
          on m.dept_id = d.dept_id 
          join civ_status c
          on m.civ_status = c.status_id
          where m.member_id = {$_POST['details']}";
$result = mysqli_query($dbc,$query);
$ans = mysqli_fetch_assoc($result);

$page_title = 'Loans - View Member Details';
include 'GLOBAL_TEMPLATE_Header.php';
include 'LOAN_TEMPLATE_NAVIGATION_Admin.php';
?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                
                    <div class="col-lg-12">
                        <form method = "POST" action = "ADMIN MEMBERS viewdetails.php">
                        <h1 class="page-header">
                            View Member Details
                           
                        </h1>
                    
                    </div>
                    
                </div>
                <!-- alert -->
                <div class="row">
                    <div class="col-lg-12">

                       <div class="row">

                            <div class="col-lg-12">

                                    <div class="panel panel-green">

                                        <div class="panel-heading">

                                            <b>Personal Information</b>

                                        </div>

                                        <div class="panel-body"><p>

                                            <b>ID Number: <?php echo $ans['MEMBER_ID']?></b> <p>
                                            <b>First Name: <?php echo $ans['FIRSTNAME']?></b> <p>
                                            <b>Last Name: <?php echo $ans['LASTNAME']?></b> <p>
                                            <b>Middle Name: <?php echo $ans['MIDDLENAME']?></b> <p>
                                            <b>Civil Status: <?php echo $ans['STATUS']?></b> <p>
                                            <b>Date of Birth: <?php echo $ans['BIRTHDATE']?></b> <p>
                                            <b>Sex:<?php if($ans['SEX']=="1")
                                                            echo "Male";
                                                            else
                                                                echo "Female";?></b> <p>
                                            
                                        </div>

                                    </div>

                                    <div class="panel panel-green">

                                        <div class="panel-heading">

                                            <b>Employment Information</b>

                                        </div>

                                        <div class="panel-body"><p>

                                            <b>Date of Hiring: <?php echo $ans['DATE_HIRED']?></b> <p>
                                            <b>Department: <?php echo $ans['DEPT_NAME']?></b> <p>

                                        </div>

                                    </div>

                                    <div class="panel panel-green">

                                        <div class="panel-heading">

                                            <b>Contact Information</b>

                                        </div>

                                        <div class="panel-body"><p>

                                            <b>Contact Number:</b> <p>
                                            <b>Home Phone Number: <?php echo $ans['HOME_NUM']?></b> <p>
                                            <b>Business Phone Number: <?php echo $ans['BUSINESS_NUM']?></b> <p>
                                            <b>Home Address: <?php echo $ans['HOME_ADDRESS']?></b> <p>
                                            <b>Business Address: <?php echo $ans['BUSINESS_ADDRESS']?></b> <p>
                                            <input type = "text" name = "details" value = <?php echo $_POST['details']?> hidden>
                                        </div>

                                    </div>

                                    <div class="panel panel-primary">

                                        <div class="panel-heading">

                                            <b>Actions</b>

                                        </div>

                                        <div class="panel-body"><p>
                                            <?php if($ans['USER_STATUS']=="4"){ 
                                                echo '<input type="submit" class="btn btn-success" name="action" value="Reactivate Account">';
                                                
                                            

                                            } else{
                                            echo '<input type="submit" class="btn btn-danger" name="action" value="Deactivate Account">';
                                             }?>
                                        </div>

                                    </div>
                                </form>
                                    <a href="ADMIN MEMBERS viewmembers.php" class="btn btn-default">Go Back</a><p><p>&nbsp;

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <script>

        $(document).ready(function(){
    
            $('#table').DataTable();

        });

    </script>

</body>

</html>
