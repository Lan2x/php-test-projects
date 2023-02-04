<!DOCTYPE html>

<link rel="stylesheet" href="./style.css" />

<body>
    <span id="title">4. Create a session token using PHP</span>

    <div class="container">

        <div class="container__item" style="margin-top:-400px;">
            <form class="form" method="POST">
                <input type="text" class="form__field" name="key" placeholder="put key here" />
                <input type="text" class="form__field" name="value" placeholder="put key here" />
                <button type="submit" name='addData' class="btn btn--primary btn--inside uppercase">Set
                    Token</button>
            </form>
            <br /><br />
            <div style="display:flex; justify-content: center;">
                <form class="form" method="POST">
                    <input type="text" class="form__field" name="key" placeholder="put key here" />
                    <button type="submit" name='checkData' class="btn btn--primary btn--inside uppercase">Check
                        Token</button>
                </form>
            </div>


        </div>
        <br /><br /><br />
        <?php

        if (isset($_POST['checkData'])) {
            session_start();
            echo "Session with [key:  " . $_POST['key'] . " || value : " . $_SESSION[$_POST['key']] . "] exists";
        }
        ?>
    </div>

</body>

</html>

<?php
if (isset($_POST["addData"])) {
    // Starting the session using session_start() function
    session_start();
    // Now Storing the session's data (little data only)
    $_SESSION[$_POST["key"]] = $_POST["value"];
    echo "<script> alert('data is added to session successfully') </script>";
}
?>