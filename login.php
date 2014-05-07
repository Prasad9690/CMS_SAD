<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	
	if(logged_in()) {
		redirect_to("adminpanel.php");
	}
	
	include_once("includes/form_functions.php");
	
	//START FORM PROCESSING
	if(isset($_POST['submit'])) {  // Form has been submitted
		$errors = array();
		
		//perform validation on forms data
		$fields_with_lenghts = array('username' => 30, 'password' => 30);
		$errors = array_merge($errors,check_max_field_lengths($fields_with_lenghts,$_POST));
		
		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		$hashed_password = sha1($password);
		
		if(empty($errors)) {
			$query = "SELECT id,username FROM users WHERE username='{$username}' AND hashed_password='{$hashed_password}' LIMIT 1";
			$result_set = mysql_query($query);
			confirm_query($result_set);
			if(mysql_num_rows($result_set) == 1) {
				// username/password authentication
				// and only 1 match
				$found_user = mysql_fetch_array($result_set);
				$_SESSION['user_id'] = $found_user['id'];
				$_SESSION['username'] = $found_user['username'];
				
				redirect_to("adminpanel.php");
			} else {
				// username/password combination was not found in the database
				$message = "Username/password combination incorrect. <br />
							Please make sure your caps lock key is off and try again.";
			}
		}
	} else {
		if (isset($_GET['logout']) && $_GET['logout'] == 1) {
		$message = "You are now logged out.";
	}
		$username = "";
		$password = "";
	}
?>
<?php include("includes/header.php") ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<a href="index.php">Return to the main site</a>
			<br />
		</td>
		<td id="page">
			<h2>Staff Login</h2>
			<?php if(!empty($message)) { echo "<p class=\"message\">" . $message . "</p>"; } ?>
			<?php if(!empty($error)) { display_error($errors); } ?>
			<form action="login.php" method="post">
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username" maxlength="30" required="required" value="<?php echo htmlentities($username); ?>" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password" maxlength="30" required="required" value="<?php echo htmlentities($password); ?>" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="Login" /></td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>
