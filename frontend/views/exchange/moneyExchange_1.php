<div id="contentA" class="contentA">
    <div class="deteilpic l">
    <figure style="height: 400px;">
          <img src="http://z4.tuanimg.com/imagev2/trade/400x400.7b3ff3d7ff22ac777e782c59d149fc4e.400x.jpg">
    </figure>
    <ul>
          <li class="">
            <a href="javascript:;">
              <img src="http://z4.tuanimg.com/imagev2/trade/400x400.2a618920812b60ee22edc97feb93f7e2.58x58.jpg" bigimage-data="http://z4.tuanimg.com/imagev2/trade/400x400.2a618920812b60ee22edc97feb93f7e2.400x.jpg">
            </a>
          </li>
          <li class="cur">
            <a href="javascript:;">
              <img src="http://z4.tuanimg.com/imagev2/trade/400x400.7b3ff3d7ff22ac777e782c59d149fc4e.58x58.jpg" bigimage-data="http://z4.tuanimg.com/imagev2/trade/400x400.7b3ff3d7ff22ac777e782c59d149fc4e.400x.jpg">
            </a>
          </li>
    </ul>
  </div>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="left">
        <div class="pt">
            <img src="<?php echo $data['exchange']->img_url; ?>">
            <span class="bsr"></span>
        </div>
        <?php
        $this->renderPartial('hotExchange', array('goodsList' => $data['hotExchangeGoods'], 'goodsType' => $data['exchange']->goods_type));
        ?>
    </div>

    <div class="right dhdeal">
        <form action="<?php echo Yii::app()->createUrl("exchange/order") ?>" method="POST" <?php if ($data['exchange']->goodscolor): ?> onsubmit="return checkcolor()" <?php endif; ?> >
            <?php
            $leftNum = $data['exchange']->num - $data['exchange']->sale_num; //剩余量
            $start = "zt3"; //兑换结束
            if ($data['exchange']->start_time > time()) {
                $start = "zt1"; //即将开始
            } elseif ($data['exchange']->start_time < time() && $data['exchange']->end_time > time() && $leftNum >0) {
                $start = "zt2"; //我要兑换
            }
            ?>
            <div class="deal <?php echo $start ?>">
                <h2>
                    <span><?php echo $data['exchange']->name; ?></span>
                </h2>
                <h3 class="border-top-dashed">
                    <span>现价：</span><em>￥19+<?php echo $data['exchange']->integral; ?></em>积分<br>
                    <span>原价：</span><i>￥</i><del><?php echo $data['exchange']->price; ?></del>&nbsp;(<?php echo round(($data['exchange']->active_price/$data['exchange']->price)*10, 1)?>折)<br>
                </h3>
                <h3 class="border-top-dashed">
                    <span>销量：</span><b style="color:#cc0000;"><?php echo $data['exchange']->sale_num; ?></b> &nbsp;件<br/>
                    <?php if ($data['exchange']->goodscolor): ?>
                        <span class='goodcolor'>
                            <span>
                            选型：
                            </span>
                            <?php foreach ($data['exchange']->goodscolor as $key => $value): ?>
                    <a <?php if ($value['gdcolornum']==0) {echo "class='be' stock='0' ";} else {echo 'stock='.$value["gdcolornum"].''. ' sclor='.$value["gdcolorname"].'';}?>  href="javascript:void(0)"><?php echo $value['gdcolorname']."({$value['gdcolornum']})";?></a>
                    <?php endforeach;?>
                        </span>
                    <?php endif; ?>
                    <span>数量：</span>
                        <?php 
                        $leftNum = $data['exchange']->num - $data['exchange']->sale_num;
                        echo CHtml::textField("Exchange[buyCount]",$data['exchange']->buyCount,['id'=>'num','limitNum'=>$leftNum]); 
                        echo Chtml::link("+","javascript:",['class'=>'jiahao']);
                        echo Chtml::link("-","javascript:",['class'=>'jianhao']);
                        ?>
                    <br>
                </h3>
                <h4>
                    <?php echo CHtml::hiddenField("gdcolor", '', array('id' => 'gdcolor')); ?>
                    <?php echo CHtml::hiddenField("id", $params['goodsId']); ?>
                    <?php echo CHtml::hiddenField("goods_type", $data['exchange']->goods_type); ?>
                    <input class="btn" type="submit" value=""><span></span>
                    <a class="hasbd" href="javascript:void(0);"><?php echo $data['exchange']->user_count ?>人已兑换</a>
                    <em>(当前库存<b><?php
                            echo $leftNum > 0 ? $leftNum : 0;
                            ?></b>件)</em>
                </h4>
            </div>
        </form>
        <?php
        $page = Yii::app()->request->getQuery("page");
        ?>
        <div class="J_TabBarWrap clear l">
            <ul class="tb-tabbar">
                <li id="exchangerule" class=' <?php echo empty($page) ? "selected" : ""; ?>'>
                    <a href="javascript:void(0)" hidefocus="true">兑奖规则</a>
                </li>
                <li id="recordstab" class='<?php echo!empty($page) && $page > 0 ? "selected" : ""; ?>'>
                    <a href="javascript:void(0)" hidefocus="true">兑换记录(<em><?php echo $data['logList']['pager']->getItemCount(); ?></em>)</a>
                </li>
            </ul>
        </div>

        <div class="l displayIF exchangerule <?php echo empty($page) ? "" : "hid"; ?>" id="">
            <div class="topinfo"></div>
            <div class="blockCJ ">
                <strong>兑换礼品规则</strong>
                1、活动开始后，所有注册会员均可点击“我要兑换”按钮进行礼品兑换       <br>
                2、为了更好的回馈美品网会员，所有礼品不收取任何费用，我们包邮为您送到家      <br>
                3、兑换礼品需要花费相应的积分，积分不足不能兑换      <br>
                4、一旦兑换即扣除相应积分，所兑换的礼品将在后台审核后发出。如审核过程中发现该用户积分行为异常，兑换礼品将不予发放，已扣除积分不退还。如该用户恶意积分行为严重，我们保留不另行通知而直接封禁该用户账号的权利。<br>

                <strong>注意事项</strong>
                1、美品网内部员工禁止参加积分兑换中的任何兑换活动      <br>
                2、数量有限，请先登录账号再进行兑换，这样才能快人一步      <br>
                3、请准确填写<a target="_blank" href="<?php echo Yii::app()->createUrl('user/address'); ?>">收货地址</a>和电话,如因填写的地址或电话有误导致的快递丢失,积分不退    <br>
                4、积分兑换中的礼品，一经换出不予退换<br>
                5、美品网有权在活动未开始前对活动信息进行更改，活动信息以兑换活动开始后的为准。
            </div>
        </div>
        <div class="l  displayIF recordstab <?php echo!empty($page) && $page > 0 ? "" : "hid"; ?>" id="records" >
            <div class="topinfo"></div>
            <div class="uslist">
                <?php
                $this->renderPartial('exchangeLogList', array('logList' => $data['logList'], 'goodsType' => $data['exchange']->goods_type));
                ?>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(function () {
        try {
            $(".tb-tabbar").find("li").click(function () {
                $(".tb-tabbar").find("li").removeClass("selected");
                $(this).addClass("selected");
                $(".displayIF").addClass('hid');
                $("." + $(this).attr("id")).removeClass("hid");
            });
        } catch (e) {
            alert(e);
        }
     $('.goodcolor').find("a").click(function () {

         gdcolornum = $(this).attr("stock");
         if (gdcolornum!=0) {
            $(".goodcolor a").attr("style",'');
            //gdcolor = $(this).html(); //颜色
            gdcolor = $(this).attr("sclor");
            $(this).attr("style","border: 2px solid red");
            $("#gdcolor").val(gdcolor);
         }
     });
    });
  function checkcolor () 
  {
      if($("#gdcolor").val() == '')
      {
        alert('请选择一个型号');
        return false;
      }
      return true;
  }
</script>