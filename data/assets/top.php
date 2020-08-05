<h4>質問ひろば</h4>

<select>
    <option value="1" selected>全て</option>
    <option value="2">🤔 Needs help</option>
    <option value="3">✅ Solved</option>
</select>
<label>カテゴリ</label>



<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a id="create" href="<?= $loggedIn ? '?id=create' : googleLoginURI() ?>"class="btn btn-floating btn-large cyan">
        <i class="material-icons">create</i>
    </a>
</div>
<!-- Tap Target Structure -->
<div class="tap-target" data-target="create">
    <div class="tap-target-content">
        <h5>ようこそ！</h5>
        <p>ここから新しい質問を投げられます</p>
    </div>
</div>

<?php
//var_dump($threads);
foreach ($threads as $thread) { ?>
    <div class="card<?php if($thread['author'] == $userId) echo " yellow lighten-3" ?>">
        <a href="?id=<?= $thread['id'] ?>" class="btn-floating halfway-fab waves-effect waves-light red center-align"><?php
        if(count($thread['reply']) === 0){
            echo '<i class="material-icons">comment</i>';
        }else{
            echo count($thread['reply']);
        }
        ?></a>
        <div class="card-content">
            <span class="card-title"><?= $thread['isSolved'] ? '✅' : '🤔' ?>  <?= $thread['title']?>
                <span class="right">
                    <a class='dropdown-trigger' href='#' data-target='dropdown1'><i class="material-icons">more_vert</i></a>
                </span>
            </span>
            <p><?= mb_substr($thread['content'], 0, 20)?></p>
        </div>
    </div>
    <ul id='dropdown1' class='dropdown-content'>
        <li><a href="#!">編集</a></li>
        <li><a href="#!">削除</a></li>
        <li class="divider" tabindex="-1"></li>
        <li><a href="#!">報告する</a></li>
    </ul>
    <br>
<?php } ?>

<div class="card  yellow lighten-3">
    <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">comment</i></a>
    <div class="card-content">
        <span class="card-title">✅ †ロンリー回路†最後の問題
            <span class="right">
                <a class='dropdown-trigger' href='#' data-target='dropdown1'><i class="material-icons">more_vert</i></a>
            </span>
        </span>
        <p>2. (3)のZの方程式がどうしてもテキストの解答と合いません。<br>どなたかとけた方はいらっしゃいますか...？</p>
    </div>
</div>
<ul id='dropdown1' class='dropdown-content'>
    <li><a href="#!">編集</a></li>
    <li><a href="#!">削除</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="#!">報告する</a></li>
</ul>
<br>

<div class="card">

    <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">comment</i></a>
    <div class="card-content">
        <span class="card-title">✅ †ロンリー回路†最後の問題
            <span class="right">
                <a class='dropdown-trigger' href='#' data-target='dropdown1'><i class="material-icons">more_vert</i></a>
            </span>
        </span>
        <p>2. (3)のZの方程式がどうしてもテキストの解答と合いません。<br>どなたかとけた方はいらっしゃいますか...？</p>
    </div>
</div>
<ul id='dropdown1' class='dropdown-content'>
    <li><a href="#!">編集</a></li>
    <li><a href="#!">削除</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="#!">報告する</a></li>
</ul>
<br>