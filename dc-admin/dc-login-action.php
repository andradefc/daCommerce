<?php

/**
 * File can't be accessed directly
 */

$redirect = ($_POST['redirect']) ?: 'dc-dashboard';

if (!isset($dc))
    header('Location: dc-login');

/**
 * Receive form request
 */
if (isset($_POST['loginForm'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password))
        header('Location: dc-login/?login=fail');

    /**
     * Find user in database
     */
    $user = $em->getRepository('Entities\User')->findOneBy(array('user_email' => $username, 'user_pass' => md5($password)));

    if (!$user){
        header('Location: dc-login/?login=fail');
    }else{
        /**
         * Login Success
         */
        $_SESSION['logged'] = true;
        $_SESSION['user']   = $user->getUserId();

        header('Location: '.$redirect.'');
    }
}else{
    /**
     * No form requesst
     */
    header('Location: dc-login');
}
