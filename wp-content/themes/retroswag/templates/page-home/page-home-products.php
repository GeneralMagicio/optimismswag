<?php

$introData = getSpecificPostDataByCategory('post', 29);

$queryArgs = array(
    'post_type' => 'product',
    'posts_per_page' => 9,
    'post_status' => 'publish',
    'orderby' => 'menu_order',
);

$query = new WP_Query($queryArgs);
?>

<?php if ($query->have_posts()): ?>

    <!-- start:home-product -->
    <div class="home-product">

        <!-- start:container -->
        <div class="container">

            <?php if ($introData): ?>

                <!-- start:section-title -->
                <div class="section-title">
                    <h2><?php echo $introData['post_title']; ?></h2>
                    <h3><?php echo strip_tags($introData['post_content']); ?></h3>
                </div>
                <!-- end:section-title -->

            <?php endif; ?>


            <!-- start:product-list -->
            <div id="home-product-list" class="product-list">

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

                        <ul class="col-6 col-sm-6 col-lg-4">
                            <?php wc_get_template('content-product.php'); ?>
                        </ul>

                        <?php $queryCounter++; ?>

                    <?php endwhile; ?>

                </div>
                <!-- end:row -->

                <!-- start:product-list-pagination -->
                <div id="product-pagination" class="product-list-pagination">

                    <div class="loading blink-me">we started loading :) ....</div>

                    <?php
                    global $wp;

                    $numberOfPages = $query->max_num_pages;

                    $end_size = 1;
                    $mid_size = 3;
                    $page = 1;
                    $queryString = '';
                    $currentUrl = home_url($wp->request);

                    ?>
                    <!-- start:pagination-over -->
                    <div class="pagination-over">
                        <?php getPagination($currentUrl, $queryString, $numberOfPages, $page, $mid_size, $end_size); ?>
                    </div>
                    <!-- end:pagination-over -->

                </div>
                <!-- end:product-list-pagination -->

            </div>
            <!-- end:product-list -->

        </div>
        <!-- end:container -->

    </div>
    <!-- end:home-product -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>