<div class="scanlines"></div>

<!-- Begin Header -->
<?php require("header.php"); ?>
<!-- End Header -->
<!-- Begin Wrapper -->
<div class="wrapper"><!-- Begin Intro -->
<div class="intro"><?= $intro; ?></div>

<!-- Begin Container -->
<div class="content box">

	<h1 class="title"><?= $song->getTitre(); ?></h1>
	
			<?php foreach ($song->getStrophes() as $strophe){  ?>
				<h3><?= $strophe->getType(). " ".$strophe->getIdentifiant(); ?></h3>
				<p><?= nl2br ($strophe->getTexte()); } ?></p>
	<div class="site-generator"><?= $song->getCopyright() ?></div>
</div>
<!-- End Container -->

<!-- Begin Sidebar -->
<div class="sidebar box">

	<div class="sidebox widget">
		<h3 class="widget-title">Actions</h3>
		<ul>
			<li><a target="_blank" href="<?= $this->relativeUrl("export", "chantToPdf", array("id"=>$song->getIdChant())) ?>">Exporter ce chant en PDF</a></li>
		</ul>
	</div>
	
	<div class="sidebox widget">
		<h3 class="widget-title">Recherche</h3>
		<form class="searchform" method="post" action="<?= $this->relativeUrl("chant", "search") ?>">
			<input type="text" name="keywords" type="text" placeholder="tapez et appuyez sur Entr&eacute;e"/>
		</form>
	</div>
	<div class="sidebox widget">
		<h3 class="widget-title">Recueils</h3>
		<ul>
		<?php $i=1;
foreach ($recueils as $recueil){  ?>
			<li><a href="<?= $this->relativeUrl("recueil", "show", array("id"=>$recueil->getIdRecueil())) ?>"><?= $recueil->getNomRecueil();?></a></li>
		<?php ++$i; } ?>
		</ul>
	</div>

</div>
<!--End Sidebar -->
<div class="clear"></div>

</div>
<!-- End Wrapper -->


<!-- Begin Footer -->  <?php require("footer.php"); ?> <!-- End Footer --> 
<script type="text/javascript" src="style/js/scripts.js"></script>