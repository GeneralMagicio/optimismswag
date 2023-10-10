jQuery(document).ready(function () {

    // Set up images
    setUpImages();

    // Set up product loading
    setUpProductLoading();

    // Set up product quantity
    jQuery('.cw_qty').selectpicker();
    jQuery(document).on("ajaxComplete", function (event, xhr, settings) {
        jQuery('.cw_qty').selectpicker();
        setQuantityCartUpdate();
    });
    jQuery( document.body ).on( 'updated_cart_totals', function(){
        jQuery('.cw_qty').selectpicker();
        setQuantityCartUpdate();
    });

    // Set up quantity cart submit
    setQuantityCartUpdate();

    // Set up clone menu
    setUpCloneMenu();

    setIframeCss();

    fixCheckmarkIssue();

});

jQuery(window).load(function () {

    // Set up images
    setUpImages();

    // Fix checkmark issue
    fixCheckmarkIssue();

    setIframeCss();

});

jQuery(document).ajaxStop(function () {
    fixCheckmarkIssue();
});

/*
* Set up on scroll sticky menu
*
* @param ev
*/
window.onscroll = function (ev) {

    // Set up sticky menu
    setUpStickyMenu();
};

function fixCheckmarkIssue() {
    jQuery('.checkmark').click(function () {
        jQuery(this).siblings('label').trigger('click');
    });
}

/**
 * Set up images
 */
function setUpImages() {

    var calScreenWidth = jQuery(window).width();

    if (calScreenWidth > 600) {
        jQuery('.product-list img').removeAttr('height').removeAttr('width');
        jQuery('.best-seller .product-list img').removeAttr('height').removeAttr('width');
    } else if (calScreenWidth <= 600) {
        jQuery('.product-list img').removeAttr('height').removeAttr('width');
        jQuery('.best-seller .product-list img').removeAttr('height').removeAttr('width');
    }

}

/**
 * Set up product loading
 */
function setUpProductLoading() {

    const paginationDiv = document.getElementById('product-pagination');

    jQuery('#product-pagination').find('a').click(function (e) {
        e.preventDefault();
        const current = jQuery(this);
        const page = current.attr('data-str');
        if (page > 0) {
            jQuery('#home-product-list .over').show();
            jQuery('.loading').show();

            jQuery.ajax({
                type: "POST",
                url: "/wp-admin/admin-ajax.php",
                data: 'action=get_home_products&str=' + page,
                success: function (data) {
                    var response_data = jQuery.parseJSON(data.substring(0, data.length - 1));

                    if (response_data.status == 1) {

                        document.getElementById('home-product-list').scrollIntoView();

                        jQuery('#home-product-list .row').html(response_data.content);
                        jQuery('.pagination-over').html(response_data.pagination);

                        setUpProductLoading();

                        // Set up images
                        setUpImages();
                    }

                    jQuery('#home-product-list .over').hide();
                    jQuery('.loading').hide();
                },
                error: function () {
                    jQuery('#home-product-list .over').hide();
                    jQuery('.loading').hide();
                },
                complete: function () {

                }
            });

        }
    });
}

function setUpCloneMenu() {
    const header = jQuery(".header");
    const clone = header.before(header.clone().addClass("clone"));
}

/**
 * Set up sticky menu
 */
function setUpStickyMenu() {

    const header = document.querySelector(".header.clone");
    const headerNotCloned = document.querySelector(".header");
    const offTop = headerNotCloned.offsetTop;
    const calScreenWidth = jQuery(window).width();

    if (window.scrollY >= 185 && calScreenWidth > 992) {
        if (header && !header.classList.contains('sticky')) {
            header.classList.add('sticky');
        }
    } else if (window.scrollY >= 120 && calScreenWidth <= 992) {
        if (!header.classList.contains('sticky')) {
            header.classList.add('sticky');
        }
    } else {
        if (offTop <= 0 && calScreenWidth > 992) {
            header.classList.remove('sticky');
        } else if (window.scrollY < 30 && calScreenWidth <= 992) {
            header.classList.remove('sticky');
        }
    }

}

/**
 * Change select option of product size by clicking on link option
 *
 * @param selectedSizeElement
 * @param selectElementID
 * @param size
 */
function changeProductSize(selectedSizeElement, selectElementID, size) {

    const selectElement = jQuery('#' + selectElementID);

    if (selectElement) {

        selectElement.val(size);
        selectElement.change();

        // Remove classes from other sizes
        const elements = document.getElementsByClassName('btn-size ' + selectElementID);
        [].forEach.call(elements, function (el) {
            el.classList.remove('selected');
        });

        selectedSizeElement.classList.add('selected');
    }
}

/**
 * Set up cart quantity update when user change it
 */
function setQuantityCartUpdate() {

    jQuery('.page-template-page-cart .cw_qty').on('changed.bs.select', function (e, clickedIndex, newValue, oldValue) {
        jQuery('[name=update_cart]').removeAttr('disabled').trigger('click');
    });

}

jQuery(document).ajaxComplete(function () {
    setTimeout(function () {

        setQuantityCartUpdate();

    }, 500);
});

function setIframeCss() {
    jQuery('iframe').each(function () {
        function injectCSS() {
            $iframe.contents().find('head').append(
                jQuery('<link/>', {
                    rel: 'stylesheet',
                    href: 'https://gmswagtest.somevps.com/wp-content/themes/gmswag/css/iframe.css',
                    type: 'text/css'
                })
            );
        }

        const $iframe = jQuery(this);
        $iframe.on('load', injectCSS);
        injectCSS();
    });
}

/**
 * Fix checkmark custom radio button click option
 */
function fixCheckmarkIssue() {
    jQuery('.wc_payment_method').on('click', function (e) {
        jQuery('.wc_payment_method .payment_box').hide();
        jQuery(this).find('.input-radio').prop("checked", true);
        jQuery(this).find('.payment_box').show();
    });
}