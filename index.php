<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style>

	body{ width: 600px; margin: auto;}
	ul{ list-style: none;}
	li{ padding-bottom: 1em;}
	img{ float: left; padding-right: 1em;}
	a{ text-decoration: none; color: black;}
	</style>
</head>
<body>

<ul class="tweets">
	

	<script id="tweets-template" type="text/x-handlebars-template">
    	{{#each this}}
		<li>

			<img src="{{thumb}}" alt="{{author}}" />
			<p><a href="{{url}}">{{tweet}}</a></p>
		</li>
		{{/each}}
	</script>
	
	
	
</ul>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://cloud.github.com/downloads/wycats/handlebars.js/handlebars-1.0.rc.1.js"></script>
<script>

;(function(){

	var Twitter = {

		init: function( config ){
			this.url = 'http://search.twitter.com/search.json?q=' + config.query + '&callback=?';
			this.template = config.template;
			this.container = config.container;
			this.fetch();
		},

		attachTemplate: function(){
			var template = Handlebars.compile( this.template); 
			var html     = template( this.tweets );
			this.container.append( template( this.tweets));	
			
			
		},

		fetch: function(){
			var self = this;
			$.getJSON( this.url, function( data ){
				self.tweets = $.map( data.results, function ( tweet ){
					return {
						author: tweet.from_user,
						tweet: tweet.text,
						thumb: tweet.profile_image_url,
						url: 'http://twitter.com/' + tweet.from_user + '/status/' + tweet.id_str
					};
				});

				//self.tweets
					
				self.attachTemplate();

			});
		} 
	};

	Twitter.init({
		template: $('#tweets-template').html(),
		container: $('ul.tweets'),
		query: 'marcogomesr'
	});

})();

</script>
</body>
</html>	