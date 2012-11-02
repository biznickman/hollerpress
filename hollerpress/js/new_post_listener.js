(function($){
	var num_new_posts = 0;

	PUBNUB.subscribe({
		channel: "nickoneill",

		callback : function(message){ new_message(message) }
	});

	var compiled = {};
	$.fn.handlebars_pre = function(template,data){
		if( template instanceof jQuery ){
			template = $(template).html();
		}
		compiled[template] = Handlebars.compile(template);
		if( $('#new-posts').length > 0 ){
			$('#new-posts').remove();
		}
		this.prepend(compiled[template](data));
	};

	function new_message(message){
		if( message.notify_type == 'updated_post' )
		{
			return false;
		}

		num_new_posts += 1;
		//Process the handlebar template
		$('#wrapper').handlebars_pre($('#new-posts-template') , { num_posts_message : num_new_posts + " new posts!" } );
		
		//alert("New message received: "+ JSON.stringify(message));
	}
})(jQuery);