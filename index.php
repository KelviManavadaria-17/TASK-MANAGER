<?php
include("config/constants.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
</head>
<body>
    <h1>Tasks Manager</h1>
   
   <div class="header">
    <a href="<?php echo LINK?>index.php">HOME</a>
    <a href="#">TO DO</a>
    <a href="#">DOING</a>
    <a href="#">DONE</a>
    <a href="<?php echo LINK?>manager.php">MANAGE TASKS</a>
</div>
    <br>
    <br>
    <!-- TO DISPLAY MESSAGE -->
    <p>
            <?php
                if(isset($_SESSION['add_task']))
                {
                    // display message 
                    echo $_SESSION['add_task'];
                    //session end
                    unset($_SESSION['add_task']);
                }
               
            ?>
            
        </p>
        <br>
        <br>
    <a href="<?php echo LINK?>add_task.php">ADD TASK</a>
    <br>
    <br>
<div class="all-task">
    <table>

    <tr>
    <td>SR.NO.</td>
    <td>TASK-NAME</td>
    <td>PRIORITY</td>
    <td>DEADLINE</td>
    <td>ACTION</td>

    </tr>
    <?php
          $db = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die("ERROR OCCURED");
          $db_connect=mysqli_select_db($db,DB_TABLENAME);
          $sql = "SELECT * FROM tdl_tasks";
          $result = mysqli_query($db,$sql);
          if($result==true)
          {
            $sr_variable=1;
            $count_row = mysqli_num_rows($result);
            if($count_row>0)
            {
                       while($rows=mysqli_fetch_assoc($result))
                       {
                            $task_id = $rows['task_id'];
                            $task_name = $rows['task_name'];
                            $task_description = $rows['task_description'];
                            $list_id	 = $rows['list_id	'];
                            $priority = $rows['priority'];
                            $deadline = $rows['deadline'];
                            ?>
                            <tr>
                                 <td><?php echo $sr_variable++ ?></td>

                                <td><?php echo $task_name?></td>
                                <td><?php echo $priority  ?></td>
                                <td><?php echo $deadline ?></td>


                                <td>
                                    <a href="#">UPDATE</a>
                                    <a href="#">DELETE</a>

                                </td>
                            </tr>
                            <?php



                       }
            }
            else
            {
                ?>
                    <tr>
                        <td>NO TASK ADDED</td>
                    </tr>



                <?php
            }
          }
    
    
    ?>
    <tr>
    <td>1.</td>
    <td>DESIGN A WEBSITE</td>
    <td>MEDIUM</td>
    <td>23/9/2021</td>
    <td>
        <a href="#">UPDATE</a>
        <a href="#">DELETE</a>

    </td>
    </tr>
    </table>

</div>

</body>
</html>