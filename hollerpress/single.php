<?php $theme_options = get_option('hp_options'); ?>
<?php get_header(); ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<section class='blog'>
			<!--<section class='post-sidebar-cta'>
				<div>
				Sharing widgets go here
				</div>
			</section>-->
			<article>
				<header>
					<h1><a href='#'><?php the_title(); ?></a></h1>
					<p>Posted on <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('F jS, Y'); ?></time></p>
				</header>
				<section>
					<?php the_content(); ?>
				</section>
			</article>
		</section>
		<?php if( isset($theme_options['post_cta']) ){ 
			if( strlen(trim($theme_options['post_cta'])) > 0 ){ ?>
		<section class='post-cta'>
			<?= $theme_options['post_cta'] ?>
		</section>
		<?php } } if( 'open' == $post->comment_status ){ ?>
		<section class='comments'>
			<!--<h3>Please Leave A Comment!</h3>
			<section>
				<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-num-posts="10" data-width="649"></div>
			</section>-->
			<?php comments_template(); ?>
		</section>
		<?php } ?>
		<?php endwhile; ?>
		<nav class="pagination">
			<span class="previous"><?php previous_post_link('&larr; %link'); ?></span>
			<span class="next"><?php next_post_link('%link &rarr;'); ?></span>
		</nav>
	<?php get_footer(); ?>