<?php

$categoryID = 33;

$queryArgs = array(
    'post_type' => 'post',
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $categoryID,
        )
    ),
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 1,
    'post_status' => 'publish',
);

$query = new WP_Query($queryArgs);
?>

<?php if ($query->have_posts()): ?>

    <!-- start:home-footer -->
    <div class="home-footer">

        <!-- start:container -->
        <div class="container">

            <div class="home-footer-inner">

                <div class="row">

                    <?php while ($query->have_posts()): ?>

                        <?php
                        // Prepare data
                        $query->the_post();
                        $postID = get_the_ID();

                        $link = get_field('link', $postID);
                        ?>

                        <div class="col-12 col-lg-6">
                            <h2><?php the_title(); ?></h2>
                            <?php if (isset($link['url'])): ?>
                                <div class="link">
                                    <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target'] ?>" class="btn"><?php echo $link['title']; ?></a>
                                </div>
                            <?php endif; ?>
                        </div>

                    <?php endwhile; ?>

                </div>

            </div>

        </div>
        <!-- end:container -->

    </div>
    <!-- end:home-footer -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>