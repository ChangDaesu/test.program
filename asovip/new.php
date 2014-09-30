<?php

$connect = mysql_connect("localhost","b31_c296","b31_c296");
mysql_query("SET NAMES utf8",$connect);

$error = $_FILES['upfile']['error'];
if ($error == "2"){
    echo "画像のサイズが大きすぎます！";
    //print "画像のサイズが大きすぎます！";
}else{

  //画像ファイルをデータベースに保存するのではなく、画像ファイル名をデータベースに保存することにした
  //そのため、画像ファイル名がかぶった場合はNGとする 
  //ちなみに、imgというフォルダの中に画像を保存することにした

  //画像を保存するフォルダを指定する
  $uploaddir = '/usr/local/www/a1.zeroprm.com/htdocs/b31_c296/';
  //$uploaddir = 'http://a1.zeroprm.com/htdocs/b31_c145/stylish-portfolio 3/img/';

  //$_FILES['upfile']['name']にHTMLで指定された画像ファイル名が入っている
  //「.」には文字を結合する効果がある ex. "aaa"."bbb" は "aaabbb" となる
  $uploadfile = $uploaddir . basename($_FILES['upfile']['name']);

  //既にこのフォルダに同名のファイルが存在するかどうかのチェック
  if(file_exists($uploadfile)){
      echo "既に同名の画像が存在するため、別名にしてください。";
  }else{

      //move_uploaded_fileで、PCにある画像ファイルをサーバーに転送できる
      if (move_uploaded_file($_FILES['upfile']['tmp_name'], $uploadfile)) {

          //転送が成功した場合！！！！！
          $connect = mysql_connect("localhost", "b31_c296", "b31_c296");
          //文字コードを設定
          //mysql_query("SET NAMES utf8",$connect); 

          //データベースには画像のファイル名を保存する  



$connect = mysql_connect("localhost","b31_c296","b31_c296");
mysql_query("SET NAMES utf8",$connect);

if (isset($_POST['select_1'])) {
    $select_1 = 1;
} else {
    $select_1 = 0;
}

if (isset($_POST['select_2'])) {
    $select_2 = 1;
} else {
    $select_2 = 0;
}

if (isset($_POST['select_3'])) {
    $select_3 = 1;
} else {
    $select_3 = 0;
}

if (isset($_POST['select_4'])) {
    $select_4 = 1;
} else {
    $select_4 = 0;
}

if (isset($_POST['select_5'])) {
    $select_5 = 1;
} else {
    $select_5 = 0;
}

if (isset($_POST['select_6'])) {
    $select_6 = 1;
} else {
    $select_6 = 0;
}

if (isset($_POST['select_7'])) {
    $select_7 = 1;
} else {
    $select_7 = 0;
}

if (isset($_POST['select_8'])) {
    $select_8 = 1;
} else {
    $select_8 = 0;
}





//$sysdate = sysdate();

mysql_db_query("b31_c296",

		"INSERT INTO asovip_article_tbl(title,place,yosan,gowith,postdate,select_1,select_2,select_3,select_4,select_5,select_6,select_7,select_8,detail,hyouka) 
		values('{$_POST['title']}','{$_POST['place']}','{$_POST['yosan']}','{$_POST['gowith']}','now()','$select_1','$select_2','$select_3','$select_4','$select_5','$select_6','$select_7','$select_8','{$_POST['detail']}',
      '{$_FILES['upfile']['name']}','{$_POST['hyouka']}')"

);


          

      } else {
          echo "ファイルのアップロード失敗";
      }
  }
}         



	mysql_close($connect);

	?>
