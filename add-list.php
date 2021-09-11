<?php
include("config/constants.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD LIST</title>
</head>
<body>
       <h1>Tasks Manager</h1>
       <a href="index.php">HOME</a>
       <a href="manager.php">MANAGE LIST</a>

      <h3>ADD LIST PAGE</h3>
       <!-- form to add list -->
       <form action="" method="POST">
           <table>
                <tr>
                    <td>LIST NAME</td>
                    <td><input type="text" name="list_name"placeholder="Type list name"></td>
                  
                </tr>
                <tr>
                    <td>LIST DESCRIPTION</td>
                    <td><textarea name="list_description" id="" cols="30" rows="5" placeholder="Type list descrption"></textarea></td>
                </tr>
                <tr>
                    <td><input type="submit" value="SAVE" name="save"></td>
                </tr>
           </table>
       </form>
</body>
</html>




<?php

if(isset($_POST['save']))
{
    $list_name = $_POST['list_name'];
    $list_description=$_POST['list_description'];
    // connect database
    $db = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die("ERROR OCCURED");
    
     $db_connect=mysqli_select_db($db,DB_TABLENAME);
    //check if database is connected successfully
    // if($db_connect==true)
    // {
    //     echo "databse connected";
    // } 


    //query to put in database
    $sql = "INSERT INTO tdl_list (list_name,list_description) VALUES ('$list_name','$list_description')";
    $result = mysqli_query($db,$sql);
     
    if($result==true)
    {
        // redirect to manage page
        header( "task_manager/manager.php");
    }
    else
    {
        // redirect to same page
    }


    
}

?>