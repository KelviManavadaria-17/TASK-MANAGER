<?php
include("config/constants.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manager</title>
</head>


<body>
      <h1>Tasks Manager</h1>
      <a href="<?php echo LINK?>index.php">HOME</a>
      <h3>MANAGE LIST PAGE</h3>
       <!-- TO DISPLAY MESSAGE -->
       <p>
            <?php
                if(isset($_SESSION['add']))
                {
                    // display message for list added
                    echo $_SESSION['add'];
                    //session end
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete']))
                {
                    // display message for list added
                    echo $_SESSION['delete'];
                    //session end
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['delete_fail']))
                {
                    // display message for list added
                    echo $_SESSION['delete_fail'];
                    //session end
                    unset($_SESSION['delete_fail']);
                }
               
            ?>
            
        </p>

      <a href="<?php echo LINK?>add-list.php">ADD LIST</a>
       <div class="all-lists">
           <table>
           <tr>
               <td>SR.NO</td>
               <td>LISTS-NAME</td>
               <td>ACTION</td>
               

           </tr>

           <!-- display data from database -->
           <?php
              //connect the database

              $db = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die("ERROR OCCURED");
               $db_connect=mysqli_select_db($db,DB_TABLENAME);

               //sql query to dispaly data
               $sql = "SELECT * FROM tdl_list";
               $result = mysqli_query($db,$sql);
               // check whether the query executed or not
               if($result==true)
               {
                  //to get total number of row
                  $count_row = mysqli_num_rows($result);
                  $sr_variable=1;
                 // echo $count_row;
                 // check whwther there is data in datbase or not
                 if($count_row>0)
                 {
                      while($rows=mysqli_fetch_assoc($result))
                      {
                          // get individual data
                            $list_id = $rows['list_id'];
                            $list_name = $rows['list_name'];
                           ?>
                            <tr>
                                <td><?php echo $sr_variable++ ?></td>
                                <td><?php echo $list_name?></td>
                                <td>
                                    <a href="#">UPDATE</a>
                                    <a href="<?php echo LINK?>delete_list.php?list_id=<?php echo $list_id?>">DELETE</a>

                                </td>
                            </tr>

                           <?php
                            
                      }

                 }
                 else
                 {
                     ?>
                     <tr>
                         <td fullspan>NO LIST ADDED</td>
                         

                
                     </tr>
                     <?php
                 }
                

               }
               

           ?>
           
            </table>
       </div>
</body>
</html>