<?php
    session_start();
    include_once 'pdoAllusers.php';
      $name = $_SESSION['name'];
      $email = $_SESSION['email'];
      $username = $_SESSION['username'];
      $password = $_SESSION['password'];
      $balance = $_SESSION['balance'];
?>
<!DOCTYPE html>
<html>
<head>
      <title>Wallet Manager</title>
      <link rel="stylesheet" type="text/css" href="css/styleDash.css">
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
        <form action="showTable.php" method="POST">
        <h2>What's the date of Expense?</h2>
        <input type="date" name="date" required>
        <br><br>
        <button type="submit" name="view_expense">View / Delete Expense</button><br><br>
        </form>
        <button type="submit" name="add_expense" onclick="openPop();" style="padding:10px 10px 10px 125px">Add New Expense</button>
        <?php
        if ( isset($_SESSION["added_expense"]) ) 
        {
        echo('<b><p style="color:green;font-size:70%;">'.$_SESSION["added_expense"]."</p></b>");
        unset($_SESSION["added_expense"]);
        }

        ?>
        <?php
        include_once 'pdoAllusers.php';
        $stmt = $pdo->query("SELECT SUM(amount_spent) from $username");
        $spent = $stmt->fetchColumn();
        $currentBalance = $balance - $spent;
        $_SESSION['currentBalance'] = $currentBalance;
        ?>
        <h3>Current Balance: <?php echo $currentBalance;?></h3>
      </section>

      <section id="hacker_Mode">
        <h1 style="color:#009688">Hacker Mode:</h1>
        <img src="images/hack_img.png" height="150px" width="250px"><br><br>
        <a href="add.group.php"><button name="add_group">Add New Group</button></a><br><br>
        <a href="select.group.php"><button name="select_group" style="padding:10px 10px 10px 65px">Select Existing Group</button></a>
        
      </section>
  
      <!--TABLE-->
    
      
      <!--pop up modal -->
      <center>
      <div class="modal" id="modal">
            <div class="modal__dialog">
                  <section class="modal__content">
                        <a href="#" class="modal__close" onclick="exit()">&times;</a>
                        <h2 class="modal__title" style="color:#795548;">Enter Expense Details</h2>  
                              <form action="add.expense.php" method="POST">
                              <label for="date"><b>Date of Expense:</b> <input type="date" name="date_expense" required></label><br> <!--no date check-->
                              <br>
                              <label for="title"><b>Title:</b> <input type="text" name="title" required></label><br>
                              <?php
                              if ( isset($_SESSION["titleCheck"]) ) 
                              {
                              echo('<b><p style="color:red;font-size:70%;">'.$_SESSION["titleCheck"]."</p></b>");
                              }
                              elseif( isset($_SESSION["titletaken"]) ) 
                              {
                              echo('<b><p style="color:red;font-size:70%;">'.$_SESSION["titletaken"]."</p></b>");
                              }?>
                              <br>
                              <label for="description"><b>Description:</b><br>
                              <textarea rows="5" cols="30" name="description" required></textarea></label><br>
                              <?php
                              if ( isset($_SESSION["descriptionCheck"]) ) 
                              {
                              echo('<b><p style="color:red;font-size:70%;">'.$_SESSION["descriptionCheck"]."</p></b>");
                              }?><br>
                              <label for="Amount_spent"><b>Amount Spent: Rs</b><input type="number" name="amount_spent" required></label><br>
                              <?php
                              if ( isset($_SESSION["amountSpentCheck"]) ) 
                              {
                              echo('<b><p style="color:red;font-size:70%;">'.$_SESSION["amountSpentCheck"]."</p></b>");
                              }
                              if ( isset($_SESSION["amountExcessCheck"]) ) 
                              {
                              echo('<b><p style="color:red;font-size:70%;">'.$_SESSION["amountExcessCheck"]."</p></b>");
                              }
                              ?><br>
                              <button type="submit" name="add2table" id="add2table">Add Expense</button>
                              </form>
                              <br><br>
                  </section>
            </div>
      </div>
</center>
      <!--end pop up modal-->     
      

      <script type="text/javascript" src="javascript/popupModal.js"></script>
      <?php
       if ( isset($_SESSION["titleCheck"]) ) {
             echo "<script>openPop();</script>";
             unset($_SESSION["titleCheck"]);
             }
      elseif( isset($_SESSION["titletaken"]) ) {
             echo "<script>openPop();</script>";
             unset($_SESSION["titletaken"]);
             }
      elseif ( isset($_SESSION["descriptionCheck"]) ) {
             echo "<script>openPop();</script>";
             unset($_SESSION["descriptionCheck"]);
             }
      elseif ( isset($_SESSION["amountSpentCheck"]) ) {
             echo "<script>openPop();</script>";
             unset($_SESSION["amountSpentCheck"]);
             }
       elseif ( isset($_SESSION["amountExcessCheck"]) ) {
             echo "<script>openPop();</script>";
             unset($_SESSION["amountExcessCheck"]);
             } 

      ?>

</body>
</html>