<?php if(isset($user)): ?>
	<h1>This is the profile for <?=$user?></h1>
<?php else: ?>
	<h1>No user has been specified</h1>
<?php endif; ?>