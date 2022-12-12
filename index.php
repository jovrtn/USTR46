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


        <div class="container mb-5">

            <h2 class="text-center mb-5"><?php single_post_title(); ?></h2>





            <div class="row">

                <div class="col-lg-3">

                    <h4><?php single_post_title(); ?></h4>

                    <ul>
                    <?php
                    $categories = get_categories();
                    foreach ($categories as $key => $category) {
                    ?>
                    <li><a href="<?php echo get_category_link($category) ?>"><?php echo $category->name ?></a></li>
                    <?php } ?>

                    <?php

                    global $post;
                    $postsPageID = get_option( 'page_for_posts' );

                    $child_pages = get_pages(array(
                        'child_of' => $postsPageID
                    ));

                    $categories = get_categories();
                    foreach ($child_pages as $child_page) {
                    ?>
                    <li><a href="<?php echo get_permalink($child_page); ?>"><?php echo $child_page->post_title; ?></a></li>
                    <?php } ?>

                    </ul>

                </div>


                    <div class="col-lg-6">


                        <div class="navigation mb-5">
                            <form>

                              <div class="form-group">
                                <label for="exampleFormControlSelect1">Choose a section</label>



                                <select class="form-control" onchange="location = this.options[this.selectedIndex].value;">
                                    <option disabled selected>Select</option>
                                    <option value="<?php echo get_permalink($postsPageID); ?>">View all</option>



                                    <?php
                                    foreach ($categories as $key => $category) {
                                    ?>
                                      <option value="<?php echo get_category_link($category); ?>"><?php echo $category->name ?></option>
                                    <?php } ?>
                                    <?php

                                    foreach ($child_pages as $child_page) {
                                    ?>
                                    <option value="<?php echo get_permalink($child_page); ?>"><?php echo $child_page->post_title; ?></option>
                                    <?php } ?>

                                </select>
                              </div>
                          </form>
                        </div>



                        <?php
            // The main query.
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                $post_categories = get_the_category();


                ?>

                <article class="mb-3 border-bottom pb-3">
                <h3 style="font-size: 1rem;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                <p class="mb-0">


                    <?php

                    $sticky_post_cats = get_the_category($sticky_post);

                    foreach ($post_categories as $key => $post_category) {
                        // print_r($sticky_post_cat);





                    ?>

                        <a href="<?php echo get_category_link($post_category) ?>"><?php echo $post_category->cat_name; ?></a><?php if ($key !== array_key_last($post_categories)) { ?>, <?php } ?>

                    <?php
                        }



                    ?>



                </p>
            </article>
                <?php

                endwhile;
            else :
                // When no posts are found, output this text.
                _e( 'Sorry, no posts matched your criteria.' );
            endif;

            echo get_the_posts_pagination();

            wp_reset_postdata();


            ?>


                    </div>

                    <div class="col-lg-3">
                    </div>



        </div>


	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
