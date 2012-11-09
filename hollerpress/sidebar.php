<?php $theme_options = get_option('hp_options'); ?>
<div id='sidebar'>
	<?php 
	if( isset($theme_options['ads_snippet']) ){ 
		echo "<div id='ads-snippet'>";
		echo $theme_options['ads_snippet'];
		echo "</div>";
	}
	if( is_single() ){
		$related = "";
		$via = "";
		if( isset($theme_options['twitter_account']) ){
			$related = "data-related='$theme_options[twitter_account]'";
			$via = "data-via='$theme_options[twitter_account]'";
		}
	?>
	<?php if( isset($theme_options['post_sharing']) ){  ?>
	<div id='sharing' style='text-align:right;'>
		<!-- facebook -->
		<div class="fb-like" data-send="false" data-layout="box_count" data-width="450" data-show-faces="true"></div><br />
		<!-- twitter -->
		<a href="http://twitter.com/share" class="twitter-share-button" data-lang="en" data-count="vertical" <?php echo $related . ' ' . $via; ?> >Tweet</a><br />
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="http://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<!-- Google+ -->
		<!-- Place this tag where you want the share button to render. -->
		<div class="g-plus" data-action="share" data-annotation="vertical-bubble" data-height="60"></div><br />

		<script type="text/javascript">
		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'http://apis.google.com/js/plusone.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>

		<!-- LinkedIn -->
		<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
		<script type="IN/Share" data-counter="top"></script>
	</div>
	<?php } ?>
	
	<?php } ?>
</div>