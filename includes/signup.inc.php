<?php
if(isset($_POST["signup-submit"])) {

    include "db.inc.php";

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $userdate = date("y-m-d");
    $password_confirm = $_POST["password_confirm"];
    $checkbox_confirm = $_POST["terms_accept"];

    if (empty($username) || empty($email) || empty($password) || empty($password_confirm)|| empty($checkbox_confirm)) {
        header("Location: ../signup.php?error");
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error");
        echo 'teste';
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error");
        exit();
    }
    else if($password !== $password_confirm) {
        header("Location: ../signup.php?error");
        exit();
    }
    else if (strlen($username) > 16 || strlen($username) < 2 ){
        header("Location: ../signup.php?error");
        exit();
    }
    else if(strlen($password) > 16 || strlen($password) < 5 ) {
        header("Location: ../signup.php?error");
        exit();
    }
    else {
        $sql = "SELECT userName, userEmail FROM users WHERE userName=? OR userEmail=?";
        $stmt = mysqli_stmt_init($conn);
        
        /* */
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

            /* */ 
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=useremailtaken");
                exit();
            }
            else {
                $sql = "INSERT INTO users (userName, userEmail, userPassword, userDate) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                /* */
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedPassword, $userdate);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../login.php");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }
    else {
        header("Location: ../signup.php");
        exit();
}
?>