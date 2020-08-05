<?php
require_once(__DIR__ . '/data/assets/setup.php');
?>

<!DOCTYPE html>
<html>

<?php require_once(__DIR__ . '/data/assets/head.php'); ?>

<body>
    <?php require_once(__DIR__ . '/data/assets/header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="input-field col s12 m8 offset-m2">
                <?php
                if (!isset($_GET['id'])) { ?>
                    <select>
                        <option value="1" selected>全て</option>
                        <option value="2">🤔 Needs help</option>
                        <option value="3">✅ Solved</option>
                    </select>
                    <label>カテゴリ</label>
                <?php } else { ?>
                    <a href="#">← 戻る</a>
                <?php } ?>
            </div>
            <div class="col s12 m8 offset-m2">
                <?php
                if (!isset($_GET['id'])) {
                    require_once(__DIR__ . '/data/assets/top.php');
                } else {
                    require_once(__DIR__ . '/data/assets/threads.php');
                } ?>
            </div>
        </div>
    </div>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/select.js"></script>
    <script>
        const sleep = (sec) => {
            return new Promise(resolve => setTimeout(resolve, sec * 1000))
        }

        $(document).ready( () => {
            $('.sidenav').sidenav();
            $('select').formSelect();
            $('.tap-target').tapTarget();
            $('.dropdown-trigger').dropdown();
            openAndClose();
        });
        const openAndClose = async() => {
            M.TapTarget.getInstance($('.tap-target')).open();
            await sleep(3);
            M.TapTarget.getInstance($('.tap-target')).close();
        }
        const openNav = () => {
            M.Sidenav.getInstance($('#slide-out')).open();
        }
    </script>
</body>

</html>