<?php
include('conn_db.php');
session_save_path('./session');
session_start();
session_destroy();
header('Location: login.php');
?>