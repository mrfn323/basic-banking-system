<?php

// Checks if user is logged in, if not then it will not allow them in the page. 
if(!isset($_COOKIE['user'])){

	die("Cookies is not set. Please login <a href='index.html'>here</a>");

}

include 'dbconfig.php';

//Getting all variables needed
$sid = $_POST['sources'];
$amount = $_POST['amount'];
@$type = $_POST['type'];
$cid = $_COOKIE['user'];
$aid = $_POST['account'];
$date = date("Y-m-d H:i:s");

//Getting balance to be added later
$sql = "SELECT balance FROM Accounts WHERE cid=$cid AND id=$aid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res);
$balance = $row['balance'];

//Checking Variables
if($amount == 0 || $amount < 0){
	mysqli_close($con);
	die("ERROR. Amount entered either 0 or less than 0.");
}else if($sid == ''){
	mysqli_close($con);
	die("ERROR. No Source entered.");
}else if($type == ""){
	mysqli_close($con);
	die("ERROR. No Type selected. Open an account to add transactions to it.");
}

// Checking if transaction is a deposit or withdraw
if($type == "D"){
	$sql = "INSERT INTO Transactions (cid, sid, aid, type, amount, mydatetime) VALUES ($cid, $sid, $aid, '$type', $amount, '$date')";
}
else if($type == "W" || $amount <= $balance){
	$sql = "INSERT INTO Transactions (cid, sid, aid, type, amount, mydatetime) VALUES ($cid, $sid, $aid, '$type', ($amount * -1), '$date')";
	$amount = $amount * -1;
}else{
	die("Withdraw amount greater than or equal balance available");
}

// Executes insert Query and adds balance to accounts table
if(mysqli_query($con, $sql) == TRUE){
	echo "New record added ";
	$newBalance = $balance + $amount;

	// Query to add new balance to table
	$sql = "UPDATE Accounts SET balance=$newBalance WHERE id=$aid AND cid=$cid";
	if(mysqli_query($con, $sql) == TRUE){
		echo "and balance has been updated";
	}else{
		echo mysqli_error($con);
	}
	
}else{
	echo "Something went wrong. Go back to <a href='index.html'>login page.</a><br>";
	echo mysqli_error($con);
}		

echo "<br>Click <a href='index.html'>here</a> to go back to the main page";
mysqli_close($con);

?>