import gsap from "gsap";

export default function () {
    let   $body = $("body");
    let $faqItem = $body.find('.c-faq-item');
    let $faqItemTitle = $body.find('.c-faq-item');
    let $faqItemThis,$faqItemContentThis;
    let $faqItemContent = $faqItem.find(".c-faq-item-text");
    function faqFunc() {
        $faqItemTitle.on('click', function () {

            $faqItemThis = $(this).closest($faqItem);
            $faqItemContentThis = $faqItemThis.find($faqItemContent);
            if ($faqItemContentThis.height() !== 0) {
                gsap.timeline().to($faqItemContentThis, 0.3, {
                    height: 0,
                    // onUpdate: () => window.dispatchEvent(new Event('resize'))
                });
                $faqItemThis.removeClass("active");
            } else {
                gsap.timeline().to($faqItemContentThis, 0.3, {
                    height: "auto",
                    // onUpdate: () => window.dispatchEvent(new Event('resize'))
                });
                $faqItemThis.addClass("active");
            }
        });
    }
    faqFunc();

}
