<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require '../src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '334993866548043',
  'secret' => '9a185006487e4f063059f26f2aa32859',
));

// Get User ID
$user = $facebook->getUser();

// セッションの開始
// session_start();

// セッション変数に値を代⼊
$_SESSION['user_id'] = $user;



// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

// This call will always work since we are fetching public data.
// $naitik = $facebook->api('/naitik');

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>asovip</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/index.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/index.js"></script>
  </head>
  <body>
    <div id="bodyWrapper">
      <div id="nav_wrapper">
        <div class="container">
          <div id="nav">
            <div class="clearfix">
              <a href="index.php"><img id="logo" src="img/asovip_logo_3.png" height="80px" alt="asovip"></a>
              <div id="status">
                <?php if ($user): ?>
                  <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">
                  <?php
                  $tmp = $facebook->api(array(
                    'method' => 'fql.query',
                    'query' => "select name from user where uid=me()",
                  ));

                  echo $tmp[0]['name'];
                  echo 'さんはログインしています。'
                ?>

                <?php else: ?>
                  <strong><em>ログインされていません</em></strong>
                <?php endif ?>

                <?php if ($user): ?>
                  <a href="<?php echo $logoutUrl; ?>">ログアウト</a>
                <?php else: ?>
                  <div>
                    <a href="<?php echo $loginUrl; ?>">Facebookでログイン</a>
                  </div>
                <?php endif ?>
              </div>
            </div>

          <ul class="tab clearfix">
            <li>場所で検索</li>
            <li>予算で検索</li>
            <li>ワードで検索</li>
          </ul>
          <ul class="content">
            <li class="kakusu">
              <form action = "place_kensaku.php" method = "POST">
                    
                <b>エリア</b><br>
                    <select name="place">
                <OPTION value=""></OPTION>
                <OPTION value="新宿">新宿</OPTION>
                <option value="銀座・有楽町">銀座・有楽町</option>
                <option value="立川・八王子">立川・八王子</option>
                <option value="小金井・国分寺・国立">小金井・国分寺・国立</option>
                <option value="池袋・巣鴨・駒込">池袋・巣鴨・駒込</option>
                <option value="水道橋・飯田橋・神楽坂">水道橋・飯田橋・神楽坂</option>
                <option value="恵比寿・中目黒・目黒">恵比寿・中目黒・目黒</option>
                <option value="渋谷">渋谷</option>
                <option value="上野・浅草・日暮里">上野・浅草・日暮里</option>
                <option value="人形町・門前仲町・葛西">人形町・門前仲町・葛西</option>
                <option value="神田・秋葉原・お茶ノ水">神田・秋葉原・お茶ノ水</option>
                <option value="中野・吉祥寺・三鷹">中野・吉祥寺・三鷹</option>
                <option value="品川・田町・五反田">品川・田町・五反田</option>
                <option value="六本木・麻布・広尾">六本木・麻布・広尾</option>
                <option value="東京駅・丸の内・日本橋">東京駅・丸の内・日本橋</option>
                <option value="新橋・浜松町">新橋・浜松町</option>
                <option value="錦糸町・浅草橋・新小岩">錦糸町・浅草橋・新小岩</option>
                <option value="赤坂・永田町・虎ノ門">赤坂・永田町・虎ノ門</option>
                <option value="大井町・大森・蒲田">大井町・大森・蒲田</option>
                <option value="自由が丘・三軒茶屋・二子玉川">自由が丘・三軒茶屋・二子玉川</option>
                <option value="北千住・綾瀬・金町">北千住・綾瀬・金町</option>
                <option value="下北沢・明大前・成城学園前">下北沢・明大前・成城学園前</option>
                <option value="原宿・表参道・青山">原宿・表参道・青山</option>
                <option value="板橋・成増・赤羽">板橋・成増・赤羽</option>
                <option value="府中・調布・多摩センター">府中・調布・多摩センター</option>
                <option value="練馬・江古田・田無">練馬・江古田・田無</option>
                <option value="町田・新百合ケ丘・厚木・相模原・大和（神奈川）">町田・新百合ケ丘・厚木・相模原・大和（神奈川）</option>
                <option value="豊洲・お台場・湾岸">豊洲・お台場・湾岸</option><option value="伊豆諸島・小笠原諸島">伊豆諸島・小笠原諸島</option>
                </select>


                <input type="submit" value="検索">

              </form>
            </li>
            <li class="kakusu">
              <form action = "yosan_kensaku.php" method = "POST">

                <select name="yosan">
                  <OPTION value=""></OPTION>
                  <OPTION value="無料">無料</OPTION>
                  <option value="~1,000円">~1,000円</option>
                  <option value="1,001円~3,000円">1,001~3,000円</option>
                  <option value="3,001~5,000円">3,001~5,000円</option>
                  <option value="5,000円~10,000円">5,000円~10,000円</option>
                  <option value="10,001~30,000円">10,001~30,000円</option>
                  <option value="30,001円~50,000円">30,001円~50,000円</option>
                  <option value="50,001円~">50,001円~</option>
                </select>

                <input type="submit" value="検索">

              </form>
            </li>
            <li class="kakusu">
              <form action = "title_kensaku.php" method = "POST">
      
                  <input type="text" name="title">

                <input type="submit" value="検索">

              </form>
            </li>
          </ul>

          </div>
        </div>
      </div>

      <div class="container">


        <div id="section2" class="row section">
          <h2><span></span>投稿フォーム</h2>
          
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
  $uploaddir = '/usr/local/www/a1.zeroprm.com/htdocs/b31_c296/asovip/img/article/';
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
$sql = "INSERT INTO asovip_article_tbl(
      title,place,image,yosan,gowith,
      postdate,select_1,select_2,select_3,select_4,select_5,select_6,
      select_7,select_8,detail,hyouka,name) 
    values(
      '{$_POST['title']}','{$_POST['place']}','{$_FILES['upfile']['name']}','{$_POST['yosan']}','{$_POST['gowith']}',sysdate(),'$select_1','$select_2','$select_3','$select_4','$select_5','$select_6','$select_7','$select_8','{$_POST['detail']}',
      '{$_POST['hyouka']}','{$tmp[0]['name']}')";

//　echo $sql;

mysql_db_query("b31_c296", $sql);


// echo "INSERT INTO asovip_article_tbl(
//       title,place,image,yosan,gowith,
//       postdate,select_1,select_2,select_3,select_4,select_5,select_6,
//       select_7,detail,hyouka) 
//     values(
//       '{$_POST['title']}','{$_POST['place']}','{$_FILES['upfile']['name']}','{$_POST['yosan']}','{$_POST['gowith']}','now()','$select_1','$select_2','$select_3','$select_4','$select_5','$select_6','$select_7','{$_POST['detail']}',
//       '{$_POST['hyouka']}')";


      } else {
          echo "ファイルのアップロード失敗";
      }
  }
}         



  mysql_close($connect);

  ?>


<p><strong>投稿ありがとうございました！</strong></p>
<p><a href = "http://a1.zeroprm.com/b31_c296/asovip/">トップへ</a></p>




        </div>


      </div>

      <div id="orange">
        <div class="container">

        <div id="section4" class="row section">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <h2>お問い合わせ</h2>
            <p>asovipに関するお問い合わせはこちらから</p>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <form class="form-horizontal" role="form">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label">メール</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" id="inputEmail3" placeholder="address@asovip.com">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">お名前</label>
              <div class="col-sm-9">
                <input type="name" class="form-control" id="inputPassword3" placeholder="加藤賢太">
              </div>
            </div>

            <div class="form-group">
              <label for="inputtext" class="col-sm-3 control-label">ご質問<br>備考等</label>
              <div class="col-sm-9">
                
                <textarea class="form-control" rows="3" placeholder="お問い合せ内容"></textarea>
              </div>
            </div>

            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> チェックして送信ボタンを押して下さい
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">送信</button>
              </div>
            </div>
          </form>
          </div>
        </div>
        
        </div>
      </div>
      


      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>
    </div>
  </body>
</html>