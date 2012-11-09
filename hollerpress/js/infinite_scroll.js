(function($){
	var next_page = 2;
	var fail_count = 0;
	var loading = false;
	var loader_ref = null;

	function hide_next_link(){
		//Hide the next link 
		$('.pagination').hide();
	}

	function toggle_loader()
	{
		if( loading )
		{
			var loader = $("#posts-loading-template").html();
			loader_ref = $(loader);
			$("#wrapper").append(loader_ref);
		}
		else
		{
			loader_ref.remove();
			loader_ref = null;
		}
	}

	var compiled = {};
	$.fn.handlebars_append = function(template,data){
		if( template instanceof jQuery ){
			template = $(template).html();
		}
		compiled[template] = Handlebars.compile(template);
		this.append(compiled[template](data));
	};

	function load_next_page(){
		if( fail_count == 2 )
		{
			return;
		}

		toggle_loader();
		$.ajax('/?paged='+next_page) 
			.done(function(data){
				$(data).find('.blog-teaser').each(function(index){
					if( $(this).data("title") == null )
					{
						return;
					}
					$("#wrapper").handlebars_append( $('#blog-teaser-template') , { title: $(this).data("title") , 
																				permalink: $(this).data("permalink"),
																				excerpt: $(this).data("excerpt") } );
				});
				fail_count = 0;
				next_page += 1;
				loading = false;
				toggle_loader();
			})
			.fail( function(){  
				fail_count += 1;
				loading = false;
				toggle_loader();
			} );
	}

	//Figure out way to verify that infinite scroll will work on this browser
	hide_next_link();
	//Attach listener to the user scrolling down
	$(window).scroll(function() {
   		if($(window).scrollTop() + $(window).height() > $(document).height() - 300 && loading == false ) {
   			loading = true;
   			load_next_page();
   		}
	});

	//Ensure they've scrolled to top when beginning
	$(document).ready(function(){
    	$(this).scrollTop(0);
	});
})(jQuery);