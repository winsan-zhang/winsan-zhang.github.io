<?php
//    header("Content-Type: application/json;charset=utf-8");
    session_start();
    //随机生成验证码文字
    function buildRandomString($type = 1, $length = 4){
        $str = null;
        if($type === 1){
            $str = join("",range(0,9));
        }else if ($type === 2){
            $str = join("",array_merge(range("a", "z"), range("A", "Z")));
        }else if ($type === 3){
            $str = join("",array_merge(range("a", "z"), range("A", "Z")));
        }

        $str = str_shuffle($str);
        return $str = substr($str, 0, $length);
    }

    $str = buildRandomString();
    $session_name = "verify";
    $_SESSION[$session_name] = $str;
    $resStr = '{ "verify": '.$str.'}';
    echo $resStr;

//随机颜色
//function randColor($image, $min, $max){
//    $r = mt_rand($min, $max);
//    $g = mt_rand($min, $max);
//    $b = mt_rand($min, $max);
//    return imagecolorallocate($image, $r, $g, $b);
//}
//服务器端生成验证码图片
//function buildVerify($width=90, $height=40, $type=1, $length=4, $pixel_num=80, $line_num=6)
//{
//    session_start();
//    //创建画布
//    $image = imagecreatetruecolor($width, $height);
//    //创建画笔颜色
//    $black = imagecolorallocate($image, 0, 0, 0);
//    $white = imagecolorallocate($image, 255, 255, 255);
//
//    //填充画布
//    imagefilledrectangle($image, 1, 1, $width - 2, $height - 2, $white);
//
//    $verify_str = buildRandomString($type, $length);
//    $session_name = "verify";
//    $_SESSION[$session_name] = $verify_str;
//    //在画布上画出验证码
//    //定义验证码字体库
//    $fontFileArr = array("msyh.ttc");
//    for ($i = 0; $i < $length; $i++) {
//        $size = mt_rand(16, 20);
//        $angle = mt_rand(-15, 15);
//        $x = 5 + $i * $size;
//        $y = mt_rand(25, 40);
//        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 120), mt_rand(90, 180));
//        $fontFile = "../fonts/" . $fontFileArr[mt_rand(0, $fontFileArr . $length - 1)];
//        $text = substr($verify_str, $i, 1);
//        imagettftext($image, $size, $angle, $x, $y, $color, $fontFile, $text);
//    }
//    //增加干扰点
//    for ($i = 0; $i < $pixel_num; $i++) {
//        imagesetpixel($image, mt_rand(1, $width - 1), mt_rand(1, $height - 1), randColor($image, 0, 200));
//    }
//    //增加干扰线
//    for ($i = 0; $i < $line_num; $i++) {
//        imageline($image, mt_rand(1, $width - 1), mt_rand(1, $height - 1),
//            mt_rand(1, $width - 1), mt_rand(1, $height - 1), randColor($image, 40, 80));
//    }
//    //清空先前缓存区,这样才会显示图片
//    ob_clean();
//    //先设置头文件，发送到浏览器端
//    header("Content-type: image/png");
//    imagepng($image, "./verifyImg/verifyImg.png");
//    imagedestroy($image);
//}
//buildVerify();