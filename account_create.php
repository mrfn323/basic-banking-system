<!-- This file is for the creation of a Checkings or Savings account for the user. -->
<?php
// Checks if user is logged in
if(!isset($_COOKIE['user'])){

    die("You are not logged in. Please login <a href='index.html'>here</a>");

}

// Variables needed
$type = $_POST['account_type'];
$id = $_COOKIE['user'];

// Checks if user came via URL
if($id == ""){
    die("<a href='index.html'>Please Login.</a>");
}else if($type==""){
    die("You did not select an option");
}

include 'dbconfig.php';

// SQL State ment top check if the user already has an account
$sql = "SELECT * FROM Accounts WHERE cid=$id AND type='$type'";
$res = mysqli_query($con, $sql);
if(mysqli_num_rows($res)>0){
    mysqli_close($con);
    die("You already have a " . $type . " account. <a href='login2.php'>Click here</a> to go to the main menu.");
}else{

    // If user does not have an account, Inserts into Accounts table with user's ID.
    $sql = "INSERT INTO Accounts (type, cid, balance) VALUES ('$type', $id, 0)";
   if(mysqli_query($con, $sql)){
    echo $type . " account created!";
    echo "<a href='login2.php'>Click here</a> to go to the main menu.";
   }else{
    echo "Something went wrong :(. <a href='login2.php'>Click here</a> to go to the main menu.";
   }

}

mysqli_close($con);

?>