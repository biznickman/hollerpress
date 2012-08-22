<?php get_header(); ?>
		<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<section class='blog-teaser'>
			<header>
				<h1><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h1>
			</header>
			<p><?php the_excerpt(); ?></p>
		</section>
		<?php endwhile; endif; ?>
		<nav class="pagination">
			<!--<span class="previous"><a href='#'>&larr; Previous</a></span>
			<span class="next">Next &rarr;</span>-->
			<?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); endif; ?>
		</nav>
	<?php get_footer(); ?>