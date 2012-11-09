(function($){
	var num_new_posts = 0;
	var posts = new Array(); //stores all the inbound posts

	PUBNUB.subscribe({
		channel: "nickoneill",

		callback : function(message){ new_message(message) }
	});

	function update_page_title_count()
	{
		//Remove any leading parenthesis & numbers
		var clean_title = document.title.replace(/^\(\d+\)\s(.*)$/, "$1");
		if( num_new_posts == 0 )
		{
			document.title = clean_title;
		}
		else{
			document.title = "("+num_new_posts+") "+clean_title;	
		}
		
	}

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

	//Receives new pubnub message
	function new_message(message){
		if( message.notify_type == 'updated_post' )
		{
			return false;
		}

		//There's only one other type of message!
		if( message.notify_type != 'new_post' )
		{
			return false;
		}

		num_new_posts += 1;

		//Append the post to the posts variable
		var post = {
			post_id: 	message['post_id'],
			permalink: 	message['permalink'],
			title: 		message['title'],
			post_date: 	message['post_date'],
			excerpt: 	message['excerpt']
		}
		posts.push(post);

		//Process the handlebar template
		$('#wrapper').handlebars_pre( $('#new-posts-template') , { num_posts_message : num_new_posts + " new posts!" } );
		
		//Attach an event handler to the load-new-posts link
		$('#load-new-posts').click(function(){
			//Display the posts
			display_queued_posts();
			//Reset the new post count
			num_new_posts = 0;
			update_page_title_count();
		});

		//Update page title count as well
		update_page_title_count();
	}

	function display_queued_posts()
	{
		while( posts.length > 0 )
		{
			var post = posts.shift();
			$('#wrapper').handlebars_pre( $('#blog-teaser-template') , post );
		}
	}
})(jQuery);