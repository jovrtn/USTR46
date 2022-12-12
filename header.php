<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package USTR
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

    <script src="https://kit.fontawesome.com/999eedfc1f.js" crossorigin="anonymous"></script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="container-fluid sticky-top bg-white">
<header id="masthead" class="site-header ">



    <div class="d-flex bd-highlight">
      <div class="mr-auto bd-highlight title desktop d-none d-lg-block">

          <a href="/" class="text-dark">
         <h1 class="m-0 p-0">Office <span>of the</span> United States Trade Representative</h1>
         <h2 class="m-0 p-0">Executive Office of the President</h2>
     </a>

      </div>

      <div class="mr-auto bd-highlight title mobile d-block d-lg-none">

          <a href="/" class="text-dark">
         <h1 class="m-0 p-0">USTR<span>.GOV</span></h1>
     </a>

      </div>


      <div class="center-logo">
          <a href="/">
              <img src="<?php echo get_template_directory_uri(); ?>/img/ustr-seal-logo.png">
          </a>

      </div>

        <div class=" d-xl-flex d-none">
      <?php

      $menu_items = wp_get_nav_menu_items('header');
      foreach($menu_items as $item) {
      ?>


      <div class="p-2 nav-item"><a href="<?php echo $item->{'url'}; ?>"><?php echo $item->{'title'}; ?></a></div>

      <?php


          // to know what's in $item
          // echo '<pre>'; var_dump($item);

      }


      ?>

      <div class="p-2 nav-item"><a href="/search"><i class="fas fa-search"></i></a></div>
  </div>
    </div>
</header><!-- #masthead -->
  </div>
<div id="page" class="site">
