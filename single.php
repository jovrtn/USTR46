<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package USTR
 */

get_header();
?>

	<main id="primary" class="site-main">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div class="container mb-4">




                <div class="row">

                <div class="col-lg-2">
                    </div>

                        <div class="col-lg-8">

                            <header class="text-center">
                            <p>Press Room link</p>
                            <h2><?php single_post_title(); ?></h2>

                            <p><?php echo get_the_date(); ?> - Categories</p>



                            <?php

                            $postTitleEncoded = urlencode(get_the_title());
                            $postUrlEncoded = urlencode(get_permalink());

                            $twitterShareUrl = "https://twitter.com/intent/tweet?url=" . $postUrlEncoded . "&text=" . $postTitleEncoded . "&via=USTR";

                            $facebookShareUrl = "http://www.facebook.com/sharer.php?u=" . $postUrlEncoded;

                            ?>

                            <p><a href="<?php echo $facebookShareUrl; ?>" target="_blank" rel="noopener">Facebook</a> <a href="<?php echo $twitterShareUrl; ?> " target="_blank" rel="noopener">Twitter</a></p>




                            <!-- http://www.facebook.com/sharer.php?u=yourlink
http://twitter.com/share?text=yourtext&url=yourlink
https://plus.google.com/share?url=yourlink -->


                            </header>

                         <?php the_content(); ?>

                    </div>

                <div class="col-lg-2">
                    </div>
                </div>


            </div>

<?php endwhile; ?>
<?php endif; ?>





	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
