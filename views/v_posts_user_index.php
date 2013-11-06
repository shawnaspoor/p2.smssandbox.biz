		<?php foreach ($posts as $post): ?>

			<article>
	 			<div  class="post" >
					<p><strong>Date posted</strong>: 	
		 			<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
			        	<?=Time::display($post['created'])?>
			  		</time>
			  	
			  	    <p><?=$post['content']?></p>

		  		</div>

			</article>


		<?php endforeach; ?>
		