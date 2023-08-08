export default function() {
    let $body = $("body"),
        $header = $(".header--js"),
        $mobileMenuBtn = $header.find(".btn-menu--js"),
        $mobileMenuBtnClose = $header.find(".btn-menu-close--js"),
        $mobileMenuBg = $header.find(".header-mobile-bg--js"),
        $mobileMenu = $header.find(".header-mobile--js");

    let $mobileSubmenu = $mobileMenu.find(".sub-catalog--js");
    let $mobileSubmenuBtn = $mobileMenu.find(".btn-sub-catalog--js");
    let $mobileSubmenuBack = $mobileMenu.find(".btn-sub-back--js");

    function mobileMenu() {
        $mobileMenuBtn.on("click", function() {

            $body.addClass("opened-mobile-menu");
            $mobileMenu.addClass("open");
            $mobileMenuBg.addClass("open");

        });
        $mobileMenuBtnClose.on("click", function() {
            $body.removeClass("opened-mobile-menu");
            $mobileMenu.removeClass("open");
            $mobileMenuBg.removeClass("open");
        });



        $mobileSubmenuBtn.on("click", function(e) {
            $mobileSubmenu.addClass('open');
        });
        $mobileSubmenuBack.on("click", function() {
            $mobileSubmenu.removeClass('open');
        });

        $mobileMenuBg.on("click", function() {
            $body.removeClass("opened-mobile-menu");
            $mobileMenu.removeClass("open");
            $mobileMenuBg.removeClass("open");
            $mobileSubmenu.removeClass('open');
        });
    }

    mobileMenu();



    let el,
        $btnModal = $body.find('.btn-modal-login--js'),
        $windowModal = $body.find('.section-modal--js'),
        $modalBlock = $body.find('.modal-block--js'),
        $btnClose = $body.find('.btn-modal-close--js'),
        $modalBg = $body.find('.modal-bg--js');
    // $linkScroll = $body.find('.link-scroll');
    function blockModalMobileLogin() {
        console.log('modal block');
        $btnModal.on("click", function() {
            $body.removeClass("opened-mobile-menu");
            $mobileMenu.removeClass("open");
            $mobileMenuBg.removeClass("open");
            $body.removeClass('open-modal').find($btnModal).removeClass('btn-active');
            $windowModal.removeClass('show-modal').find($modalBlock).removeClass('open');
            $modalBg.removeClass("open");
            console.log('modal click');
            $(this).addClass('btn-active');
            el = $(this).attr('data-modal');
            $body.addClass('open-modal');
            $windowModal.addClass('show-modal').find($modalBlock).filter('[data-modal="' + el + '"]').addClass('open');
            $modalBg.addClass("open");
        });
        $btnClose.on("click", function() {
            $body.removeClass('open-modal').find($btnModal).removeClass('btn-active');
            $windowModal.removeClass('show-modal').find($modalBlock).removeClass('open');
            $modalBg.removeClass("open");
        });
        $modalBg.on("click", function() {
            $body.removeClass('open-modal').find($btnModal).removeClass('btn-active');
            $windowModal.removeClass('show-modal').find($modalBlock).removeClass('open');
            $modalBg.removeClass("open");
        });
    }


    if (screen.width <= 1024) {
        blockModalMobileLogin();
    }

    // window.addEventListener("resize", () => {
    //     if (screen.width <= 1024) {
    //         blockModalMobileLogin();
    //     }
    // });
}
