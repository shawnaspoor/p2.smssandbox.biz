

<?php foreach ($users as $user): ?>
	<!-- list the site uers names-->
	<div class = "follow">

		<?=$user['first_name']?> <?=$user['last_name']?>
	</div>

	<!--look at db info, if there is a relationship give an unfollow option -->
	<?php if(isset($connections[$user['user_id']])): ?>
		<a class="btn btn-primary" href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>
	

	<!--if no relationship exists give an option to create one -->
	<?php else: ?>
		<a class="btn btn-primary" href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
	<?php endif; ?>
	<hr>
	<br><br>
    
<?php endforeach; ?>

