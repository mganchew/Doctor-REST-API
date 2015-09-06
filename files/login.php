<?php
session_start();

$conn = mysqli_connect("localhost","root","","kursova");
if (mysqli_connect_errno())
{
echo "MySQLi Connection was not established: ". mysqli_connect_error();
}

if(isset($_POST['submit'])){
	$email =mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	if(!$_POST['email'] | !$_POST['password']){
		echo ("<script>
		window.alert('you did not complete all of the reqired fields')
		window.location.href='index.php'
		</script>");
		exit();
	}
	
 $sel_user = "select * from users where email='$email' AND password='$password' ";
//var_dump($sel_user);
  // exit();
   $run_user = mysqli_query($conn, $sel_user);
   
$check_user = mysqli_num_rows($run_user);
if($check_user>0){
$_SESSION['username']=$email;
echo "<script>window.open('home.php','_self')</script>";
}
else {
echo "<script>alert('Email or password is not correct, try again!')</script>";
}
}

?>