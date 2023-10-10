<?php

$categoryData = get_term(67);

$queryArgs = array(
    'post_type' => 'product',
    'posts_per_page' => 6,
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => 67,
        ),
    ),
);

$query = new WP_Query($queryArgs);
?>

<?php if ($query->have_posts()): ?>

    <!-- start:best-seller -->
    <div class="best-seller">

        <!-- start:container -->
        <div class="container">

            <?php if ($categoryData): ?>

                <!-- start:section-title -->
                <div class="section-title">
                    <h2><?php echo $categoryData->name; ?></h2>
                    <h3><?php echo strip_tags($categoryData->description); ?></h3>
                </div>
                <!-- end:section-title -->

            <?php endif; ?>


            <!-- start:product-list -->
            <div id="best-seller-list" class="product-list">

                <div class="over"></div>

                <!-- start:row -->
                <div class="row g-1">

                    <?php $queryCounter = 1; ?>

                    <?php while ($query->have_posts()): ?>

                        <?php
                        // Prepare data
                        $query->the_post();

                        $postID = get_the_ID();
                        $thumbID = get_post_thumbnail_id();
                        $permalink = esc_url(get_permalink());

                        $image = wp_get_attachment_image_src($thumbID, 'theme-thumb-1');
                        $imageAlt = get_post_meta($thumbID, '_wp_attachment_image_alt', true);
                        ?>

                        <ul class="col-12 col-sm-6 col-lg-4">
                            <?php wc_get_template('content-product.php'); ?>
                        </ul>

                        <?php $queryCounter++; ?>

                    <?php endwhile; ?>

                </div>
                <!-- end:row -->

            </div>
            <!-- end:product-list -->

        </div>
        <!-- end:container -->

    </div>
    <!-- end:best-seller -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>