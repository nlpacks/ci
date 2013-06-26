<?php
// 初始化session.
// 如果你使用session_name("something")这样的形式, 不要忘记了!
session_start();

unset($_SESSION["developer"]);
// 将全局SESSION变量数组设置空.
$_SESSION = array();

// 如果SESSION数据存储在COOKIE中则删除COOKIE.
// Note: 将注销整个SESSION对象, 而不仅仅是SESSION数据!
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// 最后，注销SEESION.
session_destroy();

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.html';
header("Location: http://$host$uri/$extra");
?> 