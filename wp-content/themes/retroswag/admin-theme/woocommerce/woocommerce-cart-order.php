<?php

include __DIR__ . '/../forms/vendor/autoload.php';

use Agustind\EthSignature;

add_action('woocommerce_checkout_create_order', 'ens_woocommerce_checkout_create_order_action', 10, 2);

/**
 * Check wallet address signature before opening order
 *
 * @param  $order
 * @param  $data
 *
 * @return void
 */
function ens_woocommerce_checkout_create_order_action($order, $data)
{

    $orderSignError = false;
    $checkSignature = false;

    // Check if we have product that needs signature
    $items = $order->get_items();

    foreach ($items as $key => $item) {
        $productID = $item['product_id'];
        if (has_term(139, 'product_cat', $productID)) {
            $checkSignature = true;
            $_POST['wa_signature'] = $_SESSION['impactSign'];
            $_POST['wa_hash'] = $_SESSION['wa_hash'];
        }
    }

    if($checkSignature) {

        if (!isset($_POST['wa_signature'])) {
            unset($_POST);
            $orderSignError = true;
        } else {
            if (
                isset($_SESSION['user_wallet_address'])
            ) {

                $signature = new EthSignature();

                $is_valid = $signature->verify(
                    $_SESSION['wa_hash'],
                    $_POST['wa_signature'],
                    $_SESSION['user_wallet_address']);

                if (!$is_valid) {
                    $orderSignError = true;
                }

            } else {
                $orderSignError = true;
            }
        }

        // Check sign hash message from database if fail - Ledger problem
        if ($orderSignError) {
            $address = filter_var($_SESSION['user_wallet_address']);
            $enssign = filter_var($_POST['wa_signature']);

            if (isset($enssign)) {
                $dbSignature = $enssign;

                $lastTwoCharacterSign = substr($dbSignature, -2);
                if ($lastTwoCharacterSign == '00' || $lastTwoCharacterSign == '01') {

                    $dbSignature = ($lastTwoCharacterSign == '00') ? substr($dbSignature, 0, -2) . '1B' : $dbSignature;
                    $dbSignature = ($lastTwoCharacterSign == '01') ? substr($dbSignature, 0, -2) . '1C' : $dbSignature;

                    $is_valid = $signature->verify(
                        $_SESSION['wa_hash'],
                        $dbSignature,
                        $_SESSION['user_wallet_address']
                    );

                    if ($is_valid) {
                        $orderSignError = false;
                    }
                }

            }
        }

    }

    if ($orderSignError) {
        $_SESSION['wa_hash'] = '';
        $_SESSION['user_wallet_address'] = '';
        $_SESSION['user_nfts'] = [];

        $return_data['singature_order_check'] = 0;

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($return_data);

        die();
    }

}

add_action('woocommerce_checkout_order_processed', 'ens_checkout_processed', 1, 1);

add_action('woocommerce_checkout_order_processed', 'ens_checkout_processed', 1, 1);

/**
 * Manage cart processed.
 *
 * When order is paid or submitted we must send it to Printful,
 * check submission and make order in processed state on Printful
 *
 * @param $order_id
 *
 * @return void
 *
 * @throws Exception
 */
function ens_checkout_processed($order_id)
{
    // Check if order_id exist
    if ($order_id) {

        global $wpdb;

        $cartItems = WC()->cart->get_cart();

        $order = wc_get_order($order_id);
        $items = $order->get_items();

        // Save ENS name to order item metadata
        $checkAdded = [];
        foreach ($items as $key => $item) {
            $productID = $item['product_id'];
            if (has_term(139, 'product_cat', $productID)) {
            }
        }

    }

}