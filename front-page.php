<?php get_header(); ?>

<?php

    //3 derniers articles

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3
    );

    $the_query = new WP_Query( $args );

    //d($the_query);
?>

<main role="main">
    
    <?php
        if($the_query->posts[0]):
        $post = $the_query->posts[0];
        $size = 'h100w100';
    ?>

    <article class="full-new w100 h100">
        <?php get_template_part('template-parts/new-single'); ?>
    </article>
    
    <?php endif;?>
    
    <section class="home-second">
       
       <?php
            if($the_query->posts[1]):
            $post = $the_query->posts[1];
            $size = 'h100w50';
        ?>
       
        <div>
           <article class="full-new w50 h100">
               <?php get_template_part('template-parts/new-single'); ?>
           </article>            
        </div>
        
        <?php endif;?>
 
        <div class="home-second--right">
            <div class="home-carte">
                carte
            </div>
            
            <?php 
                if($the_query->posts[2]):
                $post = $the_query->posts[2];
                $size = 'h50w50';
            ?>
            <article class="full-new w50 h50">
                <?php get_template_part('template-parts/new-single'); ?>
            </article>
            <?php endif;?>
            
        </div>
        
    </section>

</main>

<?php get_footer(); ?>