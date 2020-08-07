<div class="navbar-fixed">
    <nav class="pink lighten-1" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">おしえてME for 3J</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="javascript: openNav();"><i class="material-icons">menu</i></a></li>
            </ul>
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
</div>
<div class="sidenav-box">
    <ul id="slide-out" class="sidenav">
        <li>
            <div class="user-view">
                <div class="background pink">
                </div>
                <p><img class="circle" src="<?= $loggedIn ? $userInfo->{"picture"} : 'https://github.com/bonychpos.png' ?>"></p>
                <p><span class="white-text name"><?= $loggedIn ? $userInfo->{"name"}.' (匿名)' : 'おしえてME未ログイン' ?></span></p>
                <p><span class="white-text email"><?= $userInfo->{'email'} ?></span></p>
            </div>
        </li>
        <li><a href="<?= $loggedIn ? './logout' : googleLoginURI() ?>"><?= $loggedIn ?  'ログアウト' : 'ログイン' ?></a></li>
    </ul>
</div>


<!-- Modal Structure -->
<div id="warnings" class="modal">
    <div class="modal-content">
        <h4>投稿する前にお読みください</h4>
        <p>有意義な議論の場にするため、最低限以下のことをお守りください。管理人が以下を守れていないと判断した場合、勝手に消しちゃうこともあります。</p>
        <p>
            <ol>
                <!--<li>投稿する質問は勉強関連に限定しません。ただし、クラスの大多数にとって利益のないトピックはしないこと(勉強/課題関連は基本OKと思ってください)。</li>-->
                <li>人を煽ったりけなしたりしないこと。それをされて嫌な気持ちになるのは、この学校でずいぶん学びましたよね？</li>
                <li>質問やコメントを投稿した人を特定しようとしないこと。問題があるものは黙って報告。</li>
                <li>スパムを投稿しないこと。</li>
                <li>その他不適切なコンテンツを投稿しないこと。目安は親の前で朗読できるかどうか。</li>
            </ol>
        </p>
        <p>といっても、これ以外を守っていただければどんな話題でもOKです。有意義な質問の場づくりにご協力ください🥺
        </p>
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect waves-green btn-flat">同意しない</a>
        <a onclick="submit()" class="modal-close waves-effect waves-green btn">同意して投稿する</a>
    </div>
</div>

<!-- Modal Structure -->
<div id="delete" class="modal">
    <div class="modal-content">
        <h4>投稿を消す</h4>
        <p>本当に消す？</p>
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect waves-green btn-flat">消さない</a>
        <a href="" class="modal-close waves-effect red btn delete-btn">消す</a>
    </div>
</div>

<!-- Modal Structure -->
<div id="deleteComment" class="modal">
    <div class="modal-content">
        <h4>コメントを消す</h4>
        <p>本当に消す？</p>
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect waves-green btn-flat">消さない</a>
        <a href="" class="modal-close waves-effect red btn delete-btn">消す</a>
    </div>
</div>