<div class="scanlines"></div>

<!-- Begin Header -->
<?php require("header.php"); ?>
<!-- End Header -->
<!-- Begin Wrapper -->
<div class="wrapper"><!-- Begin Intro -->
<div class="intro"><?php echo $intro; ?></div>

<!-- Begin Container -->
<div class="content box">

	<h1 class="title"><?php echo $song->getTitre(); ?></h1>
	
			<?php foreach ($song->getStrophes() as $strophe){  ?>
				<h3><?php echo $strophe->getType(). " ".$strophe->getIdentifiant(); ?></h3>
				<p><?php echo nl2br ($strophe->getTexte()); } ?></p>
	<div class="site-generator"><?php echo $song->getCopyright() ?></div>
</div>
<!-- End Container -->

<!-- Begin Sidebar -->
<div class="sidebar box">

	<div class="sidebox widget">
		<h3 class="widget-title">Actions</h3>
		<ul>
			<li><a href="#">Ajouter à ma trame</a></li>
			<li><a target="_blank" href="<?php echo $this->relativeUrl("export", "chantToPdf", array("id"=>$song->getIdChant())) ?>">Exporter ce chant en PDF</a></li>
		</ul>
	</div>
	
	<div class="sidebox widget">
		<h3 class="widget-title">Recherche</h3>
		<form class="searchform" method="post" action="<?php echo $this->relativeUrl("song", "search") ?>">
			<input type="text" name="keywords" type="text" placeholder="tapez et appuyez sur Entr&eacute;e"/>
		</form>
	</div>

	<div class="sidebox widget">
		<h3 class="widget-title">Themes</h3>
		<ul>
			<li><a href="#">Nature</a></li>
			<li><a href="#">Photography</a></li>
			<li><a href="#">Video</a></li>
		</ul>
	</div>

</div>
<!--End Sidebar -->
<div class="clear"></div>

</div>
<!-- End Wrapper -->


<!-- Begin Footer -->  <?php require("footer.php"); ?> <!-- End Footer --> 
<script type="text/javascript" src="style/js/scripts.js"></script>