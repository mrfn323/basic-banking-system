<?php
// Checks if user  is logged in
if(!isset($_COOKIE['user'])){

    die("You are not logged in. Please login <a href='index.html'>here</a>");

}

// HTML Form for account creation. 
echo "<h1>Open Account</h1>";
echo "Please select the account you would like to open: ";
echo "<form action='account_create.php' method='POST'>";
echo "<select name='account_type'>";
echo "<option value=''></option>";
echo "<option value='Checkings'>Checkings</option>";
echo "<option value='Savings'>Savings</option>";
echo "</select>";
echo "<input type='submit' value='Submit'>";
echo "</form>";


?>