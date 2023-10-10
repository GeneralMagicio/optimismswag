<?php
$introData = getSpecificPostDataByCategory('post', 108);
?>

<?php if (sizeof($introData) > 0): ?>

    <?php
    // Prepare data
    $subText = get_field('subcontent', $introData['post_id']);
    $link = get_field('link', $introData['post_id']);
    ?>

    <!-- start:home-dao-intro -->
    <div class="home-dao-intro">

        <!-- start:container -->
        <div class="container">

            <!-- start:home-dao-intro-inside -->
            <div class="home-dao-intro-inside">

                <!-- start:row -->
                <div class="row align-items-center">

                    <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                        <div class="title">
                            <?php echo $introData['post_content']; ?>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="text">
                            <?php echo nl2br($subText); ?>
                        </div>
                        <?php if ($link): ?>
                            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"
                               class="link"><?php echo $link['title']; ?></a>
                        <?php endif; ?>
                    </div>

                </div>
                <!-- end:row -->

            </div>
            <!-- end:home-dao-intro-inside -->

        </div>
        <!-- end:container -->

    </div>
    <!-- end:home-dao-intro -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>