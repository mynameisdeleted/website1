<html>
<title> PROFILE INFORMATION</title>
<body>
<?php
include  'stdinc.php';

//print "USER = " . $_POST["username"];
$user=$_POST["username"];
$pw=$_POST["password"];
login($user,$pw);
print "PROFILE INFORMATION<br><br>";

if($userinfo)
{
print "Click link below for your sharable user summary!<br><br>";
print "first name = " . $userinfo['firstname'] . "<br>";
print "last name = " . $userinfo['lastname'] . "<br>";
//print "age = " . $userinfo['age'] . "<br>";
psumary($userinfo['id']);
}
else
{
	print "failed login<br>";
}
plogout();
?>

</body>
</html>
