jQuery(document).ready(function() {
	jQuery('.fadeInDown').addClass("hiddenEffect").viewportChecker({
	    classToAdd: 'visibleEffect animated fadeInDown', // Class to add to the elements when they are visible
	    offset: 100    
	   }); 

	jQuery('.fadeInUp').addClass("hiddenEffect").viewportChecker({
	    classToAdd: 'visibleEffect animated fadeInUp', // Class to add to the elements when they are visible
	    offset: 100    
	   }); 

	jQuery('.fadeInLeft').addClass("hiddenEffect").viewportChecker({
	    classToAdd: 'visibleEffect animated bounceInLeft', // Class to add to the elements when they are visible
	    offset: 100    
	   });

	jQuery('.fadeInRight').addClass("hiddenEffect").viewportChecker({
	    classToAdd: 'visibleEffect animated bounceInRight', // Class to add to the elements when they are visible
	    offset: 100    
	   });

	jQuery('.bounceInDown').addClass("hiddenEffect").viewportChecker({
	    classToAdd: 'visibleEffect animated bounceInDown', // Class to add to the elements when they are visible
	    offset: 100
	   });

	jQuery('.bounceInUp').addClass("hiddenEffect").viewportChecker({
	    classToAdd: 'visibleEffect animated bounceInUp', // Class to add to the elements when they are visible
	    offset: 100    
	   });
}); 