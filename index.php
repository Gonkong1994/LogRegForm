<?php
    session_start();
    $title = "Главная станица";
    require_once "blocks/header.php";
?>
<?php if( isset($_SESSION['logged_user'])) : ?>
    Авторизован!<br>
    Привет, <?php echo $_SESSION['logged_user']; ?>
    <hr>
    
    <?php endif; ?>
    <h1>Главная страница</h1>
    <a href="/logout.php">Выйти</a>

<?php
    require_once "blocks/foot.php";
?>