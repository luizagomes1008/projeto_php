<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /projeto_php/login.php');
    exit;
}
?>