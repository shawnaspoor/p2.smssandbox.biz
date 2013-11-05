		<?php foreach ($posts as $post): ?>

			<article>
 			
			<p><strong>Date posted</strong>: 	
 			<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
	        	<?=Time::display($post['created'])?>
	  		</time>
	  	
	  	    <p><?=$post['content']?></p>

	  		

			</article>


		<?php endforeach; ?>
		