
// external js: isotope.pkgd.js
//jQuery(window).load(function($){
jQuery(function($){
// init Isotope
var $grid = $('.grid').isotope({
	itemSelector: '.element-item',
	layoutMode: 'fitRows'
});
// filter functions
var filterFns = {
	// show if number is greater than 50
};
// bind filter button click
$('.filters-button-group').on('click', 'button', function () {
	var filterValue = $(this).attr('data-filter');
	// use filterFn if matches value
	filterValue = filterFns[filterValue] || filterValue;
	$grid.isotope({
		filter: filterValue
	});
});
// change is-checked class on buttons
$('.button-group').each(function (i, buttonGroup) {
	var $buttonGroup = $(buttonGroup);
	$buttonGroup.on('click', 'button', function () {
		$buttonGroup.find('.is-checked').removeClass('is-checked');
		$(this).addClass('is-checked');
	});
});

});



/*jQuery(document).ready(function(){
	$(".fancybox-iframe").contents().find('img').attr("style","width:100%;");
});
*/

jQuery('[data-fancybox]').fancybox({
	afterShow: function(){
		jQuery(".fancybox-iframe").contents().find('img').attr("style","width:100%;");
		console.log("image set up to 100%");
	}
});


/*************************
    fancyBox3
*************************/
/*
$('[data-fancybox="images"]').fancybox({
	maxWidth    : '100%',
	buttons: [
		'slideShow',
		'fullScreen',
		'share',
		'thumbs',
		'download',
		'zoom',
		'close'
	]
});*/