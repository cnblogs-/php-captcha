<?php 
/**
 *      [verification-code] (C)2015-2100 jingwhale.
 *
 *      This is a freeware
 *      $Id: verification-code.php 2015-02-05 20:53:56 jingwhale$
 */

//设置字符集编码
header('Content-Type: text/html; charset=utf-8');

//开启session
session_start();

//引入全局函数库（自定义）
require dirname(__FILE__).'/includes/global.func.php';

//检验验证码
if ($_GET['action'] == 'verification') {
    
    if (!($_POST['code'] == $_SESSION['code'])) {
        _alert_back('验证码不正确!');
    }else{
        _alert_back('验证码通过！');
    }
}  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>verification code</title>
    <link rel="stylesheet" type="text/css" href="style/basic.css" />
    <script type="text/javascript" src="js/codeimg.js"></script>
</head>
<body>

    <div id="testcode">
        <form method="post" name="verification" action="verification-code.php?action=verification">
            <dl>
                <dd>验证码：<input type="text" name="code" class="code" /><img src="codeimg.php" id="codeimg"  /></dd>
                <dd><input type="submit" class="submit" value="验证" /></dd>
            </dl>
        </form>
    </div>

</body>
</html>