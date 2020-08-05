
<title>Redirecting...</title>
<?php
require_once __DIR__.'/../../data/assets/setup.php';

function getGoogleAuthToken($code) {
        $baseURL = 'https://accounts.google.com/o/oauth2/token';
        $params = array(
                'code'          => $code,
                'client_id'     => GOOGLE_CLIENT_ID,
                'client_secret' => GOOGLE_CLIENT_SECRET,
                'redirect_uri'  => GOOGLE_REDIRECT_URI,
                'grant_type'    => 'authorization_code'
        );
        $headers = array(
                'Content-Type: application/x-www-form-urlencoded',
        );

        $options = array('http' => array(
                'method' => 'POST',
                'content' => http_build_query($params),
                'header' => implode("\r\n", $headers),
        ));

        $response = json_decode(
                file_get_contents($baseURL, false, stream_context_create($options)));

        if(!$response || isset($response->error)){
            return null;
        }

        return $response->access_token;
}

function getGoogleUser($accessToken) {
    if (empty($accessToken)) {
        return null;
    }

    $userInfo = json_decode(
            file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?'.
            'access_token=' . $accessToken)
    );
    if (empty($userInfo)) {
        return null;
    }

    return $userInfo;
}
$accessToken = getGoogleAuthToken($_GET['code']);
if($accessToken === null){
        exit("Error: No access token recieved");
}
var_dump($accessToken);
$userInfo = getGoogleUser($accessToken);
if($userInfo === null){
        exit('Error: No user info recieved');
}

if(array_search($userInfo->{'hd'}, $verifiedDomain) ===false){
        exit("Sorry, but you aren't allowed to access this site.");
}

session_start();
$_SESSION['GOOGLE_ACCESS_TOKEN'] = $accessToken;
$_SESSION['GOOGLE_USER_INFO'] = $userInfo;
if(isset($_GET['redirect'])){
        header('Location: '.$_GET['redirect']);
}else{
        header('Location: ../../');
}
?>