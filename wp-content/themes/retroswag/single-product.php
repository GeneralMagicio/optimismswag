<?php get_header(); ?>

    <!-- start:content -->
    <div class="content single-product-page mb-5">

        <?php if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != get_the_permalink()): ?>

            <!-- start:container -->
            <div class="container px-5">

                <!-- start:back-holder -->
                <div class="back-holder">
                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="back"><?php _e('back', 'template'); ?></a>
                </div>
                <!-- end:back-holder -->

            </div>
            <!-- end:container -->

        <?php else: ?>

            <!-- start:container -->
            <div class="container px-5">

                <!-- start:back-holder -->
                <div class="back-holder">
                    <a href="<?php echo get_the_permalink(715); ?>" class="back"><?php _e('back', 'template'); ?></a>
                </div>
                <!-- end:back-holder -->

            </div>
            <!-- end:container -->

        <?php endif; ?>

        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>

                <?php

                //prepare data
                $postID = get_the_ID();

                $categoryProduct = getFirstCategoryID(wp_get_post_terms($postID, 'product_cat'));

                ?>

                <?php

                wc_get_template_part('single-product.php');

                wc_get_template_part('content', 'single-product');

                ?>

            <?php endwhile; ?>

        <?php endif; ?>

    </div>
    <!-- end:content -->

<?php include 'templates/elements/you-may-also-like.php'; ?>

<?php get_footer(); ?>