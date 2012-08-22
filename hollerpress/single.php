<?php get_header(); ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<section class='blog'>
			<article>
				<header>
					<h1><a href='#'><?php the_title(); ?></a></h1>
					<p>Posted on <time datetime="<?php the_date('N'); ?>"><?php the_date('F jS, Y'); ?></time></p>
				</header>
				<section>
					<?php the_content(); ?>
				</section>
			</article>
		</section>
		<?php if( 'open' == $post->comment_status ){ ?>
		<section class='comments'>
			<h3>Please Leave A Comment!</h3>
			<section>
				<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-num-posts="10" data-width="649"></div>
			</section>
		</section>
		<?php } ?>
		<?php endwhile; ?>
		<nav class="pagination">
			<span class="previous"><a href='#'>&larr; Previous</a></span>
			<span class="next">Next &rarr;</span>
		</nav>
	<?php get_footer(); ?>