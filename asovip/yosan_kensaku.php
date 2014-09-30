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
              <img id="logo" src="img/asovip_logo_3.png" height="80px" alt="asovip">
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
          <h2><span></span>検索結果</h2>
<?php

$yosan = $_POST['yosan'];


$connect = mysql_connect("localhost","b31_c296","b31_c296");

mysql_query("SET NAMES utf8" , $connect);

$sql = "select * from asovip_article_tbl where yosan = '$yosan'";

// echo $sql;

$result = mysql_db_query("b31_c296", $sql);



while(true){
	$kekka = mysql_fetch_assoc($result);
	if($kekka == null){
		break;
	}else{
?>
	<div class="col-md-3 col-sm-3 col-xs-12">
                  <div class="new_article">	


<tr>
							<td><?php echo "<img class='img-responsive' src='http://a1.zeroprm.com/b31_c296/asovip/img/article/{$kekka['image']}'>"; ?></td><br>
							<td>アソビ：<?php echo $kekka['title']; ?></td><br>
							<!-- <td><?php echo $kekka['detail']; ?></td><br> -->
							<td>場所：<?php echo $kekka['place']; ?></td><br>
							<td>予算：<?php echo $kekka['yosan']; ?></td><br>
							<td>評価：<?php echo $kekka['hyouka']; ?></td><br>
							<td>誰と：<?php echo $kekka['gowith']; ?></td><br>
							<td>投稿日時<?php echo $kekka['postdate']; ?></td><br>
							<td><a href='syousai.php?id=<?php echo $kekka['id']; ?>'>詳細</a></td>
						</tr>
</div>
				</div>

<?php
//		echo "$kekka['place']";
//		echo "$kekka['yosan']";
//		echo "<br>";
	}
}

mysql_close($connect);
?>

<!--           <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="new_article">
              <img src="img/logo.png" alt="AGESTOCK BASEBALL CLUB" class="img-responsive">
            </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="new_article">
              <img src="img/logo.png" alt="AGESTOCK BASEBALL CLUB" class="img-responsive">
            </div>
          </div> -->
        </div>


      </div>

      <div id="orange">
        <div class="container">

        <div id="section4" class="row section">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <h2>お問い合わせ</h2>
            <p>asovipのお問い合せに関してはこちらから</p>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <form class="form-horizontal" role="form">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label">メール</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" id="inputEmail3" placeholder="agebaseball@age.com">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">お名前</label>
              <div class="col-sm-9">
                <input type="name" class="form-control" id="inputPassword3" placeholder="加藤賢太">
              </div>
            </div>

            <div class="form-group">
              <label for="inputtext" class="col-sm-3 control-label">意気込み,<br>備考,<br>ご質問等</label>
              <div class="col-sm-9">
                
                <textarea class="form-control" rows="3" placeholder="なんでもどうぞ！"></textarea>
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