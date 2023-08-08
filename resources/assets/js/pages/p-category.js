import gsap from "gsap";

export default function() {

    let $body = $('body'),
        $modalBlockRelParent = $body.find('.sidebar'),
        $selectFilter = $body.find(".select-filter--js"),
        $filterBlock = $body.find('.filter-option-list'),
        $filterContentItem = $filterBlock.find('.filter-option-block-wrap'),
        $filterContentItemTitle = $filterContentItem.find('.filter-option-block-title'),
        $filterContentItemBlock = $filterContentItem.find('.filter-option-checkboxes'),
        $filterOptionBtn = $body.find('.filter-option-mobile-btn--js'),
        $filterOptionMobileBg = $body.find('.filter-mobile-bg--js'),
        $filterContentItemThis, $filterContentItemBlockThis,
        $btnClose = $modalBlockRelParent.find('.filter-modal-close--js'),
        $filterOptionModal = $modalBlockRelParent.find('.filter-mobile--js');

    function initFilterSelect2() {
        $selectFilter.select2({
            width: '100%',
            minimumResultsForSearch: -1
        });
    }

    function filterOptionModal() {
        $filterOptionBtn.on("click", function() {

            $filterOptionMobileBg.addClass('open');
            $filterOptionModal.addClass('open-filter');
        });
        $btnClose.on("click", function() {
            $filterOptionModal.removeClass('open-filter');
            $filterOptionMobileBg.removeClass('open');
        });
        $filterOptionMobileBg.on("click", function() {
            $filterOptionModal.removeClass('open-filter');
            $filterOptionMobileBg.removeClass('open');
        });
    }

    function mobileFilterFunc() {
        $filterContentItemTitle.on('click', function() {

            $filterContentItemThis = $(this).closest($filterContentItem);
            $filterContentItemBlockThis = $filterContentItemThis.find($filterContentItemBlock);
            if ($filterContentItemBlockThis.height() !== 0) {
                gsap.timeline().to($filterContentItemBlockThis, 0.3, {
                    height: 0,
                });
                $filterContentItemThis.removeClass("open");
            } else {
                gsap.timeline().to($filterContentItemBlockThis, 0.3, {
                    height: "auto",
                });
                $filterContentItemThis.addClass("open");
            }
        });
    }

    if (screen.width <= 768) {
        mobileFilterFunc();
    }
    // window.addEventListener("resize", () => {
    //     if (screen.width <= 768) {
    //         mobileFilterFunc();
    //     }
    // });
    filterOptionModal();
    initFilterSelect2();

}
