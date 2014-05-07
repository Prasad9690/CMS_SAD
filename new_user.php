<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	include_once("includes/form_functions.php");
	
	//START FORM PROCESSING
	if(isset($_POST['submit'])) {  // Form has been submitted
		$errors = array();
		
		//perform validation on forms data
		$fields_with_lenghts = array('username' => 30, 'password' => 30);
		$errors = array_merge($errors,check_max_field_lengths($fields_with_lenghts,$_POST));
		
		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));

		$hashed_password = sha1($password); //used for hashing the password
		if(strlen($username) < 6 or strlen($password) < 6) {
			$message = "Username and Password must be atleast 6 characters long";
		} else {
			if(empty($errors)) {
				$query = "INSERT INTO users(username,hashed_password) VALUES ('{$username}','{$hashed_password}')";
				$result = mysql_query($query,$connection);
				if($result) {
					$message = "The user was successfully created.";
				} else {
					$message = "The user could not be created.";
					$message .= "<br />" . mysql_error();
				}
			} else {
				if(count($errors) == 1) {
					$message = "There was 1 error in the form.";
				} else {
					$message = "There were " . count($errors) . " errors in the form.";		
				}
			}
		}
	} else {
		$username = "";
		$password = "";
	}
?>
<?php include("includes/header.php") ?>

<table id="structure">
	<tr>
		<td id="navigation">
			<a href="adminpanel.php">Return to Menu</a>
			<br />
		</td>
		<td id="page">
			<h2>Create New User</h2>
			<?php if(!empty($message)) { echo "<p class=\"message\">" . $message . "</p>"; } ?>
			<?php if(!empty($error)) { display_error($errors); } ?>
			<form action="new_user.php" method="post">
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
					<td colspan="2"><input type="submit" name="submit" value="Create user" onclick = /></td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>
