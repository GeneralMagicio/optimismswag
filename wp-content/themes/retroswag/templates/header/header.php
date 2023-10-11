<!-- start:header -->
<header class="header">

    <!-- start:container -->
    <div class="container">

        <!-- start:row -->
        <div class="row justify-content-between align-items-center">

            <div class="col-3 col-sm-auto col-md-3 ms-xl-3 ms-xxl-3 align-self-center order-0 column-second">
                <a href="/" title="<?php bloginfo('name'); ?>" class="d-block logo">
                    <img src="<?php echo TEMPLATEDIR; ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>" class="d-inline-block">
                </a>
            </div>

            <div class="col-auto ms-1 ms-xl-5 column-first">

                <nav class="navbar navbar-expand-lg nav-first">

                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsDefault" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <svg viewBox="0 0 100 80" width="30" height="30">
                            <rect width="100" height="10"></rect>
                            <rect y="30" width="100" height="10"></rect>
                            <rect y="60" width="100" height="10"></rect>
                        </svg>
                    </button>

                    <div class="navbar-collapse collapse">

                        <?php
                        $headerMenuArguments = array(
                            'theme_location'  => 	'header',
                            'menu'            => 	'',
                            'container'       => 	false,
                            'container_class' => 	null,
                            'container_id'    => 	null,
                            'menu_class'      => 	'navbar-nav mr-auto',
                            'menu_id'         => 	'',
                            'echo'            => 	true,
                            'fallback_cb'     => 	'wp_page_menu',
                            'before'          => 	'',
                            'after'           => 	'',
                            'link_before'     =>	'',
                            'link_after'      => 	'',
                            'items_wrap'      => 	'<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth'           => 	4,
                            'walker' 			=> 	new wp_bootstrap4_navwalker()
                        );

                        wp_nav_menu( $headerMenuArguments );
                        ?>

                    </div>

                </nav>

            </div>

            <div class="col-auto col-sm-auto ms-auto ms-lg-0 ml-lg-5 column-third">
                <div class="search-box search-box-desktop">
                    <form action="/" method="get">
                        <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="<?php _e('Search For items, brands...', 'template'); ?>" />
                        <input type="submit" value="<?php _e('Search', 'template'); ?>" />
                    </form>
                </div>
                <a href="<?php echo wc_get_cart_url(); ?>" class="d-inline-block cart-icon">Cart Link<span class="btn-cart-top-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span></a>
                <div id="connectHeader"></div>
            </div>

            <div class="col-12 navbar-collapse collapse order-5" id="navbarsDefault" aria-expanded="false">

                <?php
                $headerMenuArguments = array(
                    'theme_location'  => 	'header',
                    'menu'            => 	'',
                    'container'       => 	false,
                    'container_class' => 	null,
                    'container_id'    => 	null,
                    'menu_class'      => 	'navbar-nav mr-auto',
                    'menu_id'         => 	'',
                    'echo'            => 	true,
                    'fallback_cb'     => 	'wp_page_menu',
                    'before'          => 	'',
                    'after'           => 	'',
                    'link_before'     =>	'',
                    'link_after'      => 	'',
                    'items_wrap'      => 	'<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 	4,
                    'walker' 			=> 	new wp_bootstrap4_navwalker()
                );

                wp_nav_menu( $headerMenuArguments );
                ?>

                <div class="search-box search-box-mobile">
                    <form action="/" method="get">
                        <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="<?php _e('Search For items, brands...', 'template'); ?>" />
                        <input type="submit" value="<?php _e('Search', 'template'); ?>" />
                    </form>
                </div>

            </div>

        </div>
        <!-- end:row -->

    </div>
    <!-- end:container -->

</header>
<!-- end:header -->