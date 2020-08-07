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
define('DISCORD_WEBHOCK', $config['discord_webhook']);


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
    foreach($threads as $key => $thread){
        if($thread['id'] == $id){
            if(!$indexMode){
                return $thread;
            }else{
                return $key;
            }
        }
    }
    return false;
}

function randomId($length = 8)
{
    $max = pow(10, $length-1) - 1;                    // コードの最大値算出
    $rand = random_int(0, $max);                    // 乱数生成
    $code = sprintf('%0'. $length. 'd', $rand);     // 乱数の頭0埋め
    $code = random(1, 9) . $code;
    return $code;
}


if (!($thread === false || $thread['isDeleted'])) {
    $params = ['content'];
    $paramsSolvedToggle = ['solvedToggle'];
    $paramsDeleteComment = ['id', 'commentId'];

    $addReply = true;
    $solvedToggle = true;
    $deleteComment = true;
    foreach ($params as $param) {
        if (!isset($_POST[$param])) {
            $addReply = false;
        }
    }
    foreach ($paramsSolvedToggle as $param) {
        if (!isset($_POST[$param])) {
            $solvedToggle = false;
        }
    }

    foreach ($paramsDeleteComment as $param) {
        if (!isset($_GET[$param])) {
            $deleteComment = false;
        }
    }

    if ($addReply) {
        $reply = $thread['reply'];
        $date = new DateTime();
        $reply = [
            "id" => randomId(),
            "author" => $userId,
            "content" => $_POST['content'],
            "date" => $date->format(DateTime::ATOM),
            "type" => "reply"
        ];
        array_push($data['threads'][findThread($_GET['id'], $threads, true)]['reply'], $reply);
        saveData($data);
        header('location: ./?id=' . $_GET['id']);
        exit();
    }
    if ($userId == $thread['author']) {
        if ($solvedToggle) {
            $reply = $thread['reply'];
            $date = new DateTime();
            $reply = [
                "id" => randomId(),
                "author" => $userId,
                "content" => $thread['isSolved'] ? 'notSolved' : 'solved',
                "date" => $date->format(DateTime::ATOM),
                "type" => "status"
            ];
            array_push($data['threads'][findThread($_GET['id'], $threads, true)]['reply'], $reply);
            $data['threads'][findThread($_GET['id'], $threads, true)]['isSolved'] = !$thread['isSolved'];
            saveData($data);
            header('location: ./?id=' . $_GET['id']);
            exit();
        }
    }
    if($deleteComment){
        $reply = findThread($_GET['commentId'], $thread['reply']);
        if($reply['author'] == $userId){
            $data['threads'][findThread($_GET['id'], $threads, true)]['reply'][findThread($_GET['commentId'], $thread['reply'], true)]['type'] = 'deleted';
            saveData($data);
            header('location: ./?id=' . $_GET['id']);
            exit();
        }
    }
}

?>