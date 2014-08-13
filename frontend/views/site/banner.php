<style type="text/css">
    
/* 首屏广告*/
.area{width:980px;margin: 0 auto}/*页面属性 */
.banner_column{margin-top: 10px;}
.banner_column .content{overflow: hidden;width: 979px;height: 340px;background: #fff;}

.banner_column dl{width: 980px}
.banner_column dl dd,.banner_column dl dt{float: left;font-size: 0;border: 1px solid #ececec;overflow: hidden;*position: relative;}
.banner_column dl dd img,.banner_column dl dt img{-moz-transition:-moz-transform .2s linear;-webkit-transition:-webkit-transform .2s linear;-o-transition:-o-transform .2s linear;-ms-transition:-ms-transform .2s linear;transition:transform .2s linear;}
/* .banner_column dl dd img:hover,.banner_column dl dt img:hover{-moz-transform:translateX(-10px); -webkit-transform:translateX(-10px); -o-transform:translateX(-10px); -ms-transform:translateX(-10px); transform:translateX(-10px); } */
.banner_column dl dt{border-width: 0 1px 0 0;}
.banner_column dl dd{border-width:0 1px 1px 0;}

#news {width:980px;height:35px;padding-top:15px;margin:0 auto;border-bottom:1px solid #CCC;
}
#news p {font-family:"微软雅黑";font-size:16px;float:left;width:130px;color:#666}
#news p span {font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;color:red;font-size: 16px;}
#news dl {float:right;}
#news dl dt {float:left;font-family:"微软雅黑";font-size:16px;margin-top: 4px;color:#666;}
#news dl dd {float:left;border:1px solid #CCC;width:40px;height:20px;font-size:12px;margin-top:2px;padding-top:2px;text-align: center;}
#news .newred {color:red;}

</style>
<?php if($page<2):?>
<div class="banner_column area">
    <div class="content">
      <dl>
      
        <dt><img alt="" src="http://static.meipin.com/static/10.png"></dt>
        <dt><a href="http://www.meipin.com/brand/5yuan" target="_blank"><img alt="" src="http://static.meipin.com/static/11.png"></a></dt>
        <dd><a href="http://meipin.com/index.html?cat=1000" target="_blank"><img alt="" src="http://static.meipin.com/static/12.png"></a></dd>
        <dd><a href="http://meipin.com/raffle" target="_blank"><img alt="" src="http://static.meipin.com/static/13.png"></a></dd>
         <dd><a href="http://meipin.com/exchange/index" target="_blank"><img alt="" src="http://static.meipin.com/static/14.png"></a></dd>
         <dd><a href="http://meipin.com/site/phone" target="_blank"><img alt="" src="http://static.meipin.com/static/15.jpg"></a></dd>
      </dl>
    </div>
  </div>
<?php endif;?>
  <div id="news">
    <p style='font-family:"微软雅黑";font-size:16px;float:left;width:130px;'>今日已更新<span><?php echo Goods::gettodaynum();?></span>款</p>
    <dl>
        <dt>排序：</dt>
        <dd><a href="/?hot=new"><span <?php if(isset($_GET['hot'])){echo " class='newred' ";} ?> >最新</span></a></dd>
        <dd><a href="/"><span <?php if(!isset($_GET['hot'])){echo " class='newred' ";} ?> >最热</span></a></dd>
        <br>
    </dl>
    <br>
  </div>
