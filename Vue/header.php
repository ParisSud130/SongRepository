<!-- Begin Header -->
<div class="header-wrapper opacity">
	<div class="header">
		<!-- Begin Logo -->
		<div class="logo">
		    <a href="index.php">
				<img src="Vue/style/images/small-logo-white.png" alt="<?php echo $title; ?>" />
			</a>
	    </div>
		<!-- End Logo -->
		<!-- Begin Menu -->
		<div id="menu-wrapper">
			<div id="menu" class="menu">
			
			<?php
				if(isset($_SESSION['valid_user'])){
					if ($_SESSION['valid_user']===true && isset($_SESSION['login'])){
						?>
						<ul id="tiny">
							<li title=""><a href="#">Bienvenue <?php echo $_SESSION["login"] ?></a></li>
							<li><a href="index.php?c=profile&m=logout">Se d&eacute;connecter</a></li>
						</ul>
						<?php
					}
				}
				else{
					require("login.php");
				}
			?>
			</div>
		</div>
		<div class="clear"></div>
		<!-- End Menu -->
	</div>
</div>
<!-- End Header -->

