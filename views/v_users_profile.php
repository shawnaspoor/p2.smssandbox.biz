<?php if(isset($user)): ?>

	<div class="row-fluid">
		<div class="span12">
	    <h2>Welcome back <?=$user->first_name?>!</h2>
		
			<div  class ="row-fluid">
	
					<h3>Update your information here</h3>
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
								<input type='text'id="inputLastName" name='last_name' placeholder='<?php echo $user->last_name; ?>'>
							</div>
						</div>
						<div class="control-group">
							<label class ="control-label" for="inputEmail">Email  &nbsp;</label>
							<div class="controls">
								<input type='text'id="inputEmail" name='email' placeholder='<?php echo $user->email; ?>'>
							</div>
						</div>
						
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-primary">Update Info</button>
							</div>
							<br>
						</div>
					</form>
					<br>
		<h4>Add a photo</h4>

			<form action="/users/profile_photo" method="post" enctype="multipart/form-data" >
			<input type="file" name="avatar"> <input type='submit'>				
			</form>
			
			</div>
	

</form>	
			</div>
		</div>
	</div>
<?php else: ?>
    <h1>No user specified</h1>
<?php endif; ?>







