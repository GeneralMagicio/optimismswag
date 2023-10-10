<?php if (isset($categoryData)): ?>

    <?php

    $queryArgs = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'brand',
                'field' => 'term_id',
                'terms' => $categoryData->term_id,
            ),
            array(
                'taxonomy' => 'product_visibility',
                'field' => 'name',
                'terms' => 'exclude-from-catalog',
                'operator' => 'NOT IN',
            ),
        ),
        'orderby' => 'menu_order',
    );

    $fitlerBy = (isset($_GET['fitlerBy']))? filter_var($_GET['fitlerBy']) : '';

    if(trim($fitlerBy) != ''){
        $queryArgs['tax_query'][] =  array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $fitlerBy,
        );
    }

    $query = new WP_Query($queryArgs);
    ?>

    <?php if ($query->have_posts()): ?>

        <!-- start:category-product-list-->
        <div class="category-product-list">

            <!-- start:container -->
            <div class="container">

                <!-- start:product-list -->
                <div id="category-product-list-list" class="product-list">

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

                <!-- start:back-holder -->
                <div class="back-holder">
                    <a href="/brands"
                       class="back"><?php _e('Back to all brands', 'template'); ?></a>
                </div>
                <!-- end:back-holder -->

            </div>
            <!-- end:container -->

        </div>
        <!-- end:category-product-list-->

    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

<?php endif; ?>