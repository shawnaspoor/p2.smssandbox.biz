<?php
/*-------------------------------------------------------------------------------------------------
LIVE
-------------------------------------------------------------------------------------------------*/

# We're on the local environment so toggle IN_PRODUCTION off
define('IN_PRODUCTION', TRUE);

# Always display errors on local environment
define('DISPLAY_ERRORS', FALSE);

# To avoid accidentally sending a mass amount of emails to your users when testing, always disable outgoing emails on your local environment
define('ENABLE_OUTGOING_EMAIL', TRUE);

# Toggle this based on whether you want to connect to your local DB or your live DB
define('REMOTE_DB', FALSE);

if (REMOTE_DB) {
	define('DB_HOST', '');
	define('DB_USER', '');
	define('DB_PASS', '');

} else {
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');	
}

# If you want to test parts of your app that behave differently based on the time, you can force the time here.
//define(MIMIC_TIME, "September 30, 2012 12:00pm");
