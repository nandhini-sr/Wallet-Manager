<?php
include_once 'pdoAllusers.php';
session_start();

$username = $_SESSION['username'];
$balance = $_SESSION['balance'];

$expense_id = $_GET['expense_id'];

if(isset($_POST['delete_expense']))
{
	$sql = "DELETE FROM $username WHERE expense_id = :del";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':del' => $expense_id));
    header( 'Location: showTable.php?expense_deleted' ) ;
    return;
}

else
{
	header("Location: dashboard.php?Click_Delete_only");
    return;
}

?>