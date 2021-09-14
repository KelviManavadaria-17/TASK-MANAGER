<?php
include("config/constants.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD TASK</title>
</head>
<body>
    <h1>Tasks Manager</h1>
    <a href="<?php echo LINK?>index.php">HOME</a>
    <h3>ADD TASK PAGE</h3>
    <!-- TO DISPLAY MESSAGE -->
    <p>
            <?php
                if(isset($_SESSION['add_fail_task']))
                {
                    // display message for fail
                    echo $_SESSION['add_fail_task'];
                    //session end
                    unset($_SESSION['add_fail_task']);
                }
               
            ?>
            
        </p>
    <form action="" method="POST">
        <table>
            <tr>
                <td>TASK NAME</td>
                <td> <input type="text" name="task_name" palceholder="task_name"></td>
            </tr>
            <tr>
                    <td>TASK DESCRIPTION</td>
                    <td><textarea name="task_description" id="" cols="30" rows="5" placeholder="Type task descrption"></textarea></td>
            </tr>
             <tr>
                 <td>SELECT LIST</td>
                 <td>
                 
                     <select name="list_options" id="">
                    
                         
                     <?php
                            
                            $db = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die("ERROR OCCURED");
                            $db_connect=mysqli_select_db($db,DB_TABLENAME);
                            $sql = "SELECT * FROM tdl_list";
                            $result = mysqli_query($db,$sql);
                            
                            if($result==true)
                            {
                                  // count number of rows
                                  $count_rows = mysqli_count_rows($db);
                                  if($count_rows>0)
                                  {
                                       // display all rows
                                       while($row = mysqli_fetch_assoc($db))
                                       {
                                          print_r($row);
                                           $list_id = $row['list_id'];
                                           $list_name = $row['list_name'];
                                           ?>
                                               <option value="<?php echo $list_id?>"><?php echo $list_name?></option>
                                                  
                                           <?php
                                       }

                                  }
                                  else
                                  {
                                      //display none as option

                                      ?>
                                      <option value="0">NONE</option>
                                      <?php
                                  }
                            }
                           
                        ?>
                        <option value="0"></option> 
                     </select>
                     
                 </td>
             </tr>
             <tr>
                 <td>PRIOPRITY</td>
                 <td>
                     <select name="priority" id="">
                         <option value="high">HIGH</option>
                         <option value="medium">MEDIUM</option>
                         <option value="low">LOW</option>
                     </select>
                 </td>
             </tr>
             <tr>
                 <tr>DEADLINE</tr>
                 <tr><input type="date" name="deadline" id=""></tr>
             </tr>
             <tr>
                 <td><input type="submit" name = "submit"value="SAVE"></td>
             </tr>
        </table>
    </form>
</body>
</html>



<?php

if(isset($_POST['submit']))
{
    $task_name = $_POST['task_name'];
    $task_description=$_POST['task_description'];
    $list_id=$_POST['list_options'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];
    //connect database
    $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die("error");
    //select database
    $select2=mysqli_select_db($conn2,DB_TABLENAME) or die("error");

    $sql2="INSERT INTO tdl_task (task_name,task_description,list_id,priority,deadline) VALUES ('$task_name','$task_description','$list_options','$priority','$deadline')";
    
    $executee = mysqli_query($conn2,$sql2);

    if($executee==true)
    {
        $_SESSION['add_task']="LIST ADDED SUCCESSFULLY";
        
        // redirect to home page
        header('LOCATION:'.LINK."index.php");
       

    }
    else
    {
         // create a session to dispaly message
         $_SESSION['add_fail_task']="LIST FAILED TO ADDED";
         // redirect to same page
         header('LOCATION:'. LINK."add_task.php");
    }

    






    
}

?>