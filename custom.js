function Scroller(parent, selector, count) {
    $(parent).simpleLoadMore({
        item: selector,
        count: count,
        btnHTML: '<button type="button" class="btn btn-primary btn-load btn-sm">Load More <span class="fa text-primary fa-arrow-right"></span></button>'
    });
}
var docScroll = $(document).scrollTop(),
    boxCntOfset = $("html,body").offset().top - 100;
if (docScroll >= boxCntOfset) {
    $(".gototop").fadeIn(200)
} else {
    $(".gototop").fadeOut(200)

}