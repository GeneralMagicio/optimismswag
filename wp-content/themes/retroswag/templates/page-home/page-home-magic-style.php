<?php
$queryArgs = array(
    'post_type' => 'post',
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => 84,
        )
    ),
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 1,
    'post_status' => 'publish'
);

$query = new WP_Query($queryArgs);
?>

<?php if ($query->have_posts()): ?>

    <!-- start:home-magical-style -->
    <div class="home-magical-style">

        <!-- start:container -->
        <div class="container">

            <?php $queryCounter = 1; ?>

            <?php while ($query->have_posts()): ?>

                <?php
                // Prepare data
                $query->the_post();

                $postID = get_the_ID();
                $thumbID = get_post_thumbnail_id();
                $permalink = esc_url(get_permalink());

                $image = wp_get_attachment_image_src($thumbID, 'theme-thumb-2');
                $bkImage = (isset($image[0])) ? 'style="background-image: url(' . $image[0] . ')"' : '';

                $categories_link = get_field('categories_link', $postID);
                $category_first = get_field('category_first', $postID);
                $category_second = get_field('category_second', $postID);
                $category_third = get_field('category_third', $postID);

                ?>

                <!-- start:magical-title -->
                <div class="magical-title row" <?php echo $bkImage; ?>>

                    <div class="col-12 col-md-6 col-xxl-5">
                        <h2><?php the_title(); ?></h2>
                        <?php if ($categories_link): ?>
                            <a href="<?php echo $categories_link['url']; ?>"
                               target="<?php echo $categories_link['target']; ?>"><?php echo $categories_link['title']; ?></a>
                        <?php endif; ?>
                    </div>

                </div>
                <!-- end:magical-title -->

                <!-- start:magical-categories -->
                <div class="magical-categories">

                    <!-- start:row -->
                    <div class="row g-5">

                        <?php if( $category_first ): ?>

                            <?php
                            $categoryData = get_term($category_first);
                            $categoryImage = get_field('front_page_image', $categoryData);
                            ?>
                            <?php if( isset($categoryImage['sizes']['theme-thumb-3']) ): ?>
                                <div class="col-12 col-md-4">
                                    <a href="<?php echo get_term_link( $category_first, 'product_cat' ); ?>" class="image-holder">
                                        <img src="<?php echo $categoryImage['sizes']['theme-thumb-3']; ?>" alt="">
                                        <span class="over"></span>
                                        <span><?php echo $categoryData->name; ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>

                        <?php endif; ?>

                        <?php if( $category_second ): ?>

                            <?php
                            $categoryData = get_term($category_second);
                            $categoryImage = get_field('front_page_image', $categoryData);
                            ?>
                            <?php if( isset($categoryImage['sizes']['theme-thumb-3']) ): ?>
                                <div class="col-12 col-md-4">
                                    <a href="<?php echo get_term_link( $category_second, 'product_cat' ); ?>" class="image-holder">
                                        <img src="<?php echo $categoryImage['sizes']['theme-thumb-3']; ?>" alt="">
                                        <span class="over"></span>
                                        <span><?php echo $categoryData->name; ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>

                        <?php endif; ?>

                        <?php if( $category_third ): ?>

                            <?php
                            $categoryData = get_term($category_third);
                            $categoryImage = get_field('front_page_image', $categoryData);
                            ?>
                            <?php if( isset($categoryImage['sizes']['theme-thumb-3']) ): ?>
                                <div class="col-12 col-md-4">
                                    <a href="<?php echo get_term_link( $category_third, 'product_cat' ); ?>" class="image-holder">
                                        <img src="<?php echo $categoryImage['sizes']['theme-thumb-3']; ?>" alt="">
                                        <span class="over"></span>
                                        <span><?php echo $categoryData->name; ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>

                        <?php endif; ?>

                    </div>
                    <!-- end:row -->

                </div>
                <!-- end:magical-categories -->

                <?php $queryCounter++; ?>

            <?php endwhile; ?>

        </div>
        <!-- end:container -->

    </div>
    <!-- end:home-magical-style -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>