<?php get_header(); ?>

<?php
    if (have_posts()): while (have_posts()) : the_post(); 
        $galery = get_field('galerie_photo', $post);
?>

    <main role="main" class="single">
        <article>

            <?php if($galery):?>
            <div class="img-wrapper">
                <img src="<?php echo $galery[0]['sizes']['h100w100'];?>" alt="<?php echo $galery['alt'];?>">
            </div>
            <?php endif;?>

            <div class="single-wrapper">

                <header class="single-header-wrapper">

                    <p class="date">
                        <?php echo the_date();?> -
                        <?php the_author();?>
                    </p>
                    <h1>
                        <?php the_title();?>
                    </h1>

                </header>

                <div class="single-content-wrapper">

                    <div class="intro-article">
                        <div class="padding edito">
                            <?php the_field('intro');?>
                        </div>
                        <div class="single-carto" id="map"></div>
                    </div>

                    <?php
                        $galery = get_field('galerie_photo');
                        if(count($galery) != 1):
                    ?>

                    <div class="galery">
                        <?php 
                        
                        
                        foreach($galery as $image):
                            //d($image, exif_read_data($image['url']));
                        ?>
                        <a href="<?php echo $image['sizes']['h100w100'];?>" class="galery-single" data-fancybox="gallery" title="<?php echo $image['caption'];?>">
                            <img src="<?php echo $image['sizes']['h25w25'];?>" alt="<?php echo $image['alt'];?>">
                        </a>

                        <?php endforeach; ?>

                    </div>
                    
                    <?php endif;?>
                    
                    
                    <?php if(get_field('contenu')):?>

                    <div class="padding edito">
                        <?php the_field('contenu');?>
                    </div>
                    
                    <?php endif;?>


                    <div class="padding comment ">
                        <?php
                        
                        // If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
                        
                        ?>

                    </div>




                    <?php //get_template_part('template-parts/petites-adresses'); ?>

                </div>
            </div>


        </article>
    </main>

    <script>
        var mymap = L.map('map').setView([41.7475434, 4.8490625], 3);
        L.tileLayer('https://api.mapbox.com/styles/v1/loacman/{id}/tiles/256/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: '',
            maxZoom: 13,
            id: 'cjp89e99b07pz2smnpv6x3o7t',
            accessToken: 'pk.eyJ1IjoibG9hY21hbiIsImEiOiJjanA3MXN2MW0weHkwM3ZvM29hZnA5ODgxIn0.mTmjBU_5Y51d-gCzwB6KLA',
        }).addTo(mymap);

        <?php
            $number = 0;
            $group = '';
            foreach($galery as $image):
        
            $exifImage = exif_read_data($image['url'], 0, true);
        
            $long = get_image_location($image['url'])['longitude'];
            $lat = get_image_location($image['url'])['latitude'];
        
            $popup = "<div><a class='galmap' rel='galmap'><img src=".$image['sizes']['h25w25']."></a></div>";
                        
            if(isset($exifImage['GPS']) && ($lat != 0) && $long != 0):
        ?>

        var marker<?php echo $number;?> = L.marker([<?php echo $lat.','.$long;?>]).addTo(mymap);

        marker<?php echo $number;?>.bindPopup("<?php echo $popup; ?>");

        <?php
            $group .= 'marker'.$number.',';
            $number++;
            endif;
            endforeach;
        ?>

        
        
    </script>

    <?php endwhile; ?>
    
    <script>
        var group = new L.featureGroup([<?php echo $group;?>]);
        mymap.fitBounds(group.getBounds());
    </script>
    
    <script>
jQuery('[data-fancybox="gallery"]').fancybox({
	toolbar: false
});
</script>
    
    <?php endif;?>

    <?php get_footer(); ?>