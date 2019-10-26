<?php 

// Unsets all cookies
setcookie('user',"",time()-3600,"/");
setcookie('name',"",time()-3600,"/");
setcookie('balance',"",time()-3600,"/");

echo "You have been logged out. Redirecting you to the login page.....";

// For dramitic effect :p
sleep(2);

echo "<a href='index.html'>Click here </a> if you have not been redirected";

// Redirects to main project page
header("Location: index.html");

 ?>