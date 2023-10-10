<?php
$introDataVibes = getSpecificPostDataByCategory('post', 109);
?>

<?php if (sizeof($introDataVibes) > 0): ?>

    <?php
    // Prepare data
    $subText = get_field('subcontent', $introDataVibes['post_id']);
    $link = get_field('link', $introDataVibes['post_id']);
    ?>

    <!-- start:home-vibes-->
    <div class="home-vibes">

        <!-- start:container -->
        <div class="container">

            <!-- start:home-vibes-inside -->
            <div class="home-vibes-inside">

                <!-- start:row -->
                <div class="row">

                    <div class="col-12 col-lg-4">
                        <div class="title">
                            <?php echo $introDataVibes['post_content']; ?>
                        </div>
                        <div class="text">
                            <?php echo nl2br($subText); ?>
                        </div>
                    </div>

                </div>
                <!-- end:row -->

            </div>
            <!-- end:home-vibes-inside -->

        </div>
        <!-- end:container -->

    </div>
    <!-- end:home-vibes-->

<?php endif; ?>

<?php wp_reset_postdata(); ?>