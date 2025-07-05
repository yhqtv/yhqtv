<html>
<head>
<title>鑫淼的世界</title>
<link rel="stylesheet" type="text/css" media="screen" href="./style.css" />
<meta name="Author" contect="www.yhqtv.com">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="Robots" contect= "none">
<meta charset="UTF-8">
</head>
<body>
<div class=wrapper>
<span>
<?php 
date_default_timezone_set("PRC");
$weekarray=array("日","一","二","三","四","五","六");
$weekday=$weekarray[date("w")];
echo date("n月j日, 星期$weekday");
?>
</span>
<div>
<form method="POST" action="bj.php"> 
    <div><textarea name="msg" rows="4"></textarea></div>
    <div class=btn><input name="Btn" type="submit" value="提交"></div>
</form>
</div>

<?php
/****************************************设置*******************************************/

$SAME_FILE = True;    //这里设置新的一个月开始时，是否要写入原文件。True将写入原文件，False将在月初新开一个文件。如果你的帖子较多，建议设置False，如果帖子不多，可以设为True

/***************************************************************************************/
$filename = "./posts.txt";
file_exists($filename) or file_put_contents($filename, "\xEF\xBB\xBF<div class=post><div class=time>".date("n月j日##H:i##星期$weekday")."</div><div class=msg>-- start --</div></div>");
$original_posts = file_get_contents($filename);
if (isset($_POST["msg"])) {
    $msg = $_POST["msg"];
    ($msg=='') and die('没用写内容哦。');
    $msg = preg_replace("/\bhttp:\/\/(\w+)+.*\b/",'<a href="$0">$0</a>',$msg);
    preg_match("/(\d{1,2}).(\d{1,2}).##\d{2}:\d{2}##.{3}/u",$original_posts,$matches) or die('文件格式错误，找不到日期，请联系pilicurg@163.com');
    $post_month= $matches[1];
    $post_day= $matches[2];
    $current_month = date("n");
    $current_day = date("j");
    if($SAME_FILE || ($current_month===$post_month)){
        if($current_day===$post_day && $current_month===$post_month){
            $time = date("H:i");
        }
        else{
            $time = date("n月j日##H:i##星期$weekday");
        }
        $posts = "<div class=post><div class=time>$time</div><div class=msg>$msg</div></div>" . $original_posts;
        file_put_contents($filename, $posts);
        $posts = preg_replace("/(>\d{1,2}.\d{1,2}.)##(\d{2}:\d{2})##(.{3}<)/u","$1<br />$2<br />$3",$posts);
        echo nl2br($posts);
    }
    else{
        $time = date("n月j日##H:i##星期$weekday");
        $posts = "<div class=post><div class=time>$time</div><div class=msg>$msg</div></div>";
        if($post_month==='12' && $current_month==='1'){
            $newfile = "posts_".strval(intval(date("Y"))-1).'_'.$post_month.'.txt';
        }
        else{
            $newfile = "posts_".date("Y").'_'.$post_month.'.txt';
        }
        if (rename($filename, $newfile)){
            file_put_contents($filename, "\xEF\xBB\xBF".$posts);
        }
        else{
            die('重命名 $filename 到 $newfile 不成功');
        }
        $posts = preg_replace("/(>\d{1,2}.\d{1,2}.)##(\d{2}:\d{2})##(.{3}<)/u","$1<br />$2<br />$3",$posts);
        echo nl2br($posts);
    }    
    redirect('bj.php');
}
else{
    $posts = preg_replace("/(>\d{1,2}.\d{1,2}.)##(\d{2}:\d{2})##(.{3}<)/u","$1<br />$2<br />$3",$original_posts);
    echo nl2br($posts);
}

function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

?>
</div>
<span><a href="http://www.yhqtv.com">©2018 yhqtv.com</a></span>
</body>
</html>