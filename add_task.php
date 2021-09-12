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
                

                     <select name="list_options">
                         
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
                         
                     </select>
                     
                 </td>
             </tr>
             <tr>
                 <td>PRIOPRITY</td>
                 <td>
                     <select name="" id="">
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