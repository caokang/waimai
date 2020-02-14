/*
 * flytoCart v1.2
 * http://jquery.com/
 *
 * Copyright 2011, Iván Sánchez (Girona)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license.
 *
 * Date: Wed feb 28 12:10:21 2013
 */

$.fn.flytoCart = function(callback, options){  	

	//create the variable stop to avoid a double click with two movements of the same image
	var fstop = false;
	
	// Default settings
	$.fn.flytoCart.defaults = {
		source: '.i_list',
		attribute: 'fimg',
	    destination 	: 	".destination",
	    velocity		 	:	1200	
	};  
	
	// Override default settings
	var opts = $.extend({}, $.fn.flytoCart.defaults, options);  

	$(this).click(function() {
						   
			if (opts.source=='') {
				src=$(this)
			} else {
				if (opts.attribute=='') {
					src=$(opts.source);
				} else {
					att=$(this).attr(opts.attribute);
					src=$("#"+att);
				}
			}
			
			if (!fstop){
					
					// Calculate image position
					
					var fproductX 				= 		src.offset().left;
					var fproductY 				= 		src.offset().top;
					
					// Calculate basket // shopping cart  position
					var fbasketX 					= 		$(opts.destination).offset().left;
					var fbasketY 					= 		$(opts.destination).offset().top;
					
					// Calculate the image´s movement
					var fgotoX 					= 		fbasketX - fproductX;
					var fgotoY 					= 		fbasketY - fproductY;
					
					// Calculate the witdh and height of the new image that we will move
					var fnewImageWidth 		= 		src.width() / 3;
					var fnewImageHeight		= 		src.height() / 3;
					
					var fparent 					= 		src;
					fstop 							=		true;
					
					//begin the transition
					src
					.clone()
					.prependTo(fparent)
					.css({'position' : 'absolute'})
					.animate({opacity: 0.4}, 100 )
					.animate({opacity: 0.1, marginLeft: fgotoX, marginTop: fgotoY, width: fnewImageWidth, height: fnewImageHeight}, opts.velocity, function() {
						
						// Remove the image that moved
						$(this).remove();	
						
						// Call the callback
					    if (typeof callback == 'function') { 
					        callback.call(this); // brings the scope to the callback
					    }

						// reset of the variable stop to allow a new movement
						fstop = false;
					});	
			}
			
	    return false;   
   }); 
   
};
