<?php
session_start();

if (isset($_SESSION['user'])) {
    echo "logged_in";
} else {
    echo "logged_out";
}
?>
