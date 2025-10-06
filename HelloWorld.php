<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission3-4</title>
</head>
<body>
    <?php
    $filename="mission_3-5.txt";
     if(!empty($_POST["editnum"])){
            $edit=$_POST["editnum"];
             $password3 = $_POST["password3"];
                $lines = file($filename,FILE_IGNORE_NEW_LINES);
                for($i = 0; $i < count($lines); $i++){
                        $array = explode("<>",$lines[$i]);
                        $ary = $array[0];
                         $endnum= $array[4];
                        if($ary==$edit && $endnum==$password3){
                             $namae=$array[1]; 
                             $com=$array[2]; 
                    }
                }
            }
    ?>
  <form action="" method="post">
          <input type="text" name="name" placeholder="名前"value=<?php
        if(!empty($namae)){echo $namae;}?>>
        <br>
          <input type="text" name="str" placeholder="コメント" value=<?php
        if(!empty($com)){echo $com; }?>>
          <input type="submit" name="submit" value = "投稿">
           <input type="text" name="password" placeholder="パスワード">
          <br>
            <input type="text" name="deletenum" placeholder="削除番号">
             <input type="submit" name="delete" value = "削除">
              <input type="text" name="password2" placeholder="パスワード">
             <br>
              <input type="hidden" name="hide" value=<?php
                if(!empty($edit)){echo $edit; } ?>>
                <br>
              <input type="text" name="editnum" placeholder="編集番号指定">
              <input type="submit" name="edit" value = "編集">
              <input type="text" name="password3" placeholder="パスワード">
              
      </form>  
   <?php
    $name = $_POST["name"];
    $str = $_POST["str"];
    $date = date("Y/n/j G:i:s");
    $hide = $_POST["hide"];
    $deletenum = $_POST["deletenum"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    //投稿番号の取得
 if(file_exists($filename)){
        $num = count(file($filename)) + 1;
    }else{
        $num = 1;
    }
        // 相違点２
    $comment =$num."<>".$name."<>".$str."<>".$date;
    $data =$comment."<>".$password;
    //投稿の作成
     if(!empty($name && $str) && empty($hide)){ 
    //　ファイルを開く
    $fp = fopen( $filename, "a");
    // ファイルに記入
    fwrite($fp, $data.PHP_EOL);
    // ファイルを閉じる
    fclose($fp);
     $file = fopen( $filename, "r");
/* ファイルを1行ずつ出力 */
 $lines = file($filename,FILE_IGNORE_NEW_LINES);
                foreach($lines as $line){
                        $array = explode("<>",$line);
                        for($i = 0; $i < 4; $i++){
                            echo $array[$i]."<>";
                        }
                            echo "<br>";
     }
}

 
 if($deletenum){ 
     if(file_exists($filename)){
       $lines = file($filename,FILE_IGNORE_NEW_LINES);
       //　ファイルを開く
     $fp = fopen($filename, "w");
    /*配列の要素数（＝行数）だけループさせる*/
    for ($j = 0; $j < count($lines) ; $j++){
      /*区切り文字「<>」で分割して、投稿番号を取得*/
       $line = explode("<>", $lines[$j]);
        $postnum = $line[0];
        $endnum = $line[4];
      /*投稿番号と削除対象番号を比較。等しくない場合はファイルに追加書き込みを行う*/
   if($postnum != $deletenum){ 
     fwrite($fp, $lines[$j].PHP_EOL);
            echo $line[0]."<>".$line[1]."<>".$line[2]."<>".$line[3]."<br>";
       }elseif($postnum = $deletenum && $endnum != $password2){
            fwrite($fp, $lines[$j].PHP_EOL);
            echo $line[0]."<>".$line[1]."<>".$line[2]."<>".$line[3]."<br>";
       }
   
}
  fclose($fp);
     }
 
  }elseif(!empty($name && $str && $hide)) {
                
                 if(file_exists($filename)){
                     
                    $lines = file($filename,FILE_IGNORE_NEW_LINES);
                    $fp = fopen($filename,"w");
                    
                    for($i = 0; $i < count($lines); $i++){
                        
                        $array = explode("<>",$lines[$i]);
                        $ary = $array[0];
                   if($ary!=$hide){
                        
                         fwrite($fp, $lines[$i].PHP_EOL);
                         echo $array[0]."<>".$array[1]."<>".$array[2]."<>".$array[3]."<br>";
                         
                            }else{
                                $all = $hide."<>".$name."<>".$str."<>".$date;
                           
                                fwrite($fp, $all.PHP_EOL);
                                $array = explode("<>",$all);
                                echo $array[0]."<>".$array[1]."<>".$array[2]."<>".$array[3]."<br>";
                            }
                        }
                        fclose($fp);
                    }
                
            }

?>

　


</body>
</html>
