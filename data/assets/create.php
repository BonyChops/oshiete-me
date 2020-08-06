<br><br>
<div class="row">
    <div class="col s12">
        <a href="./">← 質問ひろばへ</a>
    </div>
</div>
<h4>質問する</h4>
<p>早速質問してみよう！もちろん匿名です。<br>有識者〜〜〜〜〜助けてくれ〜〜〜〜〜🥺🥺🥺</p>
<br><br>
<div class="row">
    <form class="col s12" name="create_form" method="POST" action="submit" onsubmit="check(); return false;">
        <div class="row">
            <h5>タイトル</h5>
            <div class="input-field col s12">
                <input id="title" pattern=".*\S+.*" name ="title" required type="text">
                <label for="title">わかりやすくて簡潔なタイトル...</label>
                <span class="helper-text" data-error="空白で投稿はできません" data-success="">Helper text</span>
            </div>
            <h5>内容</h5>
            <div class="input-field col s12">
                <textarea id="content" name="content" required pattern=".*\S+.*" class="materialize-textarea"></textarea>
                <label for="content">内容(改行OK)...</label>
                <span class="helper-text" data-error="空白で投稿はできません" data-success="">Helper text</span>
            </div>
            <button class="btn waves-effect waves-light right" type="submit">
                投稿<i class="material-icons right">send</i>
            </button>
        </div>
    </form>

</div>