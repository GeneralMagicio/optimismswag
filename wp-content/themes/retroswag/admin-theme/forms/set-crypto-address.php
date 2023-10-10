<?php

/**
 * Set up crypto address
 *
 */
function set_crypto_address()
{

    $return_data = array();
    $return_data['status'] = 0;

    // Get post data
    $address = filter_var($_POST['address']);
    $impactHash = filter_var($_POST['impactHash']);
    $impactSign = filter_var($_POST['impactSign']);
    $wagmiwallet = filter_var($_POST['wagmiwallet']);

    if(trim($address) != '' && $address !== 'undefined' && trim($impactHash) != ''){
//        saveUserAddressLog($address, $impactHash, $impactSign, $wagmiwallet);
    }

    if (trim($address) != '' && $address !== 'undefined') {

        $_SESSION['user_wallet_address'] = $address;
        $_SESSION['wa_hash'] = $impactHash;
        $_SESSION['impactSign'] = $impactSign;

        $return_data['status'] = 1;

    } else {
        $_SESSION['user_wallet_address'] = '';
        $return_data['status'] = 2;
    }

    echo json_encode($return_data);

}

add_action('wp_ajax_nopriv_set_crypto_address', 'set_crypto_address');
add_action('wp_ajax_set_crypto_address', 'set_crypto_address');


/**
 * Save all data related to user address
 *
 * @param $address
 * @param $enshash
 * @param $impactSign
 * @param $wagmiwallet
 * @return bool
 */
function saveUserAddressLog($address, $enshash, $impactSign, $wagmiwallet){

    global $wpdb;

    $query = $wpdb->get_row(
        "
                SELECT id FROM wenp_ens_user_logs
                WHERE user_address='{$address}' AND  user_hash='{$enshash}' LIMIT 1
        ");

    // Update log
    if (isset($query->id) && $query->id > 0) {
        $data = [
            'user_address' => $address,
            'user_hash' => $enshash,
            'user_sign' => $impactSign,
            'user_wagmi_wallet' => str_replace('"', '', $wagmiwallet),
            'user_server' => json_encode($_SERVER),
            'user_session' => json_encode($_SESSION),
        ];

        $format = [
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
        ];

        $data_where = ['id' => $query->id];
        $where_format = ['%s'];

        $result = $wpdb->update('wenp_ens_user_logs', $data, $data_where, $format, $where_format);
    }
    // Insert log
    else{
        $data = [
            'user_address' => $address,
            'user_hash' => $enshash,
            'user_sign' => $impactSign,
            'user_wagmi_wallet' => str_replace('"', '', $wagmiwallet),
            'user_server' => json_encode($_SERVER),
            'user_session' => json_encode($_SESSION),
            'created_at' => date("Y-m-d H:i:s"),
        ];

        $format = [
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
        ];

        $result = $wpdb->insert('wenp_ens_user_logs', $data, $format);

    }

    return true;
}