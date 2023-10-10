jQuery(document).ready(function () {
    productSliderInit('.product-slider');
});

/**
 * This function initializes the product slider.
 *
 * @param sliderParent
 */
function productSliderInit(sliderParent) {
    var instance = jQuery(sliderParent);
    jQuery.each(instance, function (key, value) {

        var arrows = jQuery(instance[key]).find(".arrow"),
            prevArrow = arrows.filter('.arrow-prev'),
            nextArrow = arrows.filter('.arrow-next'),
            box = jQuery(instance[key]).find(".slider-wrapper-holder"),
            x = 0,
            mx = 0,
            maxScrollWidth = box[0].scrollWidth - (box[0].clientWidth / 2) - (box.width() / 2);

        jQuery(arrows).on('click', function () {

            if (jQuery(this).hasClass("arrow-next")) {
                x = ((box.width() / 2)) + box.scrollLeft() - 10;
                box.animate({
                    scrollLeft: x,
                })
            } else {
                x = ((box.width() / 2)) - box.scrollLeft() - 10;
                box.animate({
                    scrollLeft: -x,
                })
            }

        });

        jQuery(box).on({
            mousemove: function (e) {
                var mx2 = e.pageX - this.offsetLeft;
                if (mx) this.scrollLeft = this.sx + mx - mx2;
            },
            mousedown: function (e) {
                this.sx = this.scrollLeft;
                mx = e.pageX - this.offsetLeft;
            },
            scroll: function () {
                toggleArrows();
            }
        });

        jQuery(document).on("mouseup", function () {
            mx = 0;
        });

        function toggleArrows() {
            if (box.scrollLeft() > maxScrollWidth - 10) {
                // disable next button when right end has reached
                nextArrow.addClass('disabled');
            } else if (box.scrollLeft() < 10) {
                // disable prev button when left end has reached
                prevArrow.addClass('disabled')
            } else {
                // both are enabled
                nextArrow.removeClass('disabled');
                prevArrow.removeClass('disabled');
            }
        }

    });
}
