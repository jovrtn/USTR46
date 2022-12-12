<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package USTR
 */

get_header();
?>

	<main id="primary" class="site-main">



        <?php
                            /*
                             * The secondary query. Note that you can use any category name here. In our example,
                             * we use "example-category".
                             */

                            $sticky_posts_query_args = array(
                                'posts_per_page'   => 5,
                                'category__not_in' => 2 ,
                                'sort_column' => 'menu_order',
                                'post_status' => 'publish',
                                'orderby' => 'menu_order',
                                'order' => 'ASC',
                                'post__in' => get_option( 'sticky_posts' )
                            );
                            $secondary_query = new WP_Query($sticky_posts_query_args);

                            $sticky_posts = $secondary_query->posts;



                            ?>
        <div class="container-fluid mb-5">

            <div class="embed-responsive embed-responsive-21by9 d-none d-lg-block">

                <div class="splash embed-responsive-item"><div class="splash-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/splash.jpg')">


                    <div class="caption d-none d-lg-block">

                        <p class="post-categories mb-1">
                            <?php echo get_the_date(); ?>
                            <span class="separator">•</span>
                            <?php

                            $sticky_post_first_cats = get_the_category($sticky_posts[0]);

                            foreach ($sticky_post_first_cats as $key => $sticky_post_first_cat) {
                                // print_r($sticky_post_cat);
                            ?>
                                <a href="<?php echo get_category_link($sticky_post_first_cat) ?>"><?php echo $sticky_post_first_cat->cat_name; ?></a><?php if ($key !== array_key_last($sticky_post_first_cats)) { ?>, <?php } ?>
                            <?php
                                }
                            ?>


                        </p>


                        <h2><?php echo $sticky_posts[0]->post_title ?></h2>
                        <a href="<?php echo get_permalink($sticky_posts[0]) ?>" class="btn btn-primary rounded-pill pt-2 pr-3 pb-2 pl-3">Read More</a>
                    </div>

                </div></div>

            </div>

            <div class="embed-responsive embed-responsive-16by9 d-block d-lg-none">

                <div class="splash embed-responsive-item"><div class="splash-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/splash.jpg')">


                    <div class="caption d-none d-lg-block">

                        <p class="post-categories mb-1">
                            <?php echo get_the_date(); ?>
                            <span class="separator">•</span>
                            <?php

                            $sticky_post_first_cats = get_the_category($sticky_posts[0]);

                            foreach ($sticky_post_first_cats as $key => $sticky_post_first_cat) {
                                // print_r($sticky_post_cat);
                            ?>
                                <a href="<?php echo get_category_link($sticky_post_first_cat) ?>"><?php echo $sticky_post_first_cat->cat_name; ?></a><?php if ($key !== array_key_last($sticky_post_first_cats)) { ?>, <?php } ?>
                            <?php
                                }
                            ?>


                        </p>



                        <h2><?php echo $sticky_posts[0]->post_title ?></h2>
                        <a href="<?php echo get_permalink($sticky_posts[0]) ?>" class="btn btn-primary rounded-pill pt-2 pr-3 pb-2 pl-3"><strong>Read More</strong></a>
                    </div>

                </div></div>

            </div>

            <div class="caption d-block d-lg-none">
                <h2><?php echo $sticky_posts[0]->post_title ?></h2>
                <a href="<?php echo get_permalink($sticky_posts[0]) ?>" class="btn btn-primary rounded-pill pt-2 pr-3 pb-2 pl-3"><strong>Read More</strong></a>
            </div>




        </div>

        <div class="container news mb-5 pt-4 pb-4">



            <div class="row">
                <div class="col-lg-8 pr-xl-5 pr-lg-4 featured border-right">


                    <div class="row">


                        <?php

                        array_shift($sticky_posts);
                        // print_r($sticky_posts);

                        foreach ($sticky_posts as $sticky_post) {
                            //print_r($sticky_post);

                            ?>

                            <div class="col-lg-6 col-md-6 mb-3">


                                <div class="embed-responsive d-block d-md-none embed-responsive-16by9">


                                <a href="<?php echo get_permalink($sticky_post) ?>" class="d-block embed-responsive-item" style="background-image: url('<?php echo get_the_post_thumbnail_url($sticky_post); ?>'); background-size: cover; background-position: center center; border-radius: 16px;"></a>
                                </div>

                                <div class="embed-responsive d-md-block d-none embed-responsive-4by3  mb-2">


                                <a href="<?php echo get_permalink($sticky_post) ?>" class="d-block embed-responsive-item" style="background-image: url('<?php echo get_the_post_thumbnail_url($sticky_post); ?>'); background-size: cover; background-position: center center; border-radius: 16px;"></a>
                                </div>

                                <h3 class="post-title mb-1"><a href="<?php echo get_permalink($sticky_post) ?>"><?php echo $sticky_post->post_title; ?></a></h3>

                                <p class="post-categories">
                                    <?php echo get_the_date(); ?>
                                    <span class="separator">•</span>
                                    <?php

                                    $sticky_post_cats = get_the_category($sticky_post);

                                    foreach ($sticky_post_cats as $key => $sticky_post_cat) {
                                        // print_r($sticky_post_cat);
                                    ?>
                                        <a href="<?php echo get_category_link($sticky_post_cat) ?>"><?php echo $sticky_post_cat->cat_name; ?></a><?php if ($key !== array_key_last($sticky_post_cats)) { ?>, <?php } ?>
                                    <?php
                                        }
                                    ?>


                                </p>
                            </div>

                            <?php

                                }
                            wp_reset_postdata();
                            ?>

                        </div>
                </div>
                <div class="col-lg-4 pl-xl-5 pl-lg-4">


                    <?php

                    // $query->set( 'cat', '-2' );
                    // $query->set('ignore_sticky_posts', true);
                    // $query->set('post__not_in', get_option('sticky_posts'));
                    // $query->set('posts_per_page', 4);
                    //

                    $posts_query_args = array(
                        'posts_per_page'   => 5,
                        'category__not_in' => 2 ,
                        'post_status' => 'publish',
                        'orderby' => 'publish_date',
                        'order' => 'DESC',
                        'ignore_sticky_posts' => true
                    );
                    $posts_query = new WP_Query($posts_query_args);

                    $posts = $posts_query ->posts;
                    // print_r($sticky_posts);

                    foreach ($posts as $post) {
                        //print_r($sticky_post);

                        ?>

                        <article class="mb-3 border-bottom pb-3">
                            <h3 class="post-title"><a href="<?php echo get_permalink($post) ?>"><?php echo $post->post_title; ?></a></h3>
                            <p class="mb-0 post-categories">
                                <?php echo get_the_date(); ?>
                                <span class="separator">•</span>
                                <?php

                                $post_cats = get_the_category($post);

                                foreach ($post_cats as $key => $post_cat) {
                                    // print_r($sticky_post_cat);
                                ?>

                                    <a href="<?php echo get_category_link($post_cat) ?>"><?php echo $post_cat->cat_name; ?></a><?php if ($key !== array_key_last($post_cats)) { ?>, <?php } ?>

                                <?php
                                    }
                                ?>


                            </p>
                        </article>


                        <?php

                            }
                        wp_reset_postdata();
                        ?>



                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-12 mb-2 pt-2"><p class=""><a href="/press-room" class="plain_cta">Press Room</a></p>
                            <p><a href="/press-room/reports-publications" class="plain_cta">Reports &amp; Publications</a></p></div>
                            <div class="col-lg-12 col-md-6 col-12">

                                <div class="bg-light p-4 text-center border-radius-20  social">

                                    <h3 class="mb-3">Follow USTR</h3>

                                <div class="d-inline mr-2"><a href=""><i class="fab fa-facebook"></i></a></div>
                                <div class="d-inline mr-2"><a href=""><i class="fab fa-instagram"></i></a></div>
                                <div class="d-inline mr-2"><a href=""><i class="fab fa-twitter"></i></a></div>
                                <div class="d-inline"><a href=""><i class="fab fa-youtube"></i></a></div>

                            </div></div>
                        </div>




                </div>
            </div>



        </div>

        <div class="container-fluid bg-light pt-5 pb-5 mb-5">

            <div class="container">

                <div class="row align-items-center">

                    <div class="col-6">

                        <h2>The President's Trade Agenda</h2>
                        <p>The 2016 Trade Agenda outlines key priorities in the United States bilateral and multilateral trade and investment relationships, including the Trans-Pacific Partnership, which will cut over 18,000 taxes on Made-in-America exports, support more high-paying U.S. jobs, and promote both our interests and our values. It also highlights our efforts to conclude the Transatlantic Trade and Investment Partnership, the Environmental Goods Agreement, the Trade in Services Agreement, and work to strengthen our trade and investment ties with countries and regional partners around the world.</p>

                        <p><a href="" class="plain_cta">View the Agenda</a></p>

                    </div>

                    <div class="col-6 pl-5">

                        <div class="embed-responsive embed-responsive-4by3" style="border-radius: 16px;">
<img class="d-block embed-responsive-item" src="https://ustr.gov/sites/default/files/The-Presidents-Trade-Agenda-cover.jpg">
</div>



                    </div>
                </div>

            </div>
        </div>



                    <div class="container-fluid bg-light pt-5 pb-5 mb-5">

                        <div class="container">

                            <div class="row align-items-center">


                                                                <div class="col-6 pr-5">

                                                                    <div class="embed-responsive embed-responsive-4by3"  style="border-radius: 16px;">
                                <img class="d-block embed-responsive-item" src="https://www.gsa.gov/cdnstatic/WinderArchitecture1.jpg">
                                </div>



                                                                </div>

                                <div class="col-6">

                                    <h2>Mission of the United States Trade Representative</h2>
                                    <p>American trade policy works toward opening markets throughout the world to create new opportunities and higher living standards for families, farmers, manufacturers, workers, consumers, and businesses. The United States is party to numerous trade agreements with other countries, and is participating in negotiations for new trade agreements with a number of countries and regions of the world.</p>

                                    <p><a href="" class="plain_cta">Read More About USTR</a></p>

                                </div>

                            </div>

                        </div>
                    </div>


                    <div class="container-fluid initiatives pt-3 mb-4">

                        <div class="container">

                                <h2 class="text-center mb-5">Trade Agreements and Initiatives</h2>

                            <div class="row">

                                <?php

                                $initiatives_query_args =  array(
                                                // 'showposts' => -1,
                                                'tag_id' => 6,
                                                'posts_per_page' => -1,
                                                // 'meta_key' => 'date',
                                                'orderby' => 'post_title',
                                                'order' => 'ASC',
                                                'post_type' => array( 'page' )
                                            );

                            $initiatives_query = new WP_Query($initiatives_query_args);

                            // print_r($initiatives_query);

                             $initiatives = $initiatives_query->posts;


                            foreach ($initiatives as $initiative) {
                                // print_r($initiative);

                                ?>

                                <div class="col-lg-4 col-md-6 mb-4 text-center">

                                <div class="embed-responsive embed-responsive-16by9 mb-3">


                                <a href="<?php echo get_permalink($initiative) ?>" class="d-block embed-responsive-item" style="background-image: url('<?php echo get_the_post_thumbnail_url($initiative); ?>'); background-size: cover; background-position: center center; border-radius: 16px;"></a>
                                </div>

                                    <h3><?php echo $initiative->post_title; ?></h3></div>


                                <?php
                                    }
                                    wp_reset_postdata();

                                ?>


                            </div>







                        </div>
                    </div>

            <!-- <div class="row">
                <div class="col">

                    <div class="embed-responsive embed-responsive-16by9">

                        <div class="embed-responsive-item"></div>

                    </div>

                </div>
                <div class="col">
                    <div class="embed-responsive embed-responsive-16by9">

                        <div class="embed-responsive-item"></div>

                    </div>

                </div>
                <div class="col">
                    <div class="embed-responsive embed-responsive-16by9">

                        <div class="embed-responsive-item"></div>

                    </div>
                </div>
            </div> -->







	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
