<?php
    session_start();
    include_once 'pdoAllusers.php';
      $name = $_SESSION['name'];
      $email = $_SESSION['email'];
      $username = $_SESSION['username'];
      $password = $_SESSION['password'];
      $balance = $_SESSION['balance'];
      $currentBalance = $_SESSION['currentBalance'];
      $todaySpent = 0;

      if(isset($_POST['date']))
      {
        $date_expense = $_POST['date'];
        $_SESSION['date'] = $date_expense;
      }
      else
      {
        $date_expense = $_SESSION['date'];
      }
     
?>
<!DOCTYPE html>
<html>
<head>
      <title>Wallet Manager</title>
      <link rel="stylesheet" type="text/css" href="css/styleTable.css">
</head>
<body>
      <header>
            <h1><a href="index.php">Wallet Manager</a></h1>
            <form action="logout.inc.php" method="POST">
            <table>
                  <tr>
                        <td><?php
            if ( isset($_SESSION["username"]) ) {
             echo($_SESSION["username"]." | ");
             }
            ?></td>
                        <td><button type="submit" name="LogOut">Log out</button></td>
                  </tr>
            </table>
            </form>
      </header><br>
      
      
      <section id="normal_Mode"> 
        <h1 style="color:#009688">Normal Mode:</h1>
        <h2>Date of Expense: <?php echo $date_expense;?></h2>
            <?php
                  $stmt = $pdo->query("SELECT expense_id,title,description,amount_spent FROM $username WHERE date_expense = '$date_expense'");
                  if($stmt->rowCount() > 0)
                  {
                    echo "<table border='5'><tr>
                        <td>Title</td>
                        <td>Description</td>
                        <td>Amount Spent</td>
                        </tr>";
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                  {
                        echo "<tr><td>";
                        echo($row['title']);
                        echo("</td><td>");
                        echo($row['description']);
                        echo("</td><td>");
                        echo($row['amount_spent']);
                        echo("</td><td>");
                        echo ('<form action="delete.expense.php?expense_id='.$row['expense_id'].' "method="POST">
                        <button type="submit" name="delete_expense">Delete</button>
                        </form>');
                        echo("</td></tr>");
                        $todaySpent = $todaySpent + $row['amount_spent'];
                        
                  }
                        echo"<p>Total expense today: ". $todaySpent."</p>";
                  }
                  else
                  {
                    echo "<p style='color:black;'>No expenses for today!</p>";
                  }
  
                  
               echo "</table> ";   
            ?>
      <?php
        $stmt = $pdo->query("SELECT SUM(amount_spent) from $username");
        $spent = $stmt->fetchColumn();
        $currentBalance = $balance - $spent;
        $_SESSION['currentBalance'] = $currentBalance;
        ?>
        <h3>Current Balance: <?php echo $currentBalance;?></h3> 
      <a href="dashboard.php" style="font-size:100%;float:right;">Back to Dashboard</a>
      </section>

      <section id="hacker_Mode">
        <h1 style="color:#009688">Hacker Mode:</h1>
        <img src="images/hack_img.png" height="150px" width="250px"><br><br>
        <a href="add.group.php"><button name="add_group">Add New Group</button></a><br><br>
        <a href="select.group.php"><button name="select_group" style="padding:10px 10px 10px 65px">Select Existing Group</button></a>
        
      </section>
  
      <!--TABLE-->
    
      
      

      
      

</body>
</html>