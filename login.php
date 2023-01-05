<?php
include_once('config.php');

if (isset($_POST['logsubmit'])) {
    $email = $_POST['logemail'];
    $password = $_POST['logpass'];
    $encrypted = md5($password);

    $sql = "SELECT * FROM regis WHERE email = '$email' AND password = '$encrypted'";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);



    if($row['email'] == $email && $row['password'] == $encrypted){
        session_start();
        $_SESSION['logemail'] = $email;
        $_SESSION['logpass'] = $row['password'];
        header('location:index.html');
    }else{
        echo "Username or passwrd is wrong";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Log In / Sign Up</title>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css'>
	<link rel="stylesheet" href="./style.css">

</head>

<body>
	<!-- partial:index.partial.html -->
	<div class="section">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section pb-5 pt-5 pt-sm-2 text-center">
						<h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
						<input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
						<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-4 pb-3">Log In</h4>
											<form method="POST" action="login.php" method="post" name="loginform">
												<div class="form-group">
													<input type="email" name="logemail" class="form-style"
														placeholder="Your Email" id="logemail" required>
													<i class="input-icon uil uil-at"></i>
												</div>
												<div class="form-group mt-2">
													<input type="password" name="logpass" class="form-style"
														placeholder="Your Password" id="logpass" required>
													<i class="input-icon uil uil-lock-alt"></i>
												</div>
												<a href="index.html"><button type="submit" class="btn mt-4"
														name="logsubmit">Submit</button></a>
												<p class="mb-0 mt-4 text-center"><a href="#0" class="link">Forgot your
														password?</a></p>
											</form>
										</div>
									</div>
								</div>
								<div class="card-back">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-3 pb-4">Sign Up</h4>
											<form method="POST" action="login.php" method="post" name="regisform">
												<div class="form-group">
													<input type="text" name="fullname" class="form-style"
														placeholder="Your Full Name" id="fullname"
														required>
													<i class="input-icon uil uil-user"></i>
												</div>
												<div class="form-group mt-2">
													<input type="text" class="form-style"
														placeholder="Username" id="user" name="user"
														required>
													<i class="input-icon uil uil-user-check"></i>
												</div>
												<div class="form-group mt-2">
													<input type="email" name="email" class="form-style"
														placeholder="Your Email" id="email" required>
													<i class="input-icon uil uil-at"></i>
												</div>
												<div class="form-group mt-2">
													<input type="password" class="form-style"
														placeholder="Your Password" id="pass" name="pass"
														required>
													<i class="input-icon uil uil-lock-alt"></i>
												</div>
												<div class="form-group mt-2">
													<input type="text"  class="form-style"
														placeholder="Your Country" id="country" name="country" required>
													<i class="input-icon uil uil-globe"></i>
												</div>
												<button type="submit" class="btn mt-4" name="regsubmit"
													value="Add">Submit</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- partial -->
	<script src="./script.js"></script>


</body>

</html>
<?php
// Check If form submitted, insert form data into users table.
if (isset($_POST['regsubmit'])) {
	$fullname = $_POST['fullname'];
	$username = $_POST['user'];
	$email = $_POST['email'];
	$password = md5($_POST['pass']);
	$country = $_POST['country'];


	// include database connection file
	include_once("config.php");

	// Insert user data into table
	$result = mysqli_query($mysqli, "INSERT INTO regis(fullname,username,email,password,country)
VALUES('$fullname','$username','$email','$password','$country')");

	// Show message when user added
	echo "Register success.";
}
?>