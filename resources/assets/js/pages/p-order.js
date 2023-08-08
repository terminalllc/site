export default function () {

    let $body = $('body'),
        el,$tabsBlockThis,$this,
        $tabsBlock = $body.find('.tabs--js'),
        $tabsHeadItem = $tabsBlock.find('.tabs-head-item'),
        $tabsContentItem = $tabsBlock.find('.tabs-content-item');
    function orderTabs() {

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

    orderTabs();
}
