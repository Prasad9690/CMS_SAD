<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in() ?>
<?php find_selected_page(); ?>

<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<?php echo navigation($sel_subject, $sel_page); ?>
		</td>
		<td id="page">
			<h2>Add Subject</h2>
			<form action="create_subject.php" method="post">
				<p>Subject name: 
					<input type="text" name="menu_name" value="" id="menu_name" required="required" />
				</p>
				<p>Position: 
					<select name="position">
						<?php
							$subject_set = get_all_subjects();
							$subject_count = mysql_num_rows($subject_set);
							// $subject_count + 1 b/c we are adding a subject
							for($count=1; $count <= $subject_count+1; $count++) {
								echo "<option value=\"{$count}\">{$count}</option>";
							}
						?>
					</select>
				</p>
				<p>Visible: 
					<input type="radio" name="visible" value="0" required="required"/> No
					&nbsp;
					<input type="radio" name="visible" value="1" required="required" /> Yes
				</p>
				<input type="submit" value="Add Subject" />
			</form>
			<br />
			<a href="content.php">Cancel</a>
		</td>
	</tr>
</table>
<?php require("includes/footer.php"); ?>
