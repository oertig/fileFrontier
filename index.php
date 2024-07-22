<?php
// TODO: remove after development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_name('fileFrontier');
session_start();

include_once('./config.inc.php');
include_once('./modules/database.module.php');

if(isset($_POST['logout'])) {
    session_destroy();

} else if(isset($_POST['resetPassword'])) {
    // show reset password page

} else if(isset($_POST['login'])) {
    // verify login, if successful, show upload page
    $sql = "SELECT `password_hash`, `per_user_salt` FROM `appUser` WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['loginEmail']);
    $stmt->execute();
    
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($user) === 1) {
        if(password_verify(
            hash($config['passwordHash'], $_POST['loginPassword'] . $user[0]['per_user_salt']),
            $user[0]['password_hash']
        )) {
            // user login correct

        } else {
            // login info is incorrect
            // TODO: return to login page (show error message)
        }

    } else {
        // TODO: show error
        // TODO: implement error handling for when email exists multiple times (should not be possible)
    }


}
 else {
    // show login page
    $skeleton = file_get_contents('./templates/skeleton.template.html');
    $content = file_get_contents('./templates/login.template.html');
    $skeleton = str_replace('{{CONTENT}}', $content, $skeleton);
    echo $skeleton;
}

?>

<!--
- login page
- reset password page
- upload page (also shows all uploads)
- download page
- admin panel
-->