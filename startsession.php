<?php
session_start();

// If the session vars aren't set, try to set them with a cookie
if (!isset($_SESSION['idusers'])) {
    if (isset($_COOKIE['idusers']) && isset($_COOKIE['username'])) {
        $_SESSION['idusers'] = $_COOKIE['idusers'];
        $_SESSION['username'] = $_COOKIE['username'];
    }
}
?>
