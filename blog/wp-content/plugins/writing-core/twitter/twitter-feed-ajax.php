<?php
	define('WP_USE_THEMES', false);
	$wpdir = explode( "wp-content" , __FILE__ );
	require $wpdir[0] . "wp-load.php";

		$username				 = $_POST['username'];
		$number					 = $_POST['number'];
		$include_media	 = $_POST['include_media'];
		$extend_tweet		 = $_POST['extend_tweet'];
		$exclude_replies = $_POST['exclude_replies'];
    $consumerkey = asalah_option('asalah_conk_id');
    $consumersecret = asalah_option('asalah_cons_id');
    $accesstoken = asalah_option('asalah_at_id');
    $accesstokensecret = asalah_option('asalah_ats_id');

    echo asalah_twitter_tweets($consumerkey, $consumersecret, $accesstoken, $accesstokensecret, $username, $number, $include_media, $extend_tweet, $exclude_replies);