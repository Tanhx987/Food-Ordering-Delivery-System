<?php
include("config.php");
include("firebaseRDB.php");

$name = isset($_POST['name']) ? $_POST['name'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($name == "") {
    echo "Name is required";
} else if ($email == "") {
    echo "Email is required";
} else if ($phone == "") {
    echo "Phone Number is required";
} else if ($password == "") {
    echo "Password is required";
} else {
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/user", "email", "EQUAL", $email);
    $data = json_decode($retrieve, true);

    if (isset($data['email'])) {
        echo "Email already used";
    } else {
        $insert = $rdb->insert("/user", [
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "password" => $password
        ]);

        $result = json_decode($insert, true);
        if (isset($result['name'])) {
            echo "<div id='message'>Register success, please wait...</div>";
            echo "<script>
                var seconds = 3;
                var messageElement = document.getElementById('message');

                function countdown() {
                    if (seconds > 0) {
                        messageElement.innerHTML = 'Register success, please wait... (' + seconds + ' seconds)';
                        seconds--;
                        setTimeout(countdown, 1000); 
                    } else {
                        window.location.href = 'Login.php';
                    }
                }

                countdown();
            </script>";
        } else {
            echo "Register failed";
        }
    }
}
?>