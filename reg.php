<html>
<title> REGISTRATION RESULT</title>
<body>
<?php
//include  'sql.php';
include 'stdinc.php';
$user=$_POST["username"];
$pw=$_POST["password"];
$pw2 = $_POST["password2"];
$firstname=$_POST["firstname"];
$lastname=$_POST["lastname"];
$age=$_POST["age"];
$SUCCESS=1;
if ($pw == "" )
{
	print "ERROR!!!   password can not be blank<br>";
	$SUCCESS=0;
}



if ($user == "" )
{
	print "ERROR!!! must enter a username<br>";
	$SUCCESS=0;
}



if( $pw != $pw2 )
{
	print "password missmatch<br>";
	$SUCCESS=0;
}



if ($firstname == "" )
{
        print "ERROR!!! must enter a first name<br>";
        $SUCCESS=0;
}


if ($lastname == "" )
{
        print "ERROR!!! must enter a last name<br>";
        $SUCCESS=0;
}


if ($age == "" )
{
        print "ERROR!!! must enter an age<br>";
        $SUCCESS=0;
}


if( $SUCCESS == 0 )
{
	plogin();
	exit;
}
$query='select max(id) from users';
//print $query;
$result=mysql_query($query);
if($row1=mysql_fetch_array($result))
{
 $newid = $row1[0]+1;
	$query2="insert into users values (" . $newid . ",'" . $user . "','" . $pw . "','" . $firstname . "','" . $lastname . "'," . $age . ")";
//	print $query2;
	$exists = mysql_query("select * from users where username = '" . $user . "'" );
	if (mysql_fetch_array($exists))
	{
		print "ERROR!!!!   user exists!!!<br>";
       		plogin(); 

		exit;
	}
	mysql_query($query2);
	print "SUCCESSFULLY REGISTERED " . $user .  " as " .  $lastname . ", " . $firstname . " age: " . $age;
//print "userid = " . $row1['id'] . "<br>";
}

?>
<br>
<a href="login.php"> Logout</a>

</body>
</html>
