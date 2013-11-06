<h2> Login</h2>
<form method='POST' action='/users/p_login'>
	Email &nbsp;<input type='text' name='email'><br>
	Password &nbsp;  <input type='password' name='password'><br>

	<?php if (isset($error)): ?>
		<div class='error'>
			Have you been drinking? If you're "sober" and you just forgot how to computer double check your email and password 'cause your login attempt failed.
		</div>
		<br>
	<?php endif; ?>

	<input type='Submit' value='Log In'>

</form>


