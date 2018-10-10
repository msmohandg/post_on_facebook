<?php 
		
	$fb = new \Facebook\Facebook([
	  'app_id' => 'xxxx',
	  'app_secret' => 'xxxx',
	  'default_graph_version' => 'v2.10',
	  //'default_access_token' => '{access-token}', // optional
	]);

	$helper = $fb->getRedirectLoginHelper();
	$permissions = ['email', 'manage_pages', 'pages_manage_cta', 'publish_pages'];

	$longLivedToken = $fb->getOAuth2Client()->getLongLivedAccessToken('EAAMFQRcVQscBAA9ZCOM5ofqfa6ipDZAcezSmLQBTO5i6o7UzNXA8q5EKhTxxxxxxxxxxxxxxxxXIwtVrHDeba6Gb4hBYnFfXddDLfipRTfQCOfcaBZAdZBH381ZAV0iygZDZD');

	$fb->setDefaultAccessToken($longLivedToken);

	$response = $fb->sendRequest(
		'GET', 
		'profile_id_xxxx', 
			[
			'fields' => 'access_token'
			])->getDecodedBody();
	
	$foreverPageAccessToken = $response['access_token'];

	$fb->setDefaultAccessToken($foreverPageAccessToken);
	$fb->sendRequest('POST', "profile_id_xxxx/feed", [
	    'message' => "message to be posted on facebook",
	]);

?>