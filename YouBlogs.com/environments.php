<?php

	if(! defined('ENVIRONMENT') )
	{
	$domain = strtolower($_SERVER['HTTP_HOST']);

		switch($domain) 
		{
			case 'youblogs.com':
			define('ENVIRONMENT', 'production');
			break;

			case 'localhost':
			//our staging server
			define('ENVIRONMENT', 'testing');
			break;

			default:
			define('ENVIRONMENT', 'development');
			break;
			}
	}

