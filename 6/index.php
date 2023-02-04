<!DOCTYPE html>

<link rel="stylesheet" href="./style.css" />

<body>
    <span id="title">6. Create a JSON web token</span>

    <div class="container">

        <div class="container__item" style="margin-top:-400px;">
            <form class="form" method="POST">
                <input type="text" class="form__field" name="name" placeholder="put name here" />
                <button type="submit" name='create' class="btn btn--primary btn--inside uppercase">Create
                    Token</button>
            </form>
            <br /><br />



        </div>
        <br /><br /><br />
        <?php
        if (isset($_POST["create"])) {
            // Create token header as a JSON string
            $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

            // Create token payload as a JSON string
            $payload = json_encode(['name' => $_POST['name']]);

            // Encode Header to Base64Url String
            $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

            // Encode Payload to Base64Url String
            $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

            // Create Signature Hash
            $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);

            // Encode Signature to Base64Url String
            $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

            // Create JWT
            $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

            echo $jwt;
        }
        ?>
    </div>

</body>

</html>


?>