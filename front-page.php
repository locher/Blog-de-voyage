<?php get_header(); ?>

<?php

    //
    
?>

<main role="main">

    <article class="full-new w100 h100">
        <?php get_template_part('template-parts/new-single'); ?>
    </article>
    
    <section class="home-second">
        <div>
           <article class="full-new w50 h100">
               <?php get_template_part('template-parts/new-single'); ?>
           </article>            
        </div>
        <div class="home-second--right">
            <div class="home-carte">
                carte
            </div>
            <article class="full-new w50 h50">
                <?php get_template_part('template-parts/new-single'); ?>
            </article>
        </div>
    </section>

</main>

<?php get_footer(); ?>