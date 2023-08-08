export default function () {

    let $body = $('body'),
        el,$modalBlockRelThis,
        $btnModal = $body.find('.btn-modal--js'),
        $btnModalRel = $body.find('.btn-modal-rel--js'),
        $windowModal = $body.find('.section-modal--js'),
        $modalBlock = $body.find('.modal-block--js'),
        $modalBlockRelParent = $body.find('.modal-block-rel-parent'),
        $modalBlockRel = $body.find('.modal-block-rel--js'),
        $btnClose = $body.find('.btn-modal-close--js'),
        $sectionNotifications = $body.find('.section-notifications--js'),
        $sectionNotificationsBlock = $body.find('.section-notifications-block'),
        $btnNotificationsClose = $sectionNotifications.find('.btn-close--js'),
        $modalBg = $body.find('.modal-bg--js');

    function notificationsModal() {
        //console.log('notifications block');
        $btnNotificationsClose.on("click",function() {
            //console.log('click notifications close');
            $sectionNotifications.find($sectionNotificationsBlock).removeClass('active');
        });
    }
    notificationsModal();

    function blockModal() {
        //console.log('modal block');
        $btnModal.on("click",function() {
            $body.removeClass('open-modal').find($btnModal).removeClass('btn-active');
            $windowModal.removeClass('show-modal').find($modalBlock).removeClass('open');
            $modalBg.removeClass("open");
            //console.log('modal click');
            $(this).addClass('btn-active');
            el = $(this).attr('data-modal');
            $body.addClass('open-modal');
            $windowModal.addClass('show-modal').find($modalBlock).filter('[data-modal="' + el + '"]').addClass('open');
            $modalBg.addClass("open");
        });
        $btnClose.on("click",function() {
            //console.log('modal close');
            $body.removeClass('open-modal').find($btnModal).removeClass('btn-active');
            $windowModal.removeClass('show-modal').find($modalBlock).removeClass('open');
            $modalBg.removeClass("open");
        });
        $modalBg.on("click",function() {
            //console.log('modal close bg');
            $body.removeClass('open-modal').find($btnModal).removeClass('btn-active');
            $windowModal.removeClass('show-modal').find($modalBlock).removeClass('open');
            $modalBg.removeClass("open");
        });
    }

    blockModal();

    function blockModalRelative() {
        //console.log('modal block relative');
        $btnModalRel.on("click",function() {
            //console.log('modal click relative');
            $(this).addClass('btn-active');
            el = $(this).attr('data-modal');
            $body.addClass('open-modal');
            $modalBlockRelThis = $body.find($modalBlockRel).filter('[data-modal="' + el + '"]');
            $modalBlockRelThis.addClass('open');
        });
        $(document).on('click', function(e) {
            if (!$(e.target).closest($modalBlockRelParent).length) {
                  $body.removeClass('open-modal').find($btnModalRel).removeClass('btn-active');
                $modalBlockRel.removeClass('open')
            }
            e.stopPropagation();
        });


    }

    blockModalRelative();
}
