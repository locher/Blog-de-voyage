<?php get_header(); ?>

<?php

    //3 derniers articles

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3
    );

    $the_query = new WP_Query( $args );

    //Get latest location

    foreach($the_query as $post){
        if(get_field('adresse', $post)){
            $latest_location = get_field('adresse', $post);
            break;
        }
    }

    $lat = $latest_location['markers'][0]['lat'];
    $long = $latest_location['markers'][0]['lng'];

    //Nom de la ville en fonction des coordos

    $json = 'http://www.mapquestapi.com/geocoding/v1/reverse?key=YZdrgmPLu1dopRBOmYWp3ggwJH9PeXQH&location='.$lat.','.$long.'&includeRoadMetadata=true&includeNearestIntersection=true';

    $adress_json = json_decode(file_get_contents($json));
    
    $latest_city = $adress_json->results[0]->locations[0]->adminArea5;
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
                            <div class="wrapper-carte">
                                <div class="overlay-map">
                                    <span class="date">Dernier endroit visité</span>
                                    <p><?php echo $latest_city;?></p>
                                    
                                </div>
                                <div id="mapHome"></div>
                            </div>
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
    
    <?php
        if($latest_location): 
    ?>

    <script>
        var mymap = L.map('mapHome').setView([<?php echo($lat.' , '.$long); ?>], 4);
        L.tileLayer('https://api.mapbox.com/styles/v1/loacman/{id}/tiles/256/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: '',
            maxZoom: 13,
            id: 'cjp89e99b07pz2smnpv6x3o7t',
            accessToken: 'pk.eyJ1IjoibG9hY21hbiIsImEiOiJjanA3MXN2MW0weHkwM3ZvM29hZnA5ODgxIn0.mTmjBU_5Y51d-gCzwB6KLA',
        }).addTo(mymap);


        var marker = L.marker([<?php echo($lat.' , '.$long); ?>]).addTo(mymap);
        
        //var marker2 = L.marker([41.7475434, 4.8490625]).addTo(mymap);
        //var group = new L.featureGroup([marker]);
        //mymap.fitBounds(group.getBounds());
        //marker.bindPopup("Yo").openPopup();
    </script>
    
    <?php endif;?>

    <?php get_footer(); ?>