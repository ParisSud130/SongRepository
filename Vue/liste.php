	<div class="scanlines"></div>
	
	<?php require("header.php"); ?>

<!-- Begin Wrapper -->
<div class="wrapper">
<div class="intro"><?php if(isset($intro)){ echo $intro; } ?></div>



<!-- Begin Container -->
<div class="content format-chat box">
	<ul>
		<?php foreach($songs as $song){ ?>
			
		 <li><a href="<?= $this->relativeUrl("chant", "show", array("id"=>$song->getIdChant())) ?>"><?= $song->getNumChant()." - ".$song->getTitre() ?></a></li>
		<?php 	}?>
	</ul>
</div>
<!-- End Container -->

<!-- Begin Sidebar -->
<div class="sidebar box">

	<div class="sidebox widget">
		<h3 class="widget-title">Recherche</h3>
		<form class="searchform" method="post" action="<?php echo $this->relativeUrl("chant", "search") ?>">
			<input type="text" name="keywords" type="text" placeholder="tapez et appuyez sur Entr&eacute;e"/>
		</form>
	</div>

</div>
<!--End Sidebar -->
<div class="clear"></div>

</div>
<!-- End Wrapper -->

	<?php require("footer.php"); ?>