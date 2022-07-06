$(document).ready(function() {

	$('#nav').affix({
	      offset: {
	        top: $('header').height()-$('#nav').height()
	      }
	});	

	/* highlight the top nav as scrolling occurs */
	$('body').scrollspy({ target: '#nav' })

	/* smooth scrolling for scroll to top */
	$('.scroll-top').click(function(){
	  $('body,html').animate({scrollTop:0},1000);
	})

	/* smooth scrolling for nav sections */
	$('#nav .navbar-nav li>a').click(function(){
	  var link = $(this).attr('href');
	  var posi = $(link).offset().top;
	  $('body,html').animate({scrollTop:posi},700);
	});
 
  $("#owlSlider").owlCarousel({
    autoPlay : true,
    navigation : false,
    navigationText : ["<i class='fa fa-chevron-left fa-2x'></i>", "<i class='fa fa-chevron-right fa-2x'></i>"],
    slideSpeed : 300,
    pagination : false,
    paginationSpeed : 700,
    singleItem:true,
  });

  $("#partnerSlider").owlCarousel({
    autoPlay : true,
    navigation : true,
    navigationText : ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
    slideSpeed : 300,
    pagination : false,
    paginationSpeed : 700,
    items : 5,
    singleItem:false,
  });
 	
});