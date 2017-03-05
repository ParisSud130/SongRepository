			
 		<!-- Begin Standard Format -->
 		<div class="post format-standard box"> 
			<h2 class="title"><a href="<?php echo $this->relativeUrl("song", "show", array("id"=>$song->getIdChant())) ?>"><?php echo $song->getTitre() ?></a></h2>
			<p><?php echo $song->getStrophes()[0]->getTexte() ?> ...</p>
			
			<div class="details">
				<span class="icon-standard"><?php echo $song->getDateModification() ?></span>
				<span class="seen"><a href="#" class="likeThis"><?php echo $song->getNbConsultations() ?></a></span>
			</div>
	
		</div>
		<!-- End Standard Format --> 	