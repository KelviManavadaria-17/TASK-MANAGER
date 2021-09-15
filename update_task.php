<?php
//connect constant file
include("config/constants.php");

if(isset($_GET['task_id']))
{
      // connect database
    $db = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die("ERROR OCCURED");
    $db_connect=mysqli_select_db($db,DB_TABLENAME);
    $task_id =$_GET['tasks_id'];
    $sql = "SELECT * FROM tdl_tasks WHERE  task_id = '$task_id'";
    //execute query
    $result = mysqli_query($db,$sql);
    if($result==true)
    {
        //get value from user
        $row = mysqli_fetch_assoc($result);
        //to check whwteher it is correct or not
        //print_r($row);
        $task_id = $rows['task_id'];
        $task_name = $rows['task_name'];
        $task_description = $rows['task_description'];
        $list_id	 = $rows['list_id	'];
        $priority = $rows['priority'];
        $deadline = $rows['deadline'];

    }
    else
    {
        
        // head to the index page
        header('LOCATION:'. LINK."index.php");

    }

}
else {
    
}
?>
<html>
<h1>Tasks Manager</h1>
       <a href="<?php echo LINK?>index.php">HOME</a>
       <a href="<?php echo LINK?>manager.php">MANAGE LIST</a>

      <h3>UPDATE TASK PAGE</h3>
      <?php
         if(isset($_SESSION['update_fail_task']))
         {
             // display message for task updated fail
             echo $_SESSION['update_fail_task'];
             //session end
             unset($_SESSION['update_fail_task']);
         }
      ?>
      <form action="" method="POST">
           <table>
           <tr>
                <td>TASK NAME</td>
                <td> <input type="text" name="task_name" palceholder="task_name" value="<?php echo $task_name?>"></td>
            </tr>
            <tr>
                    <td>TASK DESCRIPTION</td>
                    <td><textarea name="task_description" id="" cols="30" rows="5" placeholder="Type task descrption"><?php echo $task_description ?> </textarea></td>
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
                 <td><input type="submit" name = "update"value="UPDATE"></td>
             </tr>
           </table>
       </form>
</html>


<?php

if(isset($_POST['update']))
{
    //get the updated values
    $task_name = $_POST['task_name'];
    $task_description=$_POST['task_description'];
    $list_id=$_POST['list_options'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];
    $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die("ERROR OCCURED");
    $db_conn2 = mysqli_select_db($conn2,DB_TABLENAME);
    $update_sql = "UPDATE tdl_tasks SET
    task_name = '$task_name',
    task_description = '$task_description',
    list_id = '$list_id',
    priority = '$priority',
    deadline = '$deadline',
    WHERE task_id = '$task_id'";
    $ans = mysqli_query($conn2,$update_sql);
    if($ans == true)
    {
        $_SESSION['update_task']="TASK UPDATED SUCCESSFULLY";
         header('LOCATION:'. LINK."index.php");

    }
    else
    {
        $_SESSION['update_fail_task']="TASK UPDATION  FAILED";
        header('LOCATION:'. LINK."update_task.php".list_id);
    }
}

?>
