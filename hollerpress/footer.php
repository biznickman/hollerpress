	<?php $theme_options = get_option('hp_options'); ?>
	</section>
	<footer>
		<p>Copyright &copy; <?= date('Y')."  ".$theme_options['copyright']; ?></p>
	</footer>
	<div pub-key="pub-ecb6db0c-19a9-47dc-8dbc-a2a7055be4e6" sub-key="sub-1ca1b1c7-9fa0-11e0-b3a4-e75a79a44cb1" ssl="off" origin="pubsub.pubnub.com" id="pubnub"></div>
<?php wp_footer(); ?>
</body>
</html>