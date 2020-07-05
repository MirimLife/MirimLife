<?php
    $num = $_GET['num'];
    $page = $_GET['page'];
    $down = $_GET['file'];
    $file = substr($down, 14);
    $filesize = filesize($down);

    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    
    if(file_exists($down)){
        header("Content-Type:application/octet-stream");
        header("Content-Disposition:attachment;filename=$file");
        header("Content-Transfer-Encoding:binary");
        header("Content-Length:".filesize($down));
        header("Cache-Control:cache,must-revalidate");
        header("Pragma:no-cache");
        header("Expires:0");
        if(is_file($down)){
            $fp = fopen($down,"r");
            while(!feof($fp)){
                $buf = fread($fp,8096);
                $read = strlen($buf);
                print($buf);
                flush();
            }
            fclose($fp);
        }
    } else{
        echo "<script> alert('존재하지 않는 파일입니다.'); location.replace('NoticeDetail.php?num=$num&page=$page'); </script>";
    }
?>