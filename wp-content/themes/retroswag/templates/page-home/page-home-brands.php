<?php
$terms = get_terms(array(
    'taxonomy' => 'brand',
    'hide_empty' => true,
));
?>

<?php if (sizeof($terms) > 0): ?>

    <!-- start:home-brands -->
    <div class="home-brands">

        <!-- start:container -->
        <div class="container">

            <!-- start:home-brands-inside -->
            <div class="home-brands-inside">

                <div class="product-slider slider-wrapper">

                    <ul class="slider-wrapper-holder">

                        <?php $queryCounter = 1; ?>

                        <?php foreach ($terms as $term): ?>

                            <?php
                            // Prepare data
                            $termLink = get_term_link($term->term_id);
                            $termImage = get_field('image', $term);
                            ?>

                            <li class="slider-wrapper-item">
                                <div class="card">
                                    <a href="<?php echo $termLink; ?>" title="<?php echo $term->name; ?>">
                                        <img src="<?php echo $termImage['url']; ?>"
                                             alt="<?php echo $termImage['alt']; ?>">
                                        <span>learn more</span>
                                    </a>
                                </div>
                            </li>

                        <?php endforeach; ?>

                    </ul>
                    <div class="slider-wrapper-footer">
                        <div class="slider-arrows">
                            <a class="arrow arrow-prev">PREV</a>
                            <a class="arrow arrow-next">NEXT</a>
                        </div>
                    </div>

                </div>

            </div>
            <!-- end:home-brands-inside -->

        </div>
        <!-- end:container -->

    </div>
    <!-- end:home-brands -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>