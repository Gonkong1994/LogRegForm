<?php
    session_start();
    $title = "Главная станица";
    require "blocks/header.php";
?>
<?php if( isset($_SESSION['logged_user'])) : ?>
    Авторизован!<br>
    Привет, <?php echo $_SESSION['logged_user']; ?><br>
    <a href="/form/logout.php">Выйти</a>
    <hr>
    
    
    <?php endif; ?>
    <h1>Главная страница</h1>
    

<?php
    require_once "blocks/foot.php";
?>