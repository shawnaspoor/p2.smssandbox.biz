<h3>Join the fun</h3>

<form class="form-horizontal" method='Post' action='/users/p_signup'>
	<div class="control-group">
		<label class ="control-label" for="inputFirstName">First Name &nbsp; </label>
		<div class="controls">
			<input type='text' id="inputFirstName" name='first_name'>
		</div>
	</div>
	<div class="control-group">
		<label class ="control-label" for="inputLastName">Last Name &nbsp;</label>
		<div class="controls">
			<input type='text' id="inputLastName" name='last_name'>
		</div>
	</div>
	<div class="control-group">
		<label class ="control-label" for="inputEmail">Email &nbsp;</label>
		<div class="controls">
			<input type='text' id="inputEmail" name='email'>
		</div>
	</div>
	<div class="control-group">
		<label class ="control-label" for="inputPassword">Password &nbsp;</label>
		<div class="controls">
			<input type='password' id="inputPassword" name='password'>
		</div>
	</div>
	
	
	
	 <?php if(isset($error) && $error == 'blank-fields'): ?>
        <div>
           <p>Oopsy. It appears you're missing required info. Please fill out all fields.</p> 
        </div>
        

    <?php endif; ?>


    <?php if(isset($error) && $error == 'email-exists'): ?>
        <div class='error'>
             <p>That email address already appears to exist.</p> 
        </div>
        
    <?php endif; ?>

	
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-primary">Sign Up</button>
		</div>
	</div>
</form>
