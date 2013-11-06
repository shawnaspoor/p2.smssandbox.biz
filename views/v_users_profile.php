<?php if(isset($user)): ?>

	<div class="row-fluid">
		<div class="span12">
	    <h2>Welcome back <?=$user->first_name?>!</h2>
		
			<div  class ="row-fluid">
				<div class="profile span6">
	
					<h4>Update your information here</h4>
					<form class="form-horizontal" method='Post' action='/users/p_profile_update'>
						<div class="control-group">
							<label class ="control-label" for="inputFirstName">First Name &nbsp;</label>
							<div class="controls">
								<input type='text' id="inputFirstName" name='first_name' placeholder='<?php echo $user->first_name; ?>'>
							</div>
						</div>
						<div class="control-group">
							<label class ="control-label" for="inputLastName">Last Name &nbsp;</label>
							<div class="controls">
								<input type='text' id="inputLastName" name='last_name' placeholder='<?php echo $user->last_name; ?>'>
							</div>
						</div>
						<div class="control-group">
							<label class ="control-label" for="inputEmail">Email  &nbsp;</label>
							<div class="controls">
								<input type='text' id="inputEmail" name='email' placeholder='<?php echo $user->email; ?>'>
							</div>
						</div>
						
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-primary">Update Info</button>
							</div>
							<br>
							
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

						</div>
					</form>
				
				
					<br>
					
			</div>		
		
		 
		 
		 
		
				<div class="profile span6">
							
					<h4>Who doesn't like a profile photo?</h4>
			
					<?php if ($user->avatar =='placeholder.jpg'): ?>
						display <img src="/uploads/avatars/example.gif" alt="Camera Shy Photo">';
					 <?php endif; ?>
					<img class="avatar" src="<?= $user->avatar ?>" alt="<?=$user->first_name ?>"><br> <br>
		
			 
					<form action="/users/profile_photo" method="post" enctype="multipart/form-data" >
					<input class="btn btn-default" type="file" name="avatar">
					<input class="btn btn-success" type='submit'>
					</form>
		
				</div>
	     	
			</div>
		</div>
	</div>
	
<?php else: ?>
    <h1>No user specified</h1>
<?php endif; ?>







