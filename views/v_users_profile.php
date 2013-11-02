<?php if(isset($user)): ?>
    <h2>Welcome back <?=$user->first_name?>!</h2>
<?php else: ?>
    <h1>No user specified</h1>
<?php endif; ?>

