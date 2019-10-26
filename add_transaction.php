<?php

// Checks if user is logged in
if(!isset($_COOKIE['user'])){
	die("You are not logged in. Please login <a href='index.html'>here</a>");
}

// Variables needed for Add Transaction
$id = $_COOKIE['user'];
$custName = $_COOKIE['name'];
$balance = $_COOKIE['balance'];

echo "<a href='logout.php'>Logout</a>";
echo "<h1>Add Transaction </h1>";

// Form for data that needs to be inserted
echo "<form method='POST' action='insert_transaction.php'><br>";
include 'dbconfig.php';

// Display Accounts from user
echo "Select a Account: <select name='account'>";
echo "<option value=''></option>";
$sql = "SELECT id, type FROM Accounts WHERE cid = $id";
$res = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($res)){
	echo $row['id'];
	echo $row['type'];
	echo "<option value='" . $row['id'] ."'>" . $row['type'] . "</option>";
}
echo "</select>"; 

// Display rest of inputs required
echo "<br><input type='radio' value='D' name='type'> Deposit";
echo "<input type='radio' value='W' name='type'> Withdraw <br>";
echo "Amount: <input type='number' name='amount' min='0.01' step='0.01' required><br>";

//Gets all Sources from Sources Table and displays it in a dropdown menu
echo "Select a Source: <select name='sources' >";
echo "<option value=''></option>";
$sql = 'SELECT * FROM Sources';
$res = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($res)){
	echo "<option value='" . $row['id'] ."'>" . $row['name'] . "</option>";
}
echo "</select>"; 
echo "<br><input type='submit'>";
echo "</form>";

mysqli_close($con);
?>