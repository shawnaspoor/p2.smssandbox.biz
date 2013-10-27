<?php if($user): ?>

	<!--
	<pre>
		<?php print_r($user);
		?>
	</pre>
	-->
	Hello <?=$user->first_name; ?>
	
<?php else: ?>
	<p> It doesn't look like you're logged in. If you're not a member please <a href="/users/signup">sign up</a>.</p> 
	<p>Otherwise you're a member, logic, so login!</p>
	<form class="form-inline">
	  <input type="text" class="input-small" id="email" placeholder="Email">
	  <input type="password" class="input-small" id="password" placeholder="Password">
	  <button type="submit" class="btn btn-success">Join the party!</button>
	</form>
<?php endif; ?>

<!-- <h1>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h1> -->