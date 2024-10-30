(function( $ ) {

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(document).ready( function($) {
	    $('.nav-tab-wrapper a').click(function(event){
	        event.preventDefault();
	        
	        // Limit effect to the container element.
	        var context = $(this).closest('.nav-tab-wrapper').parent();
	        $('.nav-tab-wrapper a', context).removeClass('nav-tab-active');
	        $(this).closest('a').addClass('nav-tab-active');
	        $('.tab-panel', context).hide();
	        $( $(this).attr('href'), context ).show();
	    });

	    // Make setting nav-tab-active optional.
	    $('.nav-tab-wrapper').each(function(){
	        if ( $('.nav-tab-active', this).length )
	            $('.nav-tab-active', this).click();
	        else
	            $('a', this).first().click();
	    });
	});

})( jQuery );

