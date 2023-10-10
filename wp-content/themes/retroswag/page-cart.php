<?php
/**
 * Template Name: Cart
 */
?>
<?php get_header(); ?>

    <!-- start:content -->
    <div class="content content-cart">

        <!-- start:container -->
        <div class="container">
            
            <!-- start:cart-header -->
            <div class="cart-header">

                <h2><?php the_title(); ?></h2>

                <div class="links-bread">
                    <a href="<?php echo wc_get_cart_url(); ?>" class="active"><?php _e('Cart', 'template'); ?></a> /
                    <a href="<?php echo wc_get_checkout_url(); ?>"><?php _e('Checkout', 'template'); ?></a> /
                    <span><?php _e('Confirm & Thank You', 'template'); ?></span>
                </div>
                
            </div>
            <!-- end:cart-header -->

            <?php if ( have_posts() ) : ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php

                    //prepare data
                    $postID     =   get_the_ID();

                    ?>

                    <!-- start:content-inner -->
                    <div class="content-inner">
                        <?php the_content(); ?>
                    </div>
                    <!-- end:content-inner -->

                <?php endwhile; ?>

            <?php endif; ?>

        </div>
        <!-- end:container -->

    </div>
    <!-- end:content -->

    <?php include 'templates/elements/you-may-also-like.php'; ?>

<?php get_footer(); ?>