<pre><?php
  session_start();

  define('FACEBOOK_SDK_V4_SRC_DIR', '../lib/facebook-php-sdk-v4-4/src/Facebook/');
  require_once('../lib/facebook-php-sdk-v4-4/autoload.php');

  use Facebook\FacebookRedirectLoginHelper;
  use Facebook\FacebookSession;
  use Facebook\FacebookRequestException;
  use Facebook\FacebookRequest;

  $appId = '1465128650469416';
  $appSecret = 'a2bd57b2e122f8b8d24392e3003c9aff';
  $callbackURL = "http://www.bernie2016events-local.org:8082/bernie-events/php-script/pull-events.php";
  FacebookSession::setDefaultApplication($appId, $appSecret);

  $helper = new FacebookRedirectLoginHelper($callbackURL, $appId, $appSecret);

  try {
      $session = $helper->getSessionFromRedirect();
  } catch(FacebookSDKException $e) {
      $session = null;
  }

  if ($session) {
    // User logged in, get the AccessToken entity.
    $accessToken = $session->getAccessToken();
    // Exchange the short-lived token for a long-lived token.
    $longLivedAccessToken = $accessToken->extend();

    print_r($longLivedAccessToken);
    // Now store the long-lived token in the database
    // . . . $db->store($longLivedAccessToken);
    // Make calls to Graph with the long-lived token.
    // . . .
  } else {
    echo '<a href="' . $helper->getLoginUrl() . '">Login with Facebook</a>';
  }

?>
</pre>
