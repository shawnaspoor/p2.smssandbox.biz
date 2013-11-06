<?php foreach ($posts as $post): ?>



	
		<div class="post">
	    <h3><?=$post['first_name']?> <?=$post['last_name']?> posted:</h3>

	    <p><?=$post['content']?></p>

	    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
	        <?=Time::display($post['created'])?>
	    </time>
	</div>
	


<?php endforeach; ?>