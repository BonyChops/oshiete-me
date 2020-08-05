<?php
session_start();
define('DATA_PATH', __DIR__ . '/../data.json');
define('CONFIG_PATH', __DIR__ . '/../config.json');
$data = file_exists(DATA_PATH) ? json_decode(file_get_contents(DATA_PATH), true) : [
    "threads"=> [],
    "oauthTokens"=> []
];
function saveData($data){
    file_put_contents(DATA_PATH , json_encode($data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
}

$config = json_decode(file_get_contents(CONFIG_PATH), true);
$verifiedDomain = $config['verified_domain'];

$googleConfig = json_decode(file_get_contents(__DIR__.'/../client_secret.json'));

define('GOOGLE_CLIENT_ID', $googleConfig->{"web"}->{"client_id"});
define('GOOGLE_CLIENT_SECRET', $googleConfig->{"web"}->{"client_secret"});
define('GOOGLE_REDIRECT_URI', $googleConfig->{"web"}->{"redirect_uris"}[0]);

function googleLoginURI($redirect_to = false)
{
    $query = array(
        'client_id' => GOOGLE_CLIENT_ID,
        'redirect_uri' => GOOGLE_REDIRECT_URI,
        'scope' => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email',
        'response_type' => 'code',
    );

    return 'https://accounts.google.com/o/oauth2/auth?' . http_build_query($query);
}
$loggedIn = isset($_SESSION['GOOGLE_USER_INFO']);
$userInfo = $_SESSION['GOOGLE_USER_INFO'];
if($loggedIn){
    $userId = $userInfo->{"id"};
}
$threads = $data['threads'];
$oauthTokens = $data['oauthTokens'];
$animals = ['わに', 'かに', 'さる', 'きじ', 'いぬ', 'うさぎ'];

function findThread($id, $threads, $indexMode = false){
    $cnt = 0;
    foreach($threads as $thread){
        if($thread['id'] == $id){
            if(!$indexMode){
                return $thread;
            }else{
                return $cnt;
            }
        }
        $cnt++;
    }
    return false;
}

?>