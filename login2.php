<!-- 
This Program was entirely written by Syed Fahad Nadeem
CPS 3740 Section 1
Project 2
Professor Austin Huang

MODIFIED FOR PERSONAL WEBSITE ON 10/26/2019

  -->

<?php 
include 'dbconfig.php';
echo "<title>Welcome</title>";

// Variables from form
@$username = mysqli_real_escape_string($con, $_POST['username']);
@$password = mysqli_real_escape_string($con, $_POST['password']);

// Making sure Users did not enter the page via URL
if($username == "" || $password == ""){
	mysqli_close($con);
	die("Username or password felids are empty. Please go back to <a href='index.html'>login page.</a>");
}

// Statement to get user's password to compare
$sql = "SELECT * FROM Users WHERE login='$username'";
$res = mysqli_query($con, $sql);
if(!$res){
	mysqli_close($con);
	die("Database Error! Please go back to the home page and try again");
}
$fetch = mysqli_fetch_array($res);
$id = $fetch['id'];
$name = $fetch['first_name'] . " " . $fetch['last_name'];
$passCheck = $fetch['password'];
$password = md5($password); //Password is encrypted with MD5 on database

// Authentication
if(!isset($fetch) || $password != $passCheck){
	mysqli_close($con);
	die("Incorrect Credentials. <a href='index.html'>Click here</a> to go back to login.");
}else{
//Setting cookie for when customer successfully logs in
setcookie('user', $id, time()+3600,"/");
setcookie('name', $name, time()+3600,"/");
}

//Logout function
echo "<a href='logout.php'>logout</a><br/>";

// Customer Information and Transactions
echo "Welcome Customer: " . $name . "<br>";
echo "<p> The transaction for customer " . $name;

// Table headers
echo <<< _HTML_BLOCK
<style type="text/css">
	table, tr, th{
		border: 1px solid black;
	}
</style>
<table>
	<tr>
		<th> Transaction ID </th>
		<th> Customer ID </th>
		<th> Source ID </th>
		<th> Account ID</th>
		<th> Type of Transaction </th>
		<th> Amount </th>
		<th> Transaction Date </th>
	</tr>
_HTML_BLOCK;

//Retreieve all transactions from Transactions table for this user
$sql = "SELECT * FROM Transactions WHERE cid=$id";
$res = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($res)){
	echo "<tr>";
	echo "<th>" . $row['tid'] . "</th>";
	echo "<th>" . $row['cid'] . "</th>";
	echo "<th>" . $row['sid'] . "</th>";
	echo "<th>" . $row['aid'] . "</th>";
	$type = $row['type'];
	$amount = $row['amount'];
	echo "<th>" . $type . "</th>";
	if($type == 'D'){
		echo "<th style='color: blue;'>" . $amount . "</th>";
	}
	else{
		echo "<th style='color: red;'>" . $amount . "</th>";
	}
	echo "<th>" . $row['mydatetime'] . "</th>";
	echo "</tr>";
}
echo "</table>";

// Calculates balance from all of the users accounts
$sum = 0;
$sql = "SELECT balance FROM Accounts WHERE cid=$id";
$res = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($res)){
	$sum += $row['balance'];
}
setcookie('balance', $sum, time()+3600,"/");
echo "<strong> Your Total Balance from all accounts is: $" . $sum . "</strong>";

mysqli_close($con);

//Addition of Add and open account
echo <<< _HTML_BLOCK
<br>
<form action='add_transaction.php' method='POST'>
<input type='submit' value='Add Transaction'>
</form>
<a href="open_account.php">Click here to open a new account</a>
_HTML_BLOCK;

 ?>