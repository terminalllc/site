import header from "./components/c-header";
import faq from "./components/c-faq";
import modal from "./components/c-modal";
import "select2";
import "jquery-mask-plugin";

export default function() {

    header();
    faq();
    modal();
    let $body = $("body"),
        $window = $(window),
        $select = $body.find(".select-customs--js"),
        $selectBranch = $body.find(".select-customs-branch--js"),
        $selectMountPayment = $body.find(".select-customs-mount-payment--js"),
        $formBlock = $body.find('.form-block'),
        $formBlockPhone = $formBlock.find('.form-item-phone'),
        $phoneInput = $formBlockPhone.find('input'),
        $breadcrumbs = $body.find(".breadcrumbs"),
        $breadcrumbsUl = $breadcrumbs.find(".breadcrumbs ul"),
        breadcrumbsUlWidth = $breadcrumbsUl.width(),
        winWidthScreen = $window.width();

    function initSelect2() {

        $select.select2({
            language: {
                noResults: function() {
                    return ''
                }
            },

        });
        $selectBranch.select2({
            language: {
                noResults: function() {
                    return ''
                }
            },
        });
        $selectMountPayment.select2({
            language: {
                noResults: function() {
                    return ''
                }
            },
            // matcher: matchCustom
        });
    }

    function phoneMask() {
        $phoneInput.mask('+38 (000) 000-00-00');
/*         $phoneInput.on("click", function() {
            $phoneInput.mask('+38 (000) 000-00-00');
        }); */
    }

    function breadcrumbsFunc() {
        if (breadcrumbsUlWidth >= winWidthScreen) {
            $breadcrumbs.addClass('long-width');

        } else {
            return false;
        }
    }

    // window.addEventListener("resize", () => {
    //     breadcrumbsFunc();
    // })
}
