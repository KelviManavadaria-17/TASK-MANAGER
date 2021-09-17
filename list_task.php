<?php
include("config/constants.php");
$list_id_url =$_GET['list_id'];
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
    <a href="<?php echo LINK?>add_task.php">ADD TASK</a>
    <table>
        <tr>
           <td> SR.NO</td>
           <td>TASK NAME</td>
           <td>PRIORITY</td>
           <td>DEADLINE</td>
            <td>ACTION</td>

        </tr>
        <?php
        $db = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die("ERROR OCCURED");
        $db_connect=mysqli_select_db($db,DB_TABLENAME);
        $sql = "SELECT * FROM tdl_tasks WHERE list_id = '$list_id_url'";
        $result = mysqli_query($db,$sql);
        if ($result==true)
        {
            
           $count_rows = mysqli_num_rows($result);
            if($count_rows >0)
            {
                $c = 0;
                while($row = mysqli_fetch_assoc($result))
                {
                    
                    $task_id = $row['task_id'];
                    $task_name = $row['task_name'];
                    $priority  = $row['priority'];
                    $deadline  = $row['deadline'];
                     $c++;

                    ?>
                     <tr>
                         <td><?php echo $c?></td>
                         
                         <td><?php echo $task_name?></td>
                         <td><?php echo $priority?></td>
                         <td><?php echo $deadline?></td>
                         <a href="<?php echo LINK?>update_task.php?list_id=<?php echo $task_id?>">UPDATE</a>
                         <a href="<?php echo LINK?>delete_task.php?list_id=<?php echo $task_id?>">DELETE</a>





                     </tr>  
                           
                    <?php
                }

            }
            else
            {
                echo "NO DATA FOUND";
            }
        }
        ?>

        
    </table>
</body>
</html>