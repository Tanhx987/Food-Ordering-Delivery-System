<?php
include("config.php");
include("firebaseRDB.php");

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($email == "") {
    echo "Email is required";
} else if ($password == "") {
    echo "Password is required";
} else {
    $rdb = new firebaseRDB($databaseURL);

    $retrieve = $rdb->retrieve("/user");
    $data = json_decode($retrieve, true);

    $loggedIn = false;

    foreach ($data as $userId => $userData) {
        if ($userData['email'] === $email && $userData['password'] === $password) {
            $loggedIn = true;
            break;
        }
    }
    

    if ($loggedIn) {
        echo "Login success. Redirecting in <span id='countdown'>3</span> seconds...";
        echo "<script>
            var seconds = 3;

            function countdown() {
                var countdownElement = document.getElementById('countdown');
                countdownElement.innerHTML = seconds;
                seconds--;

                if (seconds < 0) {
                    window.location.href = 'index.html';
                } else {
                    setTimeout(countdown, 1000);
                }
            }

            countdown(); 
        </script>";
        exit; 
    } else {
        echo "Invalid email or password";
    }
}