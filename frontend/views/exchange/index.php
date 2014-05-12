<div id="header">
    <?php $this->renderPartial('//site/prompt'); ?>
    <?php $this->renderPartial('//site/login'); ?>
    <?php $this->renderPartial('//site/head'); ?>
    <?php $this->renderPartial('//site/nav', array('cat' => 0)); ?>
</div>

<div id="contentA" class="area">
    <div class="left">
        <div class="pt">
            <img src="<?php echo $data->exchange->img_url; ?>">
            <span class="bsr"></span>
        </div>
        <div class="blockA">
            <h2>热门兑换活动...</h2>
            <ul>
                <?php
                foreach ($data->hotExchangeGoods as $goods):
                    $goodsUrl = Yii::app()->createUrl("exchange/exchangeIndex", array("id" => Des::encrypt($goods->id)));
                    ?>
                    <li>
                        <a href="<?php echo $goodsUrl; ?>" target="_blank">
                            <img src="<?php echo $goods->img_url ?>">
                        </a>
                        <h3>
                            <a href="<?php echo $goodsUrl; ?>" target="_blank" title="<?php echo $goods->name; ?>">
                                <?php echo $goods->name; ?>
                            </a>
                        </h3>
                        <p><strong><?php echo $goods->user_count; ?></strong>人已参与</p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>


        <div class="blockB">
            <h2>谁兑换了礼品？</h2>
            <ul class="clear">
                <li>
                    <a href="http://www.tuan800.com/user/给生活松绑" target="_blank">
                        <img alt="给生活松绑" src="http://p12.tuanimg.com/user/avatar/0391/0509/small/9a2ece48-9bb4-4d74-96a0-b2e3a27ea9b6.jpg" title="给生活松绑">
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="right dhdeal">
        <form action="/jifen/welfare/confirm_order" method="post">
            <div class="deal zt2" info="d,129424,1400115600000,1398753000000,2" id="deal129424">
                <input name="id" type="hidden" value="129424">
                <input name="url_name" type="hidden" value="0yuanbaoyo_129424">
                <h2>
                    <span><?php echo $data->exchange->name; ?></span>
                    <a href="javascript:void(0)" onclick="" target="_self">收藏</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                    <em>分享 <i><a class="sina" href="http://v.t.sina.com.cn/share/share.php?url=http://www.zhe800.com/jifen/welfare/0yuanbaoyo_129424&amp;title=%E3%80%900%E5%85%83%E5%8C%85%E9%82%AE%E3%80%91%E5%B9%BC%E5%84%BF%E5%9B%AD%E7%94%9F%E6%97%A5%E7%A4%BC%E7%89%A9%E5%AE%9E%E7%94%A8%E7%94%B7%E9%80%81%E5%A5%B3%E7%94%9F%E5%B0%8F%E5%B0%8F%E7%A4%BC%E5%93%81%E6%96%B0%E5%A5%87%E7%89%B9%E5%88%AB%E5%88%9B%E6%84%8F%E5%AE%B6%E5%B1%85%E6%97%A5%E7%94%A8%E5%93%81%E7%99%BE%E8%B4%A7,%E5%8F%AF%E4%BB%A5%E5%9C%A8@%E6%8A%98800%20%E5%8F%82%E4%B8%8E%E7%A7%AF%E5%88%86%E5%85%91%E6%8D%A2,%E5%85%8D%E8%B4%B9%E8%BF%98%E5%8C%85%E9%82%AE%E9%80%81%E5%88%B0%E5%AE%B6,%E5%BF%AB%E6%9D%A5%E8%B5%9A%E7%A7%AF%E5%88%86%E5%90%A7&amp;pic=http://z2.tuanimg.com/upload/tao_jifen_deal/image/129424/normal_webp_25cba1d08981f4acb280c651d2a6a155.jpg" target="_blank"></a><a class="qqwb" href="http://share.v.t.qq.com/index.php?c=share&amp;a=index&amp;url=http://www.zhe800.com/jifen/welfare/0yuanbaoyo_129424&amp;title=%E3%80%900%E5%85%83%E5%8C%85%E9%82%AE%E3%80%91%E5%B9%BC%E5%84%BF%E5%9B%AD%E7%94%9F%E6%97%A5%E7%A4%BC%E7%89%A9%E5%AE%9E%E7%94%A8%E7%94%B7%E9%80%81%E5%A5%B3%E7%94%9F%E5%B0%8F%E5%B0%8F%E7%A4%BC%E5%93%81%E6%96%B0%E5%A5%87%E7%89%B9%E5%88%AB%E5%88%9B%E6%84%8F%E5%AE%B6%E5%B1%85%E6%97%A5%E7%94%A8%E5%93%81%E7%99%BE%E8%B4%A7,%E5%8F%AF%E4%BB%A5%E5%9C%A8@%E6%8A%98800%20%E5%8F%82%E4%B8%8E%E7%A7%AF%E5%88%86%E5%85%91%E6%8D%A2,%E5%85%8D%E8%B4%B9%E8%BF%98%E5%8C%85%E9%82%AE%E9%80%81%E5%88%B0%E5%AE%B6,%E5%BF%AB%E6%9D%A5%E8%B5%9A%E7%A7%AF%E5%88%86%E5%90%A7&amp;pic=http://z2.tuanimg.com/upload/tao_jifen_deal/image/129424/normal_webp_25cba1d08981f4acb280c651d2a6a155.jpg" target="_blank"></a><a class="renren" href="http://share.renren.com/share/buttonshare.do?link=http://www.zhe800.com/jifen/welfare/0yuanbaoyo_129424" target="_blank"></a><a class="kaixin" href="http://www.kaixin001.com/rest/records.php?url=http://www.zhe800.com/jifen/welfare/0yuanbaoyo_129424&amp;style=11&amp;content=%E3%80%900%E5%85%83%E5%8C%85%E9%82%AE%E3%80%91%E5%B9%BC%E5%84%BF%E5%9B%AD%E7%94%9F%E6%97%A5%E7%A4%BC%E7%89%A9%E5%AE%9E%E7%94%A8%E7%94%B7%E9%80%81%E5%A5%B3%E7%94%9F%E5%B0%8F%E5%B0%8F%E7%A4%BC%E5%93%81%E6%96%B0%E5%A5%87%E7%89%B9%E5%88%AB%E5%88%9B%E6%84%8F%E5%AE%B6%E5%B1%85%E6%97%A5%E7%94%A8%E5%93%81%E7%99%BE%E8%B4%A7,%E5%8F%AF%E4%BB%A5%E5%9C%A8@%E6%8A%98800%20%E5%8F%82%E4%B8%8E%E7%A7%AF%E5%88%86%E5%85%91%E6%8D%A2,%E5%85%8D%E8%B4%B9%E8%BF%98%E5%8C%85%E9%82%AE%E9%80%81%E5%88%B0%E5%AE%B6,%E5%BF%AB%E6%9D%A5%E8%B5%9A%E7%A7%AF%E5%88%86%E5%90%A7&amp;pic=http://z2.tuanimg.com/upload/tao_jifen_deal/image/129424/normal_webp_25cba1d08981f4acb280c651d2a6a155.jpg" target="_blank"></a><a class="douban" href="http://www.douban.com/recommend/?url=http://www.zhe800.com/jifen/welfare/0yuanbaoyo_129424&amp;title=%E3%80%900%E5%85%83%E5%8C%85%E9%82%AE%E3%80%91%E5%B9%BC%E5%84%BF%E5%9B%AD%E7%94%9F%E6%97%A5%E7%A4%BC%E7%89%A9%E5%AE%9E%E7%94%A8%E7%94%B7%E9%80%81%E5%A5%B3%E7%94%9F%E5%B0%8F%E5%B0%8F%E7%A4%BC%E5%93%81%E6%96%B0%E5%A5%87%E7%89%B9%E5%88%AB%E5%88%9B%E6%84%8F%E5%AE%B6%E5%B1%85%E6%97%A5%E7%94%A8%E5%93%81%E7%99%BE%E8%B4%A7,%E5%8F%AF%E4%BB%A5%E5%9C%A8@%E6%8A%98800%20%E5%8F%82%E4%B8%8E%E7%A7%AF%E5%88%86%E5%85%91%E6%8D%A2,%E5%85%8D%E8%B4%B9%E8%BF%98%E5%8C%85%E9%82%AE%E9%80%81%E5%88%B0%E5%AE%B6,%E5%BF%AB%E6%9D%A5%E8%B5%9A%E7%A7%AF%E5%88%86%E5%90%A7&amp;image=http://z2.tuanimg.com/upload/tao_jifen_deal/image/129424/normal_webp_25cba1d08981f4acb280c651d2a6a155.jpg" target="_blank"></a><a class="qzong" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=http://www.zhe800.com/jifen/welfare/0yuanbaoyo_129424&amp;title=%E3%80%900%E5%85%83%E5%8C%85%E9%82%AE%E3%80%91%E5%B9%BC%E5%84%BF%E5%9B%AD%E7%94%9F%E6%97%A5%E7%A4%BC%E7%89%A9%E5%AE%9E%E7%94%A8%E7%94%B7%E9%80%81%E5%A5%B3%E7%94%9F%E5%B0%8F%E5%B0%8F%E7%A4%BC%E5%93%81%E6%96%B0%E5%A5%87%E7%89%B9%E5%88%AB%E5%88%9B%E6%84%8F%E5%AE%B6%E5%B1%85%E6%97%A5%E7%94%A8%E5%93%81%E7%99%BE%E8%B4%A7,%E5%8F%AF%E4%BB%A5%E5%9C%A8@%E6%8A%98800%20%E5%8F%82%E4%B8%8E%E7%A7%AF%E5%88%86%E5%85%91%E6%8D%A2,%E5%85%8D%E8%B4%B9%E8%BF%98%E5%8C%85%E9%82%AE%E9%80%81%E5%88%B0%E5%AE%B6,%E5%BF%AB%E6%9D%A5%E8%B5%9A%E7%A7%AF%E5%88%86%E5%90%A7&amp;pics=http://z2.tuanimg.com/upload/tao_jifen_deal/image/129424/normal_webp_25cba1d08981f4acb280c651d2a6a155.jpg" target="_blank"></a></i></em>
                </h2>
                <h3>
                    <span>所需积分</span><em><?php echo $data->exchange->integral; ?></em>积分<br>
                    <span>价值</span><strong><i>￥</i><?php echo $data->exchange->price; ?></strong><br>
                    <span>兑奖名额</span><b><?php echo $data->exchange->num; ?></b>
                </h3>
                <h5><b>剩余时间</b><i>2</i>天<em class="one">13</em> 小时 <em class="two">33</em> 分钟 <em>31</em> 秒</h5>
                <h4>
                    <input class="btn" type="submit" value=""><span></span>
                    <a class="hasbd" href="javascript:void(0);"><?php echo $data->exchange->user_count?>人已兑换</a>
                    <em>(当前库存<b>1</b>件)</em>
                    <i>开始时间：04月29日 14:30 </i>
                </h4>
            </div>
        </form>

        <div class="J_TabBarWrap clear l">
            <ul class="tb-tabbar">
                <li class="selected">
                    <a href="javascript:void(0)" hidefocus="true">兑奖规则</a>
                </li>
                <li class="" style="display:none">
                    <a href="javascript:void(0)" hidefocus="true">礼品详情</a>
                </li>
                <li id="sdtotal" class="">
                    <a href="javascript:void(0)" hidefocus="true">晒单分享(<em>0</em>)</a>
                </li>
                <li id="recordtab" class="">
                    <a href="javascript:void(0)" hidefocus="true">兑换记录(<em>1</em>)</a>
                </li>
            </ul>
        </div>

        <div class="l clear displayIF" id="">
            <div class="topinfo"></div>
            <div class="blockCJ">
                <strong>兑换礼品规则</strong>
                1、活动开始后，所有注册会员均可点击“我要兑换”按钮进行礼品兑换       <br>
                2、为了更好的回馈会员，所有礼品不收取任何费用，我们包邮为您送到家      <br>
                3、兑换礼品需要花费相应的积分，积分不足不能兑换      <br>
                4、一旦兑换即扣除相应积分，所兑换的礼品将在后台审核后发出。如审核过程中发现该用户积分行为异常，兑换礼品将不予发放，已扣除积分不退还。如该用户恶意积分行为严重，我们保留不另行通知而直接封禁该用户账号的权利。<br>
                5、由于礼品数量有限，我们对每位会员每个自然月获得礼品数设置了上限，<a href="/jifen/rule" target="_blank">查看详情&gt;&gt;</a>
                <strong>注意事项</strong>
                1、团800内部员工禁止参加0元换购中的任何兑换活动      <br>
                2、数量有限，请先登录账号再进行兑换，这样才能快人一步      <br>
                3、请准确填写<a href="/jifen/profile/address" class="log" target="_blank">收货地址</a>和电话,如因填写的地址或电话有误导致的快递丢失,积分不退    <br>
                4、0元换购中的礼品，一经换出不予退换<br>
                5、折800网有权在活动未开始前对活动信息进行更改，活动信息以兑换活动开始后的为准<br>
                6、在接到快递时请本人签收并当场确认，如物品有问题请务必拒签，否则不予处理<br>
                7、全国多数地区包邮，部分地区（港澳台，新疆，内蒙，西藏，甘肃、青海等偏远地区）不包邮
            </div>
        </div>

        <div class="l clear displayIF" id="" style="display: none;">
            <div class="topinfo"></div>
            <div class="bbilis2">
                数量：1，颜色随机
            </div>
        </div>

        <div class="l clear displayIF" id="pjxq" style="display: none;">
            <div class="topinfo" info="2"></div><div class="plzw">买过的人都很懒，还没有人分享过这件商品的淘货感想，争做晒团第一人！</div>
        </div>

        <div class="l clear displayIF" id="records" style="display: none;">
            <div class="topinfo"></div>
            <!-- <div class="uslist">
                <div class="tit"><span class="w1">用户名</span><span class="w2">属性</span><span class="w3">出价时间</span></div>
                <div class="plzw">捡到宝了，这件商品还没有人进行过兑换，快来参与兑换！</div>
                <div class="loading"><em></em></div>
                <ul class="dhuan">
                    <li><span class="w1"><a href="#" target="_blank">山东黄金</a><a href="/profile/trade" target="_blank"><em class="z0"></em></a></span><span class="w2">XXL 红色</span><span class="w3">2013-07-03 11:11:11</span></li>
                    <li class="bg2"><span class="w1"><a href="#" target="_blank">蜡笔小新在中国</a><a href="/profile/trade" target="_blank"><em class="z1"></em></a></span><span class="w2">M 蓝色</span><span class="w3">2013-07-03 11:11:11</span></li>
                    <li><span class="w1"><a href="#" target="_blank">烂七八糟雅虎和</a><a href="/profile/trade" target="_blank"><em class="z2"></em></a></span><span class="w2">S 绿色</span><span class="w3">2013-07-03 11:11:11</span></li>
                    <li class="bg2"><span class="w1"><a href="#" target="_blank">奇怪的片警</a><a href="/profile/trade" target="_blank"><em class="z3"></em></a></span><span class="w2">XL</span><span class="w3">2013-07-03 11:11:11</span></li>
                    <li><span class="w1"><a href="#" target="_blank">蜡笔小新在中国</a><a href="/profile/trade" target="_blank"><em class="z4"></em></a></span><span class="w2">L</span><span class="w3">2013-07-03 11:11:11</span></li>
                    <li class="bg2"><span class="w1"><a href="#" target="_blank">山东黄金</a><a href="/profile/trade" target="_blank"><em class="z5"></a></em></span><span class="w2">380</span><span class="w3">2013-07-03 11:11:11</span></li>
                    <li><span class="w1"><a href="#" target="_blank">烂七八糟雅虎和</a><a href="/profile/trade" target="_blank"><em class="z0"></em></a></span><span class="w2">380</span><span class="w3">2013-07-03 11:11:11</span></li>
                    <li class="bg2"><span class="w1"><a href="#" target="_blank">山东黄金</a><a href="/profile/trade" target="_blank"><em class="z0"></em></a></span><span class="w2">380</span><span class="w3">2013-07-03 11:11:11</span></li>
                    <li><span class="w1"><a href="#" target="_blank">奇怪的片警</a><a href="/profile/trade" target="_blank"><em class="z0"></em></a></span><span class="w2">380</span><span class="w3">2013-07-03 11:11:11</span></li>
                    <li class="bg2"><span class="w1"><a href="#" target="_blank">山东黄金</a><a href="/profile/trade" target="_blank"><em class="z0"></em></a></span><span class="w2">380</span><span class="w3">2013-07-03 11:11:11</span></li>
                </ul>
                <div class="list_page"><span class="selected">上页</span> <span>1</span><a info="2" href="javascript:void(0)">2</a><a info="3" href="javascript:void(0)">3</a><a info="4" href="javascript:void(0)">4</a><a info="5" href="javascript:void(0)">5</a><a info="6" href="javascript:void(0)">6</a><a info="7" href="javascript:void(0)">7</a><a info="8" href="javascript:void(0)">8</a> <a info="2" href="javascript:void(0)">下页</a></div>
                <div class="pgmsg">亲，由于兑换记录较多，我们只显示最新的前50页</div>
            </div> -->
        </div>
    </div>

</div>


<?php $this->renderPartial('//site/side'); ?>
<div id="footer" class="footer">
    <?php $this->renderPartial('//site/footer'); ?>
</div>
