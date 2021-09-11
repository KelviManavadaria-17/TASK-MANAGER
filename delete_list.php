<?php
//connect constant file
include("config/constants.php");




if(isset($_GET['list_id']))
{

    // connect database
    $db = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die("ERROR OCCURED");
    $db_connect=mysqli_select_db($db,DB_TABLENAME);
    $list_id =$_GET['list_id'];
    $sql = "DELETE FROM tdl_list WHERE list_id = '$list_id'";
    
    $result = mysqli_query($db,$sql);
    $_SESSION['delete']="LIST DELETED SUCCESSFULLY";
    header('LOCATION:'. LINK."manager.php");
}
else
{
    $_SESSION['delete_fail']="LIST DELETION FAILED";
    header('LOCATION:'. LINK."manager.php");

}


?>