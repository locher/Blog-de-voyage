<?php get_header(); ?>

    <main role="main">
    
    	<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
        ?>
        
  <article class="full-new w1O0 h100">
    <?php get_template_part('template-parts/new-single'); ?>
</article>

    </main>

   <?php endwhile; endif;?>
    <?php get_footer(); ?>