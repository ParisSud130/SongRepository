			
 		<!-- Begin Standard Format -->
 		<div class="post format-standard box"> 
			<h2 class="title">
			 <a href="<?= $this->relativeUrl("song", "show", array("id"=>$song->getIdChant())) ?>"><?= $song->getTitre() ?></a>
			 <span style="float: right;">
			     <a href="<?= $this->relativeUrl("recueil", "show", array("id"=>$song->getRecueil()->getIdRecueil())) ?>"><?= $song->getRecueil()->getNomRecueil()."</a> #".$song->getNumChant() ?>
			 </span>
			</h2>
			<p><?= $song->getStrophe(0)->getTexte() ?> ...</p>
			
			<div class="details">
				<span class="icon-standard"><?= $song->getDateModification() ?></span>
				<span class="seen"><a href="#" class="likeThis"><?= $song->getNbConsultations() ?></a></span>
			</div>
	
		</div>
		<!-- End Standard Format --> 	