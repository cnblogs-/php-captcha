<?php 
/**
 *      [verification-code] (C)2015-2100 jingwhale.
 *      
 *      This is a freeware
 *      $Id: global.func.php 2015-02-05 20:53:56 jingwhale$
 */

/**
 * _alert_back()是JS弹窗
 * @access public
 * @param $_info 弹窗的内容变量
 * @return void 弹窗
 */
function _alert_back($_info) {
    echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
    exit();
}

/**
 * _code()是验证码函数
 * @access public
 * @param int $_width 验证码的长度：如果要6位长度推荐75+50；如果要8位，推荐75+50+50，依次类推
 * @param int $_height 验证码的高度
 * @param int $_rnd_code 验证码的位数
 * @param bool $_flag 验证码是否需要边框：true有边框， false无边框（默认）
 * @return void 这个函数执行后产生一个验证码
 */
function _code($_width = 75,$_height = 25,$_rnd_code = 4,$_flag = false) {

    //创建随机码
    for ($i=0;$i<$_rnd_code;$i++) {
        $_nmsg .= dechex(mt_rand(0,15));
    }

    //保存在session
    $_SESSION['code'] = $_nmsg;

    //创建一张图像
    $_img = imagecreatetruecolor($_width,$_height);

    //白色
    $_white = imagecolorallocate($_img,255,255,255);

    //填充
    imagefill($_img,0,0,$_white);

    if ($_flag) {
        //黑色,边框
        $_black = imagecolorallocate($_img,0,0,0);
        imagerectangle($_img,0,0,$_width-1,$_height-1,$_black);
    }

    //随即画出6个线条
    for ($i=0;$i<6;$i++) {
        $_rnd_color = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
        imageline($_img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rnd_color);
    }

    //随即雪花
    for ($i=0;$i<100;$i++) {
        $_rnd_color = imagecolorallocate($_img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
        imagestring($_img,1,mt_rand(1,$_width),mt_rand(1,$_height),'*',$_rnd_color);
    }

    //输出验证码
    for ($i=0;$i<strlen($_SESSION['code']);$i++) {
        $_rnd_color = imagecolorallocate($_img,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200));
        imagestring($_img,5,$i*$_width/$_rnd_code+mt_rand(1,10),mt_rand(1,$_height/2),$_SESSION['code'][$i],$_rnd_color);
    }

    //输出图像
    header('Content-Type: image/png');
    imagepng($_img);

    //销毁
    imagedestroy($_img);
}
?>