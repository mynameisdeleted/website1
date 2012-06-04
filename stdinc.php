<?php
include 'sql.php';
session_start();
	function plogin ()
	{
	print "<a href='login.php'>LOGIN</a>";
	}
	function plogout()
	{
		print "<a href='login.php'>LOGOUT</a>";
	}
	function psumary($uid)
	{
		print "<a href='sumary.php?id=" . $uid . "'> click here to go to sharable user sumary	</a><br>";
	}
	function errormsg($msg){
		print "ERROR!!!! " . $msg . "<br>";
	}
	function login($username,$password){
		global $userinfo;
		$result=mysql_query("select * from users where username='" . $username . "' and password = '" . $password . "'");
		if($row1=mysql_fetch_array($result)){
			$cookie=rand();
			$id=$row1['id'];
			$rr2=mysql_query("select max(sessionid) from sessions");
			$rr2=mysql_fetch_array($rr2);
			$sesid=$rr2[0] + 1;
			//print "session id " . $sesid;	
			$_SESSION['sesid']=$sesid;
			$_SESSION['cookie']=$cookie;
			$lgnq="insert into sessions values ( " . $sesid . ", " . $id . ", " . $cookie . ")";
			mysql_query($lgnq);	


        		$result=mysql_query("select * from users where id = " . $id );
        		if($userinfo=mysql_fetch_array($result)){

                		print "<br> WELCOME " . $userinfo['firstname'] . " " . $userinfo['lastname'] . "<br><br>";
        		}



		}else
		{
		  errormsg("invalid login");	
			plogin();
			exit;
		}
	}

	function sumarize($id){
		//print $id;
		global $userinfo;
		$result=mysql_query("select * from users where id = " . $id );
	        if($userinfo=mysql_fetch_array($result)){
			//print $userinfo['firstname'];
			print "<table>";	
			print "<tr><td>firstname: </td><td>" . $userinfo['firstname'] . "</td></tr>";
                        print "<tr><td>lastname:  </td><td>" . $userinfo['lastname']  . "</td></tr>";
                        print "<tr><td>age:       </td><td>" . $userinfo['age']       . "</td></tr>";
			$qq="select count(id) from users where age = " . $userinfo['age'];
			//print  "<br>" . $qq ;
			$result=mysql_query($qq);
			$rr1=mysql_fetch_array($result);
			
                        print "<tr><td>how many users this age: </td><td>" . $rr1[0]  . "</td></tr>";
			print "</table>";
		}else{
			errormsg("invalid userid");
			exit;
		}
	}



	
if ( $_SESSION['sesid']   )
{

	$query = "select userid from sessions where cookie = " . $_SESSION['cookie'] . " and sessionid = " . $_SESSION['sesid'] ;
	$result=mysql_query($query);
	$row1=mysql_fetch_array($result);
	$userid=$row1[0];
	$result=mysql_query("select * from users where id = " . $userid );
	if($userinfo=mysql_fetch_array($result)){

		//print "<br> WELCOME " . $userinfo['firstname'] . " " . $userinfo['lastname'] . "<br><br>";
	}
}
?>
