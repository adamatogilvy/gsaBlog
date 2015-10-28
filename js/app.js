if(!GSAblog){
    var GSAblog = {}
}

GSAblog.heightHackFoursquare = function() {
    var maxHeight = 0;
    setTimeout(function() {
        $('.block').each(function(){
            maxHeight = $(this).height() > maxHeight ? $(this).height() : maxHeight;
        });
        $('.block').height(maxHeight + 30);
    },1);

}

$(function() {
    gsaHeader();
	if($('body').hasClass('home')) {
		GSAblog.heightHackFoursquare();
	};

    var addthis_share =    {
        url: "<?php the_permalink(); ?>",
        title: "<?php the_title(); ?>",
        templates: {
            twitter: '{{title}} {{url}} via @USGSA'
        }
    }

    $('#tag-menu-toggle').click(function() {
        $(this).parent('nav').find('ul').slideToggle(300);
        $(this).find('span').toggleClass('glyphicon-chevron-up , glyphicon-chevron-down');
    })
});


