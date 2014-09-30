$(function() {

/* -------
	hover
------- */

function huwatto(el, pos) {
	var $el = $(el);
	// $el.stop().animate({                
	// 	'marginTop': pos
	// });

	$el.hover(
        function(){
            $el.stop().animate({                
                'marginTop':'10px'
            });
        },
        function () {
            $el.stop().animate({                
                'marginTop':'0px'
            });
        }
        
    );

};


var $btn = $('#headerBtn');

$btn.hover(
	function(){
	    huwatto(this, -5);
	},
	function(){
	    huwatto(this, 0);
	}
);


/* -------
    スムーススクロール
------- */


$(function(){
   // #で始まるアンカーをクリックした場合に処理
   $('a[href^=#]').click(function() {
      // スクロールの速度
      var speed = 400; // ミリ秒
      // アンカーの値取得
      var href= $(this).attr("href");
      // 移動先を取得
      var target = $(href == "#" || href == "" ? 'html' : href);
      // 移動先を数値で取得
      var position = target.offset().top;
      // スムーススクロール
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });
});


/* -------
    chatter
------- */

// ふわっと表示
$(document).ready(function(){
    $('#chatter').hide();
    $('#chatter').delay().fadeIn(1000);
});

// 閉じるボタン
$("#chatter span").click(function () {
  $('#chatter').fadeOut(500);
  return false;
});

$('#chatter').hover(
    function(){
        $('#chatter').delay(500).css('background', 'rgba(22,33,66,1)');
    },
    function(){
        $('#chatter').delay(500).css('background', 'rgba(22,33,66,0.6)');
    }
);


/* -------
    タブ検索
------- */


  //クリックしたときのファンクションをまとめて指定
  $('.tab li').click(function() {

    //.index()を使いクリックされたタブが何番目かを調べ、
    //indexという変数に代入します。
    var index = $('.tab li').index(this);

    //コンテンツを一度すべて非表示にし、
    $('.content li').css('display','none');

    //クリックされたタブと同じ順番のコンテンツを表示します。
    $('.content li').eq(index).css('display','block');

    //一度タブについているクラスselectを消し、
    $('.tab li').removeClass('select');

    //クリックされたタブのみにクラスselectをつけます。
    $(this).addClass('select')
  });

// End
});