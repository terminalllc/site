import Plyr from 'plyr';


export default function() {


    let $body = $('body'),
        el, $tabsBlockThis, $this, dataId, dataIdClick, $tabsContentItemthis,
        //$tabsBlock = $body.find('.p-product-tabs'),
        //$tabsHeadItem = $tabsBlock.find('.tabs-head-item'),
        //$tabsContentItem = $tabsBlock.find('.tabs-content-item'),
        $productSlider = $body.find('.product-img-slider--js'),
        $productSliderMain = $productSlider.find('.product-img-main-slider--js'),
        $productSliderPreview = $productSlider.find('.product-img-prev-js'),
        $productSliderPreviewItem = $productSlider.find('.product-img-prev-item'),

        $productSliderPreviewThis;
        //$linkReview = $body.find('.product-review-review--link');

    const controls = [
        'play-large', // The large play button in the center
        'play', // Play/pause playback
        'progress', // The progress bar and scrubber for playback and buffering
        'current-time', // The current time of playback
    ];

    const playerProduct = new Plyr('#player-product', { controls });


/*     function jumpToReviewTab() {
        $linkReview.on("click", function() {
            $tabsBlockThis = $tabsBlock.closest($tabsBlock);
            $tabsBlockThis.find($tabsHeadItem).removeClass('active');
            $tabsBlockThis.find($tabsContentItem).removeClass('active');
            $tabsBlock.find($tabsHeadItem).filter('[data-tabs="review"]').addClass('active');
            $tabsBlockThis.find($tabsContentItem).filter('[data-tabs="review"]').addClass('active');
            $tabsHeadItem[0].scrollIntoView(top)
        });
    } */

/*     function productTabs() {
        $tabsHeadItem.on("click", function() {
            $this = $(this);
            el = $this.attr('data-tabs');
            $tabsBlockThis = $this.closest($tabsBlock);
            $tabsBlockThis.find($tabsHeadItem).removeClass('active');
            $tabsBlockThis.find($tabsContentItem).removeClass('active');
            $this.addClass('active');
            $tabsBlockThis.find($tabsContentItem).filter('[data-tabs="' + el + '"]').addClass('active');
        });
    } */
    function productSlider() {
        $productSliderMain.slick({
            dots: false,
            arrows: false,
            fade: true,
            asNavFor: $productSliderPreview,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 640,
                settings: {
                    arrows: true,
                }
            }]
        });
        $productSliderPreview.on('click', '.slick-slide',
            function() {
                $productSliderPreviewThis = $(this).find($productSliderPreviewItem);
                if ($productSliderPreviewThis.hasClass('video')) {
                    playerProduct.play();
                }
                else{
                    playerProduct.pause();
                }
            });
        $productSliderMain.on('afterChange', function() {
            $productSliderPreviewThis = $('.slick-current').find($productSliderPreviewItem);
            if ($productSliderPreviewThis.hasClass('video')) {
                playerProduct.play();
            }
            else{
                playerProduct.pause();
            }
        });
        $productSliderPreview.slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: $productSliderMain,
            dots: false,
            focusOnSelect: true,
            responsive: [{
                breakpoint: 640,
                settings: {
                    slidesToShow: 4,
                }
            }]
        });



    }

    //productTabs();
    productSlider();
    //jumpToReviewTab();
}
