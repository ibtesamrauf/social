<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript">


		 
		    function facebookLikesCount(pageId,access_token)
		    {
		//Set Url of JSON data from the facebook graph api. make sure callback is set with a '?' to overcome the cross domain problems with JSON
		        var url = "https://graph.facebook.com/"+pageId+"?fields=name,fan_count&access_token="+access_token+"";
		//Use jQuery getJSON method to fetch the data from the url and then create our unordered list with the relevant data.
		 
		        $.getJSON(url,function(json){
		            console.log(JSON.stringify(json));
		            $('#facebookfeed').html("<h2>Facebook Likes: "+json.fan_count+"</h2>");
		        });
		    }
		 
		    //facebookLikesCount('coding4developers','App ID|App Secret');
		    facebookLikesCount('vernetroyer','1942200009377124|2aa44fec0382b4d5715af57be82779d2');
		</script>
	</head>
 
	<body>
		<div id="facebookfeed">
		    <h2>Loading...</h2>
		</div>
			
	</body>
</html>