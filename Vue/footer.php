<!-- Begin Footer -->
<div class="footer-wrapper">
	<div id="footer" class="four">
		<div id="first" class="widget-area">
			<div class="widget widget_search">
				<h3 class="widget-title">Recherche</h3>
				<form class="searchform" method="post" action="<?php echo $this->relativeUrl("chant", "search") ?>" >
					<input type="text" name="keywords" type="text" placeholder="tapez et appuyez sur Entr&eacute;e"/>
				</form>
			</div>
		</div><!-- #first .widget-area -->
	
		<div id="second" class="widget-area">
			<div id="twitter-2" class="widget widget_twitter">
				<h3 class="widget-title">Social</h3>
				<ul class="social">
					<li><a class="facebook" href="https://www.facebook.com/egliseadventiste.deparissud"></a></li>
					<li><a class="twitter" href="https://twitter.com/ParisSud130?s=09"></a></li>
				</ul>
			</div>
		</div><!-- #second .widget-area -->
	
		<?php if(isset($mostViewedSongs)){ ?>
		<div id="third" class="widget-area">
		<div id="example-widget-3" class="widget example">
			<h3 class="widget-title">Chants les plus populaires</h3>
			<ul class="post-list">
			<?php $i=1;
				foreach($mostViewedSongs as $song){ 
			?>
					<li> 
						<div class="frame">
							<a href="<?php echo $this->relativeUrl("chant", "show", array("id"=>$song->getIdChant())) ?>"><img src="Vue/style/images/art/s<?php echo $i ?>.jpg" /></a>
						</div>
						<div class="meta">
							<h6><a href="<?php echo $this->relativeUrl("chant", "show", array("id"=>$song->getIdChant())) ?>"> <?php echo $song->getTitre() ?> </a></h6>
							<em>Vu <?php echo $song->getNbConsultations() ?> fois </em>
						</div>
					</li>
			<?php 	++$i; } ?>
			</ul>
		</div>
		</div><!-- #third .widget-area -->
		<?php }?>
		
		<div id="fourth" class="widget-area">
		<div class="widget widget_archive">
				<h3 class="widget-title">Contact</h3>
				<ul>
					<li><a href="http://maps.google.com/?q=11 Rue Auguste Perret, 94800 Villejuif" target="_blank">11-13 rue August Perret</a></li>
					<br/>
					<li><a href="tel:+33143313391">Tel: 01 43 31 33 91</a> </li>
					<li><a href="mailto:webmaster@parissud130.org">E-mail: webmaster@parissud130.org</a> </li>
					<li><a class="dribbble" href="http://www.parissud130.org/" target="_blank">www.parissud130.org</a></li>
				</ul>
			</div>
		</div><!-- #fourth .widget-area -->
	</div>
</div>
<div class="site-generator-wrapper">
	<div class="site-generator">Copyright Obscura 2012. Design by <a href="http://elemisfreebies.com">elemis</a>. All rights reserved.</div>
</div>
<!-- End Footer --> 