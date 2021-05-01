jQuery(document).ready(function(){
  jQuery(".bn").click(function(){
    jQuery("body").toggleClass('onav');
    jQuery("#n").toggleClass('flex2');
  });
});

jQuery(document).ready(function() {
	jQuery(window).scroll(function() {
		var scroll = jQuery(window).scrollTop();

		if (scroll >= 100) {
			//clearHeader, not clearheader - caps H
			jQuery("header.header").addClass("fixeds");
		}
		else if (scroll < 100) {
			//clearHeader, not clearheader - caps H
			jQuery("header.header").removeClass("fixeds");
		}
	}); //missing );
});


// external js: isotope.pkgd.js
jQuery(document).ready(function(){
	var jQuerygrid = jQuery('.filtergrid').isotope({
	  itemSelector: '.single-podcast-filter',
	  stagger: 30,
	});

	jQuery('.button-group-list2').on( 'click', '.button', function() {
	  var filterValue = jQuery(this).attr('data-filter');
	  jQuerygrid.isotope({ filter: filterValue });
	});

	// change is-checked class on buttons
	jQuery('.button-group').each( function( i, buttonGroup ) {
	  var jQuerybuttonGroup = jQuery( buttonGroup );
	  jQuerybuttonGroup.on( 'click', 'span', function() {
	    jQuerybuttonGroup.find('.is-checked').removeClass('is-checked');
	    jQuery( this ).addClass('is-checked');
	  });
	});

});

jQuery(document).ready(function(){
  jQuery(".bn").click(function(){
    jQuery("body").toggleClass('onav');
    jQuery("#n").toggleClass('flex2');
  });
  jQuery(".sel-all").click(function(){
      jQuery('.button-group-list2').removeClass('logo');
      jQuery('.button-group-list2').removeClass('branding');
      jQuery('.button-group-list2').removeClass('website');
      jQuery('.button-group-list2').removeClass('digital');
      jQuery('.button-group-list2').addClass('allwork');
  });
  jQuery(".sel-logos").click(function(){
      jQuery('.button-group-list2').addClass('logo');
      jQuery('.button-group-list2').removeClass('branding');
      jQuery('.button-group-list2').removeClass('website');
      jQuery('.button-group-list2').removeClass('digital');
      jQuery('.button-group-list2').removeClass('allwork');
  });
  jQuery(".sel-branding").click(function(){
      jQuery('.button-group-list2').removeClass('logo');
      jQuery('.button-group-list2').addClass('branding');
      jQuery('.button-group-list2').removeClass('website');
      jQuery('.button-group-list2').removeClass('digital');
      jQuery('.button-group-list2').removeClass('allwork');
  });
  jQuery(".sel-website-ui-design").click(function(){
      jQuery('.button-group-list2').removeClass('logo');
      jQuery('.button-group-list2').removeClass('branding');
      jQuery('.button-group-list2').addClass('website');
      jQuery('.button-group-list2').removeClass('digital');
      jQuery('.button-group-list2').removeClass('allwork');
  });
  jQuery(".sel-digital").click(function(){
      jQuery('.button-group-list2').removeClass('logo');
      jQuery('.button-group-list2').removeClass('branding');
      jQuery('.button-group-list2').removeClass('website');
      jQuery('.button-group-list2').addClass('digital');
      jQuery('.button-group-list2').removeClass('allwork');
  });
});

jQuery(document).ready(function(){
	jQuery(".dskbtn2").append('<svg class="circlesbg" xmlns="http://www.w3.org/2000/svg" width="90" height="90" viewBox="0 0 90 90"><g class="Ellipse_54" data-name="Ellipse 54" fill="none" stroke="#3b3b46" stroke-width="1"><circle cx="45" cy="45" r="45" stroke="none"/><circle cx="45" cy="45" r="44.5" fill="none"/></g></svg>');
	jQuery(".dskbtn2").append('<svg class="arrowsbg" xmlns="http://www.w3.org/2000/svg" width="16.414" height="16.414" viewBox="0 0 16.414 16.414"><g class="Icon_feather-arrow-up-right" data-name="Icon feather-arrow-up-right" transform="translate(-9.793 -9.793)"><path id="Path_111" data-name="Path 111" d="M10.5,25.5l15-15" fill="none" stroke="#3b3b46" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><path id="Path_112" data-name="Path 112" d="M10.5,10.5h15v15" fill="none" stroke="#3b3b46" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/></g></svg>');
});


jQuery(document).ready(function() {
	jQuery('.dtestimonial').owlCarousel({
		loop:true,
		margin:60,
		nav:true,
		dots:false,
		navText: [
			'<i class="fas fa-chevron-left"></i>',
			'<i class="fas fa-chevron-right"></i>'
		],
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});
});

jQuery(document).ready(function() {
	jQuery('.dportfolio').owlCarousel({
		center: true,
		loop:false,
		dots:false,
		margin:78,
		nav:true,
		navText: [
			'<i class="fas fa-chevron-left"></i>',
			'<i class="fas fa-chevron-right"></i>'
		],
		responsive:{
			0:{
				items:1
			},
			750:{
				items:1
			},
			1000:{
				items:2
			}
		}
	});
});




jQuery(document).ready(function() {
	jQuery('.dportfolio2').owlCarousel({
		center: true,
		loop:false,
		dots:false,
		margin:0,
		nav:true,
		navText: [
			'<i class="fas fa-chevron-left"></i>',
			'<i class="fas fa-chevron-right"></i>'
		],
		responsive:{
			0:{
				items:1
			},
			750:{
				items:2
			},
			1000:{
				items:2
			}
		}
	});
    jQuery('.dportfolio2').trigger('to.owl.carousel', 1)
});



