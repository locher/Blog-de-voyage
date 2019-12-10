<?php get_header(); ?>


<main role="main">

	<?php
		if ( have_posts() ) : ?>
		<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
    $size = 'h50w100';
        ?>

			<article class="full-new w100 h50">
				<?php get_template_part('template-parts/new-single'); ?>
			</article>




</main>

<?php endwhile; endif;?>

<div class="pagination">
			<?php 
			$args_pagination = array(
				'before_page_number' => ''
			);
	
			echo get_the_posts_pagination($args_pagination);
	
		?>
</div>
<?php get_footer(); ?>