jQuery(document).ready(function(){
	// For Treding offer 
			
	jQuery("#treding_gender").change(function(){
		console.log('change');
		if(window.innerWidth < 767) {
			if(jQuery(this).val() == 'For-Him'){
				console.log('for-him');
				jQuery('body').find('.For-Her').closest('.slick-slide').css("display","none") ;
				jQuery('body').find('.For-Him').closest('.slick-slide').css("display","block");
			}
			else if(jQuery(this).val() == 'For-Her'){
				console.log('for-her');
				jQuery('body').find('.For-Him').closest('.slick-slide').css("display","none");
				jQuery('body').find('.For-Her').closest('.slick-slide').css("display","block") ;
			}
			else{
				console.log('all');
				jQuery('body').find('.For-Him').closest('.slick-slide').css("display","block") ;
				jQuery('body').find('.For-Her').closest('.slick-slide').css("display","block") ;
			}
		} else {
			
			if(jQuery(this).val() == 'For-Him'){
				jQuery(".product.type-product.status-publish.For-Her").hide();
				jQuery(".product.type-product.status-publish.For-Him").show();
			}
			else if(jQuery(this).val() == 'For-Her'){
				jQuery(".product.type-product.status-publish.For-Him").hide();
				jQuery(".product.type-product.status-publish.For-Her").show();
			}
			else{
				jQuery(".product.type-product.status-publish.For-Him").show();
				jQuery(".product.type-product.status-publish.For-Her").show();
			}
		}
	});
	
	// For Seasonal offer 
	jQuery(".seasonal-offers li.cat-parent").each(function(){
		var item = jQuery("<span>").addClass('plus'),
			that = jQuery(this);

		if ( that.has("ul").length ) {   
			item.click(function(e){
				var self = jQuery(this);
				self.text( self.text() === "" ? "" : "" )
					.parent().next().toggle();
				e.preventDefault();
			}).text('');

			that.find(".children").hide();
		}

		that.children("a").prepend( item );
	});
	
});

// For Show/Hide sidebar
if(window.innerWidth < 768) {
	jQuery('.children-sidebar').hide();
}

jQuery('.filter-trigger').on('click',function(){
	jQuery('.children-sidebar').show();
});
jQuery('.close-sidebar').on('click',function(){
	jQuery('.children-sidebar').hide();
});