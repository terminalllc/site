import Slick from 'slick-carousel';

export default function() {


    let $body = $("body"),
        $window = $(window),

        $firstSliderBlock = $body.find('.first-slider-block--js');

    function mainSlider() {
        $firstSliderBlock.slick({
            dots: false,
            arrows: false,
            infinite: true,
            fade: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            speed: 1500,
            autoplay: true,
            cssEase: 'cubic-bezier(0.65, 0.05, 0.36, 1)',
        });
    }
    mainSlider();
}
