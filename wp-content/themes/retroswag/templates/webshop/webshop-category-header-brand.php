<?php if (isset($categoryData)): ?>

    <?php
    $brandImage = get_field('intro_header_image', $categoryData);
    $brandLogo = get_field('image', $categoryData);
    $brandSubcontent = get_field('subcontent', $categoryData);
    $brandwebsite_url = get_field('website_url', $categoryData);
    $brandtwitter_url = get_field('twitter_url', $categoryData);
    $branddiscord_url = get_field('discord_url', $categoryData);
    $brandproduct_intro_title = get_field('product_intro_title', $categoryData);
    $brandproduct_intro_desc = get_field('product_intro_desc', $categoryData);

    $logoSize = (isset($brandLogo['height']) && $brandLogo['height'] > 120 )? 'small-padding' : '';
    ?>


    <!-- start:header-brand -->
    <div class="header-brand">

        <!-- start:container -->
        <div class="container">

            <?php if (isset($brandImage['sizes']['theme-thumb-1'])): ?>
                <!-- start:brand-hero -->
                <div class="brand-hero">
                    <img src="<?php echo $brandImage['sizes']['theme-thumb-1']; ?>"
                         alt="<?php echo $brandImage['alt']; ?>" class="d-block w-100">
                </div>
                <!-- end:brand-hero -->
            <?php endif; ?>

            <!-- start:brand-data -->
            <div class="brand-data">

                <div class="row justify-content-between">

                    <?php if (isset($brandLogo['url'])): ?>
                        <div class="col-12 col-md-4 col-lg-3 logo-holder">
                            <div class="logo <?php echo $logoSize; ?>">
                                <img src="<?php echo $brandLogo['url']; ?>"
                                     alt="<?php echo $brandLogo['alt']; ?>">
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="col-12 col-md-8 col-lg-9">
                        <div class="brand-data-title">
                            <div class="title">
                                <div class="row justify-content-between">
                                    <div class="col-12 col-md-8 mb-3 mb-md-0">
                                        <h1><?php echo nl2br($categoryData->description); ?></h1>
                                    </div>

                                    <div class="col-12 col-md-auto mb-3 mb-md-0">
                                        <?php if (isset($brandwebsite_url)): ?>
                                            <a href="<?php echo $brandwebsite_url; ?>" target="_blank"
                                               class="btn-website"><?php _e('Website', 'template'); ?></a>
                                        <?php endif; ?>
                                        <?php if (isset($brandtwitter_url)): ?>
                                            <a href="<?php echo $brandtwitter_url; ?>" target="_blank"
                                               class="btn-twitter">Twitter</a>
                                        <?php endif; ?>
                                        <?php if (isset($branddiscord_url)): ?>
                                            <a href="<?php echo $branddiscord_url; ?>" target="_blank"
                                               class="btn-discord">Discord</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="text">
                                <?php echo nl2br($brandSubcontent); ?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- end:brand-data -->

            <div class="product-top">
                <div class="row justify-content-center">
                    <div class="col-auto ms-sm-auto mb-3 mb-md-0">
                        <h2><?php echo $brandproduct_intro_title ?></h2>
                        <h3><?php echo $brandproduct_intro_desc; ?></h3>
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
                            $orderby = 'name';
                            $order = 'asc';
                            $hide_empty = true;
                            $cat_args = array(
                                'orderby' => $orderby,
                                'order' => $order,
                                'hide_empty' => $hide_empty,
                            );

                            $product_categories = get_terms('product_cat', $cat_args);

                            ?>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item <?php echo((!isset($_GET['fitlerBy'])) ? 'active' : ''); ?>"
                                       href="<?php echo $currentUrl; ?>"><?php _e('none', 'template'); ?></a>
                                </li>
                                <?php foreach ($product_categories as $key => $product_category): ?>
                                    <?php
                                    $fitlerBy = (isset($_GET['fitlerBy'])) ? filter_var($_GET['fitlerBy']) : '';
                                    $active = ($fitlerBy == $product_category->slug) ? 'active' : '';
                                    $aria = ($fitlerBy == $product_category->slug) ? 'aria-current="true"' : '';
                                    ?>
                                    <li>
                                        <a class="dropdown-item <?php echo $active; ?>" <?php echo $aria; ?>
                                           href="<?php echo $currentUrl; ?>?fitlerBy=<?php echo $product_category->slug; ?>"><?php echo $product_category->name; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end:container -->

    </div>
    <!-- end:header-brand -->


<?php endif; ?>