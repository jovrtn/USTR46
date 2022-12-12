<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package USTR
 */

get_header();
?>

	<main id="primary" class="site-main">

        <div class="container">

            <div class="row">

                <div class="col-3">
                <ul>

                    <?php
// Globalize the $post variable;
// probably already available in this context, but just in case...
global $post;

$ancestors = $post->ancestors;
$parent = $post->post_parent;

if ($parent) {
    print_r($ancestors);
    print_r($parent);


    wp_list_pages( array(
        'title_li' => '',
        // Only pages that are children of the current page
        'child_of' => $post->post_parent,
        // Only show one level of hierarchy
        'depth' => 2
    ) );
} else {

    print_r($ancestors);
    print_r($parent);


    wp_list_pages( array(
            'title_li' => '',
        // Only pages that are children of the current page
        'child_of' => $post->ID,
        // Only show one level of hierarchy
        'depth' => 1
    ) );

}



?>
</ul>

                </div>
                <div class="col-6">

                    <?php
                    while ( have_posts() ) :
                        the_post();

                        get_template_part( 'template-parts/content', 'page' );

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                    ?>


                </div>
                <div class="col-3">

                </div>
            </div>



        </div>


	</main><!-- #main -->

<?php
get_footer();
