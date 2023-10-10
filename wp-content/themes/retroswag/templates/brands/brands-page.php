<?php
$terms = get_terms(array(
    'taxonomy' => 'brand',
    'hide_empty' => false,
));
?>

<?php if (sizeof($terms) > 0): ?>

    <!-- start:brands-page -->
    <div class="brands-page">

        <!-- start:container -->
        <div class="container">

            <div class="row g-3">

                <?php $queryCounter = 1; ?>

                <?php foreach ($terms as $term): ?>

                    <?php
                    // Prepare data
                    $termLink = get_term_link($term->term_id);
                    $termImage = get_field('image', $term);
                    $textLink = ($term->count == 0) ? 'coming soon' : 'learn more';
                    ?>

                    <div class="col-6 col-md-3">
                        <div class="card">
                            <a href="<?php echo $termLink; ?>" title="<?php echo $term->name; ?>">
                                <img src="<?php echo $termImage['url']; ?>"
                                     alt="<?php echo $termImage['alt']; ?>">
                                <span><?php echo $textLink; ?></span>
                            </a>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>

        </div>
        <!-- end:brands-page-inside -->

    </div>
    <!-- end:container -->

    </div>
    <!-- end:brands-page -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>