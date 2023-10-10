jQuery(document).ready(function () {

    /**
     * Check storage change for getting user address and domains
     */
    jQuery(window).bind('storage', function (es) {
        const address = localStorage.getItem('mainAddress');

        // Set up session address
        const sessionAddressCheck = localStorage.getItem('sessionAddress');
        if (!sessionAddressCheck) {
            localStorage.setItem('sessionAddress', address);
        }

        if (address) {

            // Check if user changed address
            const sessionAddress = localStorage.getItem('sessionAddress');
            if (sessionAddress != address) {
                resetStorageValues();
                localStorage.setItem('sessionAddress', address);
            }

            setUpUserCryptoAddress(address);

        }

        const nfts = localStorage.getItem('impactNfts');

        if (address && nfts) {
            setUpUserNFTs(address, jQuery.parseJSON(nfts));
        }

    });

    setUpDisconnectButton();

    // disable add to cart button
    if (jQuery('#mint_product_id').length > 0) {
        jQuery('.single_add_to_cart_button').hide();
    }

    jQuery('.btn-connect').on('click', function () {
        jQuery('#connectHeader button').trigger('click');
    });

});

/**
 * Set up user crypto address
 *
 * @param address
 */
function setUpUserCryptoAddress(address) {
    if (address) {
        jQuery.ajax({
            type: "POST",
            url: "/wp-admin/admin-ajax.php",
            data: 'action=set_crypto_address&address=' + address + '&impactHash=' + localStorage.getItem('impactHash')
                + '&impactSign=' + localStorage.getItem('impactSign') + '&wagmiwallet=' + localStorage.getItem('wagmi.wallet'),
            success: function (data) {
                var response_data = jQuery.parseJSON(data.substring(0, data.length - 1));

                if (response_data.status == 1) {
                    console.log('connected');
                }
            },
            error: function () {
            },
            complete: function () {
            }
        });
    }
}

/**
 * Track changes when user connect / disconnect
 */
function setUpDisconnectButton() {

    const targetNode = document.getElementById('connectHeader');
    const config = {attributes: true, childList: true, subtree: true};
    const callback = (mutationList, observer) => {
        for (const mutation of mutationList) {
            if (mutation.type === 'childList') {
                hideMobileDisconnect();
            } else if (mutation.type === 'attributes') {
            }
        }
    };
    const observer = new MutationObserver(callback);
    observer.observe(targetNode, config);

    // First setup
    hideMobileDisconnect();

}

/**
 * Hide disconnect button on mobile
 */
function hideMobileDisconnect() {
    const connectDiv = jQuery('#connectHeader');
    const buttonText = jQuery('#connectHeader button').text();
    if (buttonText === 'Connect Wallet') {
        jQuery('#navbarsDefault .nav-disconnect').hide();
    } else {
        jQuery('#navbarsDefault .nav-disconnect').show();
    }

    // Check if changed network
    if (buttonText === 'Switch network') {
        jQuery('#connectHeader button').trigger('click');
    }

}

/**
 * Set up user NFTs
 *
 * @param address
 * @param domains
 */
function setUpUserNFTs(address, nfts) {

    if (address && nfts) {

        jQuery.ajax({
            type: "POST",
            url: "/wp-admin/admin-ajax.php",
            dataType: "json",
            data: {
                action: "set_ntfs",
                address: address,
                nfts: nfts,
                productID: jQuery('#mint_product_id').val(),
            },
            success: function (response_data) {

                if (response_data.user_nfts.length > 0) {
                    if (response_data.user_have_nfts) {
                        jQuery('.single_add_to_cart_button:last').show();
                        jQuery('.nft-check .intro').hide();
                        jQuery('.nft-check .buttons').hide();
                    }
                }

            },
            error: function () {
            },
            complete: function (data) {
            }
        });
    }

}

function resetStorageValues() {
    localStorage.setItem('impactNfts', '');
    localStorage.setItem('impactSign', '');
    localStorage.setItem('impactHash', '');
    if (jQuery('#mint_product_id').length > 0) {
        jQuery('.single_add_to_cart_button').hide();
    }
    jQuery('.nft-check .intro').show();
    jQuery('.nft-check .buttons').show();
}
