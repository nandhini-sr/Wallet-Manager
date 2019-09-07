<?php
include_once 'pdoAllusers.php';
session_start();

    $username = $_SESSION['username'];
    $balance = $_SESSION['balance'];
    $current_balance = $_SESSION['currentBalance'];

    $title = $_POST['title'];
    $description = $_POST['description'];
    $amount_spent = $_POST['amount_spent'];
    $date_expense = $_POST['date_expense'];

if ( isset($_POST['add2table'])) 
{

    // Error Handlers
    // Check name 
    if(!preg_match("/^[a-zA-Z\s0-9]*$/", $title))
    {
        $_SESSION["titleCheck"] = "a-z A-Z 0-9 only valid";
        header("Location: dashboard.php");
        return;
    }

    else
    {
        //check description
        if(!preg_match("/^[a-zA-Z\s0-9]*$/", $description))
        {
            $_SESSION["descriptionCheck"] = "a-z A-Z 0-9 only valid";
            header("Location: dashboard.php");
            return;
        }

        else
        {
            //check amount_spent
            if($amount_spent<=0)
            {
                $_SESSION["amountSpentCheck"] = "Positive Expense only valid";
                header("Location: dashboard.php");
                return;
            }
            else
            {
                if($amount_spent>$current_balance)
                {
                    $_SESSION["amountExcessCheck"] = "No sufficient CASH in wallet";
                    header("Location: dashboard.php");
                    return;
                }

                else
                {
                    //check for same title
                $sql = "SELECT * from $username where title = :title";
                $result = $pdo->prepare($sql);
                $result->execute(array(
                    ':title' => $title
                ));
                if($result->rowCount()>0)
                {
                    //unique username always
                    $_SESSION["titletaken"] = "Your title is taken! Enter an unique title ";
                    header("Location: dashboard.php");
                    return;
                }
                else
                {
                    $sql = "INSERT INTO $username (title,description,amount_spent,date_expense) VALUES (:title, :description, :amount_spent,:date_expense)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(
                        ':title' => $title,
                        ':description' => $description,
                        ':amount_spent' => $amount_spent,
                        ':date_expense' => $date_expense
                    ));
                    $_SESSION["added_expense"] = "Expense Added successfully";
                    header( 'Location: dashboard.php' ) ;
                    return;
                }
                }
            }
        }
    }
}
else
{
    header("Location: dashboard.php?Click_Addnew_only");
    return;
}

?>

