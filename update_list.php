<?php
//connect constant file
include("config/constants.php");

if(isset($_GET['list_id']))
{
      // connect database
    $db = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die("ERROR OCCURED");
    $db_connect=mysqli_select_db($db,DB_TABLENAME);
    $list_id =$_GET['list_id'];
    $sql = "SELECT * FROM tdl_list WHERE  list_id = '$list_id'";
    //execute query
    $result = mysqli_query($db,$sql);
    if($result==true)
    {
        //get value from user
        $row = mysqli_fetch_assoc($result);
        //to check whwteher it is correct or not
        //print_r($row);
        $list_name=$row['list_name'];
        $list_description=$row['list_description'];

    }
    else
    {
        // head to the manager page
        header('LOCATION:'. LINK."manager.php");

    }

}
else {
    
}
?>
<html>
<h1>Tasks Manager</h1>
       <a href="<?php echo LINK?>index.php">HOME</a>
       <a href="<?php echo LINK?>manager.php">MANAGE LIST</a>

      <h3>UPDATE LIST PAGE</h3>
      <?php
         if(isset($_SESSION['update_fail']))
         {
             // display message for list updated fail
             echo $_SESSION['update_fail'];
             //session end
             unset($_SESSION['update_fail']);
         }
      ?>
      <form action="" method="POST">
           <table>
                <tr>
                    <td>LIST NAME</td>
                    <td><input type="text" name="list_name"value="<?php echo $list_name?>" required></td>
                  
                </tr>
                <tr>
                    <td>LIST DESCRIPTION</td>
                    <td><textarea name="list_description" id="" cols="30" rows="5"><?php echo $list_description ?></textarea></td>
                    
                </tr>
                <tr>
                    <td><input type="submit" value="UPDATE" name="update"></td>
                </tr>
           </table>
       </form>
</html>


<?php

if(isset($_POST['update']))
{
    //get the updated values
    $list_name = $_POST['list_name'];
    $list_description = $_POST['list_description'];
    $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die("ERROR OCCURED");
    $db_conn2 = mysqli_select_db($conn2,DB_TABLENAME);
    $update_sql = "UPDATE tdl_list SET
    list_name = '$list_name',
    list_description = '$list_description'
    WHERE list_id = '$list_id'";
    $ans = mysqli_query($conn2,$update_sql);
    if($ans == true)
    {
        $_SESSION['update']="LIST UPDATED SUCCESSFULLY";
         header('LOCATION:'. LINK."manager.php");

    }
    else
    {
        $_SESSION['update_fail']="LIST UPDATION  FAILED";
        header('LOCATION:'. LINK."update_list.php".list_id);
    }
}

?>
