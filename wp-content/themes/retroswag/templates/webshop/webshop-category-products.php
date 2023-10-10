<?php if (isset($categoryData)): ?>

    <?php

    /**
     * BRAND PRODUCTS LIST
     */
    if( isset($brandPage) && $brandPage ){
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
        );
    }
    /**
     * CATEGORY PRODUCTS LIST
     */
    else{
        $queryArgs = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
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
        );

        $fitlerBy = (isset($_GET['fitlerBy']))? filter_var($_GET['fitlerBy']) : '';

        if(trim($fitlerBy) != ''){
            $queryArgs['tax_query'][] =  array(
                'taxonomy' => 'brand',
                'field' => 'slug',
                'terms' => $fitlerBy,
            );
        }
    }

    $query = new WP_Query($queryArgs);
    ?>

    <?php if ($query->have_posts()): ?>

        <!-- start:category-product-list-->
        <div class="category-product-list">

            <!-- start:container -->
            <div class="container">

                <!-- start:section-title -->
                <div class="section-title pt-5">
                    <div class="row justify-content-center">
                        <div class="col-auto ms-sm-auto mb-3 mb-md-0">
                            <h2><?php echo $categoryData->name; ?></h2>
                        </div>
                        <div class="col-auto ms-auto">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    <?php _e('Filter by', 'template'); ?>
                                </button>
                                <?php
                                global $wp;
                                $currentUrl = home_url($wp->request);
                                $terms = get_terms(array(
                                    'taxonomy' => 'brand',
                                    'hide_empty' => true,
                                ));

                                ?>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item <?php echo((!isset($_GET['fitlerBy'])) ? 'active' : ''); ?>"
                                           href="<?php echo $currentUrl; ?>"><?php _e('none', 'template'); ?></a>
                                    </li>
                                    <?php foreach ($terms as $key => $brand): ?>
                                        <?php
                                        $fitlerBy = (isset($_GET['fitlerBy'])) ? filter_var($_GET['fitlerBy']) : '';
                                        $active = ($fitlerBy == $brand->slug) ? 'active' : '';
                                        $aria = ($fitlerBy == $brand->slug) ? 'aria-current="true"' : '';
                                        ?>
                                        <li>
                                            <a class="dropdown-item <?php echo $active; ?>" <?php echo $aria; ?>
                                               href="<?php echo $currentUrl; ?>?fitlerBy=<?php echo $brand->slug; ?>"><?php echo $brand->name; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end:section-title -->

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
                    <a href="<?php echo esc_url(get_the_permalink(715)); ?>"
                       class="back"><?php _e('Back to all categories', 'template'); ?></a>
                </div>
                <!-- end:back-holder -->

            </div>
            <!-- end:container -->

        </div>
        <!-- end:category-product-list-->

    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

<?php endif; ?>