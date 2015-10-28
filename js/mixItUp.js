if(!GSAblog){
    var GSAblog = {}
}

GSAblog.bannerPost = function() {
    var $container = $('#banner-post');

    $container.on('click','#gear',function() {
        var dropdown = $(this).parent('aside').find('ul');
        $(this).toggleClass('icon-arrow-down icon-arrow-up');
        dropdown.slideToggle(500);
    })
};

GSAblog.blocks = function() {
    var $container = $('#blocks-container');

    $container.mixItUp();
};

/***************************/
//    DOCUMENT READY        //
/***************************/
$(function() {
    GSAblog.bannerPost();
    GSAblog.blocks();
});