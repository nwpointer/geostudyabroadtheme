/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
function filterPriceTable($){
	$("td.views-field-title").each(function(){
		if ($(this).find("a").html() != $("h1.title").html()){
			$(this).parent().remove();
		}
		$(this).remove();
	});
	$("th.views-field-title").remove();
	if($("#block-views-price_table-block tr").size() <=1){
		$("#block-views-price_table-block").remove();
	}
}


(function ($, Drupal, window, document, undefined) {

	

	$(function(){

		filterPriceTable($);

		// toggle main menu
		$("#menu-toggle").click(function(){
			$('nav #primary').toggle();
			$("#menu-toggle").toggleClass('active');
		});
		
		// $("h2.block-title").stick_in_parent();

		// register toggle saved programs 
		$("#savedProgramDisplay").click(function(){
			$("#savedProgramDisplay").slideToggle(100);
		});

		explore = function(){
             var search = $('.explore input[type="text"]').val();
             window.location.href += 'programs/search/' + search;
             return false;
        };

		// $("#barwrapper").sticky({topSpacing:-0, responsiveWidth:true});
		$("#programList #controls").sticky({topSpacing:-0, responsiveWidth:true});
		// $("#save").sticky({topSpacing:-0});
		//$("#sidebar-extras").sticky({topSpacing:60, getWidthFrom: ".region-sidebar-first"});
		
	});

	$(function(){
	 var lastScrollTop = 0, delta = 5;
	 $(window).scroll(function(){
	 var nowScrollTop = $(this).scrollTop();
	 if(Math.abs(lastScrollTop - nowScrollTop) >= delta){
	 if (nowScrollTop > lastScrollTop){
		$("#barwrapper").addClass("visible-visor");
		$("#savedProgramDisplay:visible").toggle();
	 } else {
		$("#barwrapper").removeClass("visible-visor");
		$("#savedProgramDisplay:visible").toggle();
	 }
	 lastScrollTop = nowScrollTop;
	 }
	 });
	 });

	// $("#togglesavedProgramDisplay").click(function(){

	// 	$("#savedProgramDisplay").slideToggle();
	// });
	// 
	



// To understand behaviors, see https://drupal.org/node/756722#behaviors
Drupal.behaviors.my_custom_behavior = {
  attach: function(context, settings) {

    // 

  }
};


})(jQuery, Drupal, this, this.document);
