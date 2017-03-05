
	<div class="scanlines"></div>
	
	<?php require("header.php"); ?>

<!-- Begin Wrapper -->
<div class="wrapper"><!-- Begin Intro -->
<div class="intro"><?php if(isset($intro)){ echo $intro; } ?></div>
<!-- Begin Blog Grid -->
<div class="blog-wrap">
	<!-- Begin Blog -->
	<div class="blog-grid">
			<?php foreach($songs as $song){
					switch ($song->getTypeLien()) {
						case "mp3":
							require("song_with_audio.php");
							break;
						case "youtube":
							require("song_with_youtube.php");
							break;
						case "vimeo":
							require("song_with_vimeo.php");
							break;
						case "video":
							require("song_with_video.php");
							break;
						case "image":
							require("song_with_image.php");
							break;
						default:
							require("song_without_media.php");
					}
				}?>
 	</div>
	<!-- End Blog -->
</div>
<!-- End Blog Grid -->

</div>
<!-- End Wrapper -->

	<?php require("footer.php"); ?>