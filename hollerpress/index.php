<?php get_header(); ?>
		<script id="new-posts-template" type="text/x-handlebars-template">
  			<section id='new-posts' class='new-posts'>
				<p><a href='/'>{{num_posts_message}}</a></p>
			</section>
		</script>
		<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<section class='blog-teaser'>
			<header>
				<h1><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h1>
			</header>
			<p><?php the_excerpt(); ?></p>
		</section>
		<?php endwhile; endif; ?>
		<script id="blog-teaser-template" type="text/x-handlebars-template">
  			<section class='blog-teaser'>
				<header>
					<h1><a href='{{permalink}}'>{{title}}</a></h1>
				</header>
				<p>{{excerpt}}</p>
			</section>
		</script>
		<nav class="pagination">
			<span class="previous"><?php previous_posts_link('&larr; Previous', 0) ?></span>
			<span class="next"><?php next_posts_link('Next &rarr;', 0); ?></span>
		</nav>
	<?php get_footer(); ?>