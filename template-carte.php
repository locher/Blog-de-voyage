<?php /* Template Name: Carte*/ get_header(); ?>

    <main role="main">
    
        <div class="single-carto" id="map"></div>
    
    	<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
        ?>

       
   
   
   
   
    </main>
    
      <?php
                        $galery = get_field('galerie_photo');
                        if(count($galery) != 1):
                    ?>
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


   <?php endwhile; endif;?>
    <?php get_footer(); ?>