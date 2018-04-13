<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
require('db.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$contact = stripslashes($_REQUEST['contact']);
	$contact = mysqli_real_escape_string($con,$contact);
	$color = stripslashes($_REQUEST['color']);
	$color = mysqli_real_escape_string($con,$color);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$dob = stripslashes($_REQUEST['dob']);
	$dob = mysqli_real_escape_string($con,$dob);
	$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date,contact,color,dob)
VALUES ('$username', '".md5($password)."', '$email', '$trn_date','$contact','$color','$dob')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<input type="text" name="contact" placeholder="contact no." required />
<input type="email" name="email" placeholder="Email" required /><br><br>
<input type="date" name="dob" required /><br><br>
<br>Select password color:<br>
<select name="color">
  <option value="red">red</option>
  <option value="green">green</option>
  <option value="blue">blue</option>
  <option value="yellow">yellow</option>
  <option value="pink">pink</option>
  <option value="orange">orange</option>
  <option value="brown">brown</option>
  <option value="black">black</option>
</select><br>
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
<p>if already registered <a href='login.php'>login Here</a></p>
</div>

<?php } ?>
</body>
</html>