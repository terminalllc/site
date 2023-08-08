import gsap from "gsap";

export default function () {

    let $body = $('body'),
        el,$tabsBlockThis,$this,
        $tabsBlock = $body.find('.tabs--js'),
        $tabsHeadItem = $tabsBlock.find('.tabs-head-item'),
        $tabsContentItem = $tabsBlock.find('.tabs-content-item'),
        $tabsContentItemTitle = $tabsContentItem.find('.tabs-content-title'),
        $tabsContentItemBlock = $tabsContentItem.find('.tabs-content-block'),
        $orderItem = $body.find('.c-order-item'),
        $orderItemTitle = $body.find('.c-order-item'),
        $orderItemThis,$orderItemContentThis,$tabsContentItemThis,$tabsContentItemBlockThis,
        $orderItemContent = $orderItem.find(".c-order-item-text");
    function profileTabs() {

        $tabsHeadItem.on("click",function() {
            $this = $(this);
            el = $this.attr('data-tabs');

            $tabsBlockThis = $this.closest($tabsBlock);
            $tabsBlockThis.find($tabsHeadItem).removeClass('active');
            $tabsBlockThis.find($tabsContentItem).removeClass('active');
            $this.addClass('active');
            $tabsBlockThis.find($tabsContentItem).filter('[data-tabs="' + el + '"]').addClass('active');
        });
    }

    profileTabs();

    function orderTabFunc() {
        $orderItemTitle.on('click', function () {

            $orderItemThis = $(this).closest($orderItem);
            $orderItemContentThis = $orderItemThis.find($orderItemContent);
            if ($orderItemContentThis.height() !== 0) {
                gsap.timeline().to($orderItemContentThis, 0.3, {
                    height: 0,
                });
                $orderItemThis.removeClass("active");
            } else {
                gsap.timeline().to($orderItemContentThis, 0.3, {
                    height: "auto",
                });
                $orderItemThis.addClass("active");
            }
        });
    }
    orderTabFunc();

    function mobileTabFunc() {
        $tabsContentItemTitle.on('click', function () {

            $tabsContentItemThis = $(this).closest($tabsContentItem);
            $tabsContentItemBlockThis = $tabsContentItemThis.find($tabsContentItemBlock);
            if ($tabsContentItemBlockThis.height() !== 0) {
                gsap.timeline().to($tabsContentItemBlockThis, 0.5, {
                    height: 0,
                    // onUpdate: () => window.dispatchEvent(new Event('resize'))
                });
                $tabsContentItemThis.removeClass("open");
            } else {
                gsap.timeline().to($tabsContentItemBlockThis, 0.5, {
                    height: "auto",

                });
                $tabsContentItemThis.addClass("open");
            }
        });
    }

    if (screen.width <= 768) {
        mobileTabFunc();
    }
    // window.addEventListener("resize", () => {
    //     if (screen.width <= 768) {
    //         mobileTabFunc();
    //     }
    // });
    // $( window ).resize(function() {
    //     if (screen.width <= 768) {
    //         mobileTabFunc();
    //     }
    // });
}
