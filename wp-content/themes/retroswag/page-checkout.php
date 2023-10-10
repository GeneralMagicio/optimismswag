<?php
/**
 * Template Name: Checkout
 */
?>
<?php get_header(); ?>

    <!-- start:content -->
    <div class="content content-cart content-checkout <?php echo((isset($_GET['key'])) ? 'content-thanks' : ''); ?>">

        <!-- start:container -->
        <div class="container">

            <!-- start:cart-header -->
            <div class="cart-header">

                <h2>
                    <?php
                    $title = ( isset($_GET['key']) ) ? 'Order Confirmation' : 'Checkout';
                    echo wc_page_endpoint_title($title);
                    ?>
                </h2>

                <div class="links-bread">
                    <a href="<?php echo wc_get_cart_url(); ?>"><?php _e('Cart', 'template'); ?></a> /
                    <a href="<?php echo wc_get_checkout_url(); ?>"
                       class="<?php echo ((isset($_GET['key'])) ? '' : 'active'); ?>"><?php _e('Checkout', 'template'); ?></a>
                    /
                    <span class="<?php echo((isset($_GET['key'])) ? 'active' : ''); ?>"><?php _e('Confirm & Thank You', 'template'); ?></span>
                </div>

            </div>
            <!-- end:cart-header -->

            <?php include 'templates/page-checkout/page-checkout-products.php'; ?>

            <?php if (have_posts()) : ?>

                <?php while (have_posts()) : the_post(); ?>

                    <?php

                    //prepare data
                    $postID = get_the_ID();

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

<?php get_footer(); ?>