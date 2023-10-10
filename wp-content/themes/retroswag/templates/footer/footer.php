<!-- start:footer -->
<footer class="footer">

    <!-- start:container -->
    <div class="container">

        <!-- start:row -->
        <div class="row justify-content-center align-items-center g-0 g-sm-5">

            <div class="col-12 col-lg-3">
                <div class="footer-first">
                    <div class="text"><?php _e('are you an Optimism DAO?', 'template'); ?></div>
                    <a href="https://www.optimism.io/" class="btn-join" target="_blank"><?php _e('JOIN OUR PLATFORM', 'template'); ?></a>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="footer-second">
                    <div class="row g-0">
                        <div class="col-12 col-md-10">
                            <div class="nav">
                                <?php
                                $headerMenuArguments = array(
                                    'theme_location' => 'footer',
                                    'menu' => '',
                                    'container' => false,
                                    'container_class' => null,
                                    'container_id' => null,
                                    'menu_id' => '',
                                    'echo' => true,
                                    'fallback_cb' => 'wp_page_menu',
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'depth' => 1,
                                );

                                wp_nav_menu($headerMenuArguments);
                                ?>
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="socials text-end">
                                <a href="https://twitter.com/retropgf"
                                   class="twitter" target="_blank"><?php _e('Twitter', 'template'); ?></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="footer-third">
                    <div class="row justify-content-center align-items-center g-1">
                        <div class="col-auto footer-third-left">
                            Created and managed by
                        </div>
                        <div class="col-auto footer-third-right">
                            <a href="https://generalmagic.io/" title="General Magic"><img src="<?php echo TEMPLATEDIR; ?>/images/gm-logo.svg" alt="General Magic Logo"></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end:row -->

    </div>
    <!-- end:container -->

</footer>
<!-- end:footer -->