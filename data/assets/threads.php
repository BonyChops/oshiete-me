<br><br>
<div class="row">
    <div class="col s12">
        <a href="./">← 質問ひろばへ</a>
    </div>
</div>

<?php
$found = false;
foreach ($threads as $threadSearch) {
    if ($_GET['id'] == $threadSearch['id']) {
        $found = true;
        $thread = $threadSearch;
        break;
    }
}
if (!$found) {
    echo '<h4>お探しの投稿は見つかりませんでした。</h4>';
} else {
?>

    <div class="card<?php if ($thread['author'] == $userId) echo " yellow lighten-3" ?>">
        <div class="card-content">
            <span class="card-title"><?= $thread['isSolved'] ? '✅' : '🤔' ?> <?= $thread['title'] ?></span>
            <p><?= nl2br($thread['content']) ?></p>
        </div>
    </div><br>
    <div class="row">
        <div class="input-field col s12">
            <textarea id="textarea1" class="materialize-textarea"></textarea>
            <label for="textarea1">解答する...</label>
        </div>
    </div>
    <p>ページを読み込むたびにユーザー名が変わるよ！(質問者さん以外)</p>
    <?php
    $replies = $thread['reply'];
    $loopCnt = 1;
    $cnt = 0;
    $preData = [];
    shuffle($animals);
    foreach ($replies as $reply) { ?>
        <div class="card">
            <a class="btn-floating halfway-fab waves-effect waves-light red center-align"><i class="material-icons">feedback</i></a>
            <div class="card-content">
                <span class="card-title">
                    <?php
                    //Name judgement
                    if ($reply['author'] === $thread['author']) {
                        echo "質問者";
                    } else {
                        if (isset($preData[$reply['author']])) {
                            echo $preData[$reply['author']];
                        } else {
                            $crtName = $animals[$cnt];
                            if ($loopCnt >= 2) {
                                $crtName = $crtName . $loopCnt;
                            }
                            $preData[$reply['author']] = $crtName;
                            echo $crtName;
                            $cnt++;
                            if ($cnt >= count($animals)) {
                                $loopCnt++;
                                $cnt = 0;
                            }
                        }

                    }
                    ?> さん</span>
                <p><?= nl2br($reply['content'])?></p>
            </div>
        </div><br>

    <?php } ?>
<?php } ?>