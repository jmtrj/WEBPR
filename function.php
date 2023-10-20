<?php
session_start();
require_once 'db_con/conn.php';
require_once 'crud/crud.php';
if (isset($_POST['login'])) {
    $Username = $_POST['Username'];
    $password = $_POST['Password'];
    $result = $crud->read('tbladmin', 'Username = :Username', ['Username' => $Username]);
    if (!$result) {
        $_SESSION['error'] = 'Cannot find an account with the provided Username';
        header('Location: index.php');
    } else {
        if ($result[0]['Status'] == 'ACTIVE') {
            if (password_verify($password, $result[0]['Password'])) {
                switch ($result[0]['Role']) {
                    case 'ADMIN':
                        $_SESSION['ADMIN'] = $result[0]['Id'];
                        header('Location: index.php');

                        break;
                    case 'USER':
                        $_SESSION['USER'] = $result[0]['Id'];
                        header('Location: index.php');

                        break;
                }
            } else {
                $_SESSION['error'] = 'Incorrect password';
                header('Location: index.php');
            }
        } else {
            $_SESSION['error'] = 'Your account is not active';
            header('Location: index.php');
        }
    }
} else {
    $_SESSION['error'] = 'Input user credentials first';
    header('Location: index.php');
}
?>