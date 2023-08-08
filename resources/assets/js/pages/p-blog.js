import Slick from 'slick-carousel';

export default function() {

    let $body = $("body"),
        $articleSliderBlock = $body.find('.product-blog-slider--js');

    function productsBlogSlider() {
        $articleSliderBlock.slick({
            dots: false,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            speed: 1500,
            cssEase: 'cubic-bezier(0.65, 0.05, 0.36, 1)',
            responsive: [
                {
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    }
    productsBlogSlider();
}
