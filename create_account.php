<?php
include 'dbconfig.php';

// Variables from Form
$username = mysqli_real_escape_string($con, $_POST["username"]);
$password = mysqli_real_escape_string($con, $_POST["password"]);
$fname = mysqli_real_escape_string($con, $_POST["fname"]);
$lname = mysqli_real_escape_string($con, $_POST["lname"]);
$address = mysqli_real_escape_string($con, $_POST["address"]);
$zipcode = mysqli_real_escape_string($con, $_POST["zipcode"]);
$state = mysqli_real_escape_string($con, $_POST["state"]);

//Checking if values are empty
if($address == ""){
    $address = "NULL";
}
if($zipcode == ""){
    $zipcode = 0;
}

//Confirm redirect was from createaccount.html
if($username == "" || $password == "" || $fname == "" || $lname == "" || $state == ""){

    mysqli_close($con);
    die("Please create an account <a href='createaccount.html'>here</a>");

}

//Adding the account to database
$sql = "INSERT INTO Users (login, password, role, first_name, last_name, address, zipcode, state) VALUES ('$username', md5('$password'), 'user', '$fname', '$lname', '$address', '$zipcode', '$state')";
if(mysqli_query($con, $sql) === TRUE){
    echo "Your account was successfully made! <a href='index.html'>Click here to login with your account</a>";
}else{
    echo "Something went wrong with the creation of your account. Try a different username. <a href='createaccount.html'>Click here</a> to go back to the create account page";
}

mysqli_close($con);

?>