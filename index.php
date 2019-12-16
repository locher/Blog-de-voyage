<?php get_header(); ?>


<main role="main" class="home-second">

	<?php
		if ( have_posts() ) : ?>
		<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
    $size = 'h50w50';
        ?>

			<article class="full-new w50 h50">
				<?php get_template_part('template-parts/new-single'); ?>
			</article>


<?php endwhile; endif;?>

</main>



<div class="pagination">
			<?php 
			$args_pagination = array(
				'before_page_number' => '',
				'prev_text' => '<i></i>'
			);
	
			echo get_the_posts_pagination($args_pagination);
	
		?>
</div>
<?php get_footer(); ?>