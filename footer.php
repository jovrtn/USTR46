<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package USTR
 */

?>

	<footer id="colophon" class="site-footer pt-4">

        <div class="container  border-top pt-5 pb-5">




            <div class="row">


                <div class="col-lg-4">

                    <div class="logo mb-3">
                    <a href="/">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ustr-seal-logo.png">
                    </a>
                </div>

                    <p class="mb-0"><strong>Winder Building</strong></p>
                    <p class="m-0">600 17th Street NW</p>
                    <p class="mt-0">Washington, D.C. 20508</p>

                    <div class="d-inline mr-2"><a href=""><i class="fab fa-facebook"></i></a></div>

                    <div class="d-inline mr-2"><a href=""><i class="fab fa-instagram"></i></a></div>

                    <div class="d-inline mr-2"><a href=""><i class="fab fa-twitter"></i></a></div>

                    <div class="d-inline"><a href=""><i class="fab fa-youtube"></i></a></div>


                </div>

                <div class="col-lg-8 d-flex justify-content-end">
                    <nav>
                    <ul class="">

                <?php

                $menu_items = wp_get_nav_menu_items('footer');

                // $cols = array_chunk($menu_items, 4);

                foreach($menu_items as $item) {
                    ?>
                    <li class="nav-item">


                    <a href="<?php echo $item->url; ?>" class="d-block"><?php echo $item->title; ?></a>

                    </li>
                    <?php } ?>
                    </ul>
                        </nav>
                    </div>


            </div>



        </div>



	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
