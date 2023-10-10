<?php

/**
 * Set up NFTs
 *
 */
function set_ntfs()
{
    $defaultDomainImage = TEMPLATEDIR . '/images/default-avatar.svg';

    $return_data = array();
    $return_data['status'] = 1;
    $return_data['user_nfts'] = [];
    $return_data['user_have_nfts'] = false;

    // Get post data
    $address = filter_var($_POST['address']);
    $productID = filter_var($_POST['productID']);
    $return_data['user_nfts'] = (isset($_POST['nfts']) && is_array($_POST['nfts'])) ? filter_var_array($_POST['nfts']) : [];

    if (sizeof($return_data['user_nfts']) > 0 && trim($address) != '' && $address !== 'undefined' && $productID) {

        $contractAddress = strtolower(get_field('contract_address', $productID));

        foreach ($return_data['user_nfts'] as $nft) {
            if (isset($nft['contract']['address']) && strtolower($nft['contract']['address']) == strtolower($contractAddress)) {
                $return_data['user_have_nfts'] = true;
            }
        }

        $_SESSION['user_have_nfts'] = $return_data['user_have_nfts'];

        $return_data['status'] = 1;
    } else {
        $return_data['user_nfts'] = [];
    }



    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($return_data);
    die();
}

add_action('wp_ajax_nopriv_set_ntfs', 'set_ntfs');
add_action('wp_ajax_set_ntfs', 'set_ntfs');