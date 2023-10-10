<?php
$introJoinData = getSpecificPostDataByCategory('post', 107);
?>

<?php if (sizeof($introJoinData) > 0): ?>

    <?php
    // Prepare data
    $subText = get_field('subcontent', $introJoinData['post_id']);
    $link = get_field('link', $introJoinData['post_id']);
    ?>

    <!-- start:footer-join-->
    <div class="footer-join">

        <!-- start:container -->
        <div class="container">

            <!-- start:footer-join-inside -->
            <div class="footer-join-inside">

                <!-- start:row -->
                <div class="row justify-content-end">

                    <div class="col-12 col-lg-5 footer-join-left">

                    </div>
                    <div class="col-12 col-lg-7 footer-join-right">
                        <div class="title">
                            <?php echo $introJoinData['post_content']; ?>
                        </div>
                        <div class="text">
                            <?php echo $introJoinData['post_title']; ?>
                        </div>
                        <button data-bs-toggle="modal" data-bs-target="#joinModal" class="btn-join"><?php _e('Suscribe', 'template'); ?></button>
                    </div>

                </div>
                <!-- end:row -->

            </div>
            <!-- end:footer-join-inside -->

        </div>
        <!-- end:container -->

    </div>
    <!-- end:footer-join-->

    <!-- Modal -->
    <div class="modal fade" id="joinModal" tabindex="-1" aria-labelledby="JoinModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe src="https://paragraph.xyz/@generalmagic/embed" width="480" height="480" style="border:1px solid #EEE; background:white;" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>