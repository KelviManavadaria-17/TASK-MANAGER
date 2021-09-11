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
    <button>ADD TASK</button>
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