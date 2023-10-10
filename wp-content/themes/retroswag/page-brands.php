<?php
/**
 * Template Name: Brands
 */
?>
<?php get_header(); ?>

    <!-- start:home-header -->
    <div class="home-header">
        <!-- start:container -->
        <div class="container">
            <h1 class="text-center mt-4"><?php the_title(); ?></h1>
        </div>
        <!-- end:container -->
    </div>
    <!-- end:home-header -->


    <?php include 'templates/brands/brands-page.php'; ?>

<?php get_footer(); ?>