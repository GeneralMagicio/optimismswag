<?php

$categoryData = get_term(88);

$queryArgs = array(
    'post_type' => 'post',
    'posts_per_page' => 1,
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => 88,
        ),
    ),
);

$query = new WP_Query($queryArgs);
?>

<?php if ($query->have_posts()): ?>

    <!-- start:footer-text -->
    <div class="footer-text">

        <!-- start:container -->
        <div class="container">

            <?php while ($query->have_posts()): ?>

                <?php
                // Prepare data
                $query->the_post();
                $postID = get_the_ID();
                ?>

                <!-- start:footer-text-data -->
                <div class="footer-text-data">
                    <h3><?php the_title(); ?></h3>
                    <div class="text"><?php echo strip_tags(get_the_content()); ?></div>
                </div>
                <!-- end:footer-text-data -->

            <?php endwhile; ?>

        </div>
        <!-- end:container -->

    </div>
    <!-- end:footer-text -->


<?php endif; ?>

<?php wp_reset_postdata(); ?>