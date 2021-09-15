<?php
//connect constant file
include("config/constants.php");




if(isset($_GET['task_id']))
{

    // connect database
    $db = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die("ERROR OCCURED");
    $db_connect=mysqli_select_db($db,DB_TABLENAME);
    $task_id =$_GET['task_id'];
    $sql = "DELETE FROM tdl_tasks WHERE task_id = '$task_id'";
    
    $result = mysqli_query($db,$sql);
    $_SESSION['delete_task']="TASK DELETED SUCCESSFULLY";
    header('LOCATION:'. LINK."index.php");
}
else
{
    $_SESSION['delete_fail_task']="task DELETION FAILED";
    header('LOCATION:'. LINK."index.php");

}


?>