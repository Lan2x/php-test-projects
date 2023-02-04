<!DOCTYPE html>

<link rel="stylesheet" href="./style.css" />

<body>
    <span id="title">4. Create a browser cookie with source code using PHP</span>

    <div class="container">

        <div class="container__item" style="margin-top:-400px;">
            <form class="form" method="POST">
                <input type="text" class="form__field" name="key" placeholder="put key here" />

                <input type="text" class="form__field" name="value" placeholder="put value here" />
                <button type="submit" name='setCookie' class="btn btn--primary btn--inside uppercase">Set
                    COOKIE</button>
            </form>
            <br /><br />
            <div style="display:flex; justify-content: center;">
                <form class="form" method="POST">
                    <input type="text" class="form__field" name="key" placeholder="put key here" />
                    <button type="submit" name='checkCookie' class="btn btn--primary btn--inside uppercase">Check
                        COOKIE</button>
                </form>
            </div>


        </div>
        <br /><br /><br />
        <?php

        if (isset($_POST['checkCookie'])) {
            echo "COOKIE with [key:  " . $_POST['key'] . " || value : " . $_COOKIE[$_POST['key']] . "] is set";
        }
        ?>
    </div>

</body>

</html>

<?php
if (isset($_POST["setCookie"])) {
    setcookie($_POST['key'], $_POST['value'], time() + 2 * 24 * 60 * 60);
    $cookieKey = $_COOKIE[$_POST['key']];
    echo "<script> alert('cookie is set successfully') </script>";
}
?>