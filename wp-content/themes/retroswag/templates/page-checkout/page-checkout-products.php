<?php

global $woocommerce;

$items = $woocommerce->cart->get_cart();
?>
<?php if (sizeof($items) > 0): ?>


    <div class="cart-inside">

        <div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">


            <!-- start:cart-items -->
            <div class="cart-items">

                <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item): ?>

                    <?php
                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);

                    ?>

                    <div class="woocommerce-cart-form__cart-item cart_item">

                        <!-- start:cart-item-left -->
                        <div class="cart-item-left">

                            <div class="product-thumbnail">
                                <?php
                                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                if (!$product_permalink) {
                                    echo $thumbnail; // PHPCS: XSS ok.
                                } else {
                                    printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                                }
                                ?>
                            </div>

                        </div>
                        <!-- end:cart-item-left -->

                        <!-- start:cart-item-right -->
                        <div class="cart-item-right">

                            <!-- start:item-right-left -->
                            <div class="item-right-left">

                                <div class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                                    <?php

                                    if (!$product_permalink) {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key) . '&nbsp;');
                                    } else {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_title()), $cart_item, $cart_item_key));
                                    }

                                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                    // Meta data.
                                    echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                    // Backorder notification.
                                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                                    }

                                    // Get products tags
                                    $tagTitle = '';
                                    $tags = get_the_terms($_product->id, 'product_tag');
                                    if($tags){
                                        foreach ($tags as $tag) {
                                            $tagTitle = $tag->name;
                                        }
                                    }
                                    ?>
                                    <?php if ($tagTitle): ?>
                                        <h3><?php echo $tagTitle; ?></h3>
                                    <?php endif; ?>
                                </div>

                                <!-- start:product-bellow-title -->
                                <div class="product-bellow-title">

                                    <?php
                                    $variation = (method_exists($_product, 'get_variation_attributes')) ? $_product->get_variation_attributes() : [];

                                    $variationLabel = (isset($variation['attribute_pa_size'])) ? $variation['attribute_pa_size'] : '';
                                    ?>
                                    <?php if ($variationLabel): ?>
                                        <div class="variation-label">
                                            <?php echo $variationLabel; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    $variationColorLabel = (isset($variation['attribute_pa_color'])) ? $variation['attribute_pa_color'] : '';
                                    ?>
                                    <?php if ($variationColorLabel): ?>
                                        <div class="variation-label">
                                            <?php echo $variationColorLabel; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="product-quantity"
                                         data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                                        <div class="product-quantity-div">
                                            <?php echo $cart_item['quantity']; ?>
                                        </div>
                                    </div>

                                </div>
                                <!-- end:product-bellow-title -->

                            </div>
                            <!-- end:item-right-left -->

                            <!-- start:item-right-right -->
                            <div class="item-right-right">

                                <div class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                                    <?php
                                    echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                    ?>
                                </div>

                                <div class="product-subtotal"
                                     data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
                                    <?php
                                    echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                    ?>
                                </div>

                            </div>
                            <!-- end:item-right-right -->

                        </div>
                        <!-- end:cart-item-right -->

                    </div>

                <?php endforeach; ?>

            </div>
            <!-- end:cart-items -->

        </div>

        <div class="subtotal">
            <h3>Subtotal <span>$<?php echo WC()->cart->get_subtotal(); ?></span></h3>

            <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
                <div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?> mt-3">
                    <div><?php wc_cart_totals_coupon_label($coupon); ?></div>
                    <div data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php wc_cart_totals_coupon_html($coupon); ?></div>
                </div>
            <?php endforeach; ?>

            <?php if( WC()->cart->get_coupons() && !empty(WC()->cart->get_coupons()) ): ?>
                <div class="cart-subtotal total-sub mt-3">
                    <div><?php esc_html_e('Total', 'woocommerce'); ?></div>
                    <div data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>"><?php wc_cart_totals_order_total_html(); ?></div>
                </div>
            <?php endif; ?>

        </div>

    </div>

<?php endif; ?>