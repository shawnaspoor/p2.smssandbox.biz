<?php if($user): 
	header("Location: /users/profile"); ?>	
<?php else: ?>
<div class="row-fluid">
	<div class="span12">
		<p>Connect with your friends and stay up to speed on all the stuff that doesn't really matter you dirty little hipster.</p> 
		<p>If you're already one of the cool kids login.</p>

		<div  class ="row-fluid">
			<div class="signup span6">
				<?=$signupfrag;?>
			</div>

			<div class="login span6">
				<?=$loginfrag;?>
			</div>
		</div>
	<br>
	</div>
</div>

<?php endif; ?>


<!-- <h1>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h1> -->


