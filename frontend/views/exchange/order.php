<div id="header">
    <?php $this->renderPartial('//site/prompt'); ?>
    <?php $this->renderPartial('//site/login'); ?>
    <?php $this->renderPartial('//site/head'); ?>
    <?php $this->renderPartial('//site/nav', array('cat' => 0)); ?>
</div>

<div id="confirm_exchange" class="exchange area">
    <div id="address" class="address ">
        <h2><span></span>收货人信息</h2>
        <div class="toptxt">
            <p>
                <?php echo $data->userAddress->province->city_name . "-" . $data->userAddress->city->city_name . $data->userAddress->address; ?>
            </p>
            <p>
                <a class="modify_address" href="javascript:void(0)" address_id="<?php echo Des::encrypt($data->userAddress->id); ?>">修改收货地址</a>
            </p>
        </div>
        <ul class=" ulbor modify_form" style="display:none;">
            <form accept-charset="UTF-8" action="/profile/address/28008" data-remote="true" method="post">
                <div style="margin:0;padding:0;display:inline">
                    <input name="utf8" type="hidden" value="✓">
                    <input name="_method" type="hidden" value="put">
                    <input name="authenticity_token" type="hidden" value="SHVx8KPwqtNhU3cDANmmmpahohXHTv/vPXXoA9iLS/o=">
                </div>
                <li>
                    <label><em>*</em>真实姓名：</label>
                    <input id="address_consignee_name" name="address[consignee_name]" size="30" type="text" value="额鹅鹅鹅">
                </li>
                <li>
                    <label><em>*</em>省/市/区：</label>
                  <!--  <select id="sel_province">
                        <option value="-1">请选择省</option><option value="110000">北京</option><option value="120000">天津</option><option value="130000">河北省</option><option value="140000">山西省</option><option value="210000">辽宁省</option><option value="220000">吉林省</option><option value="230000">黑龙江省</option><option value="310000">上海</option><option value="320000">江苏省</option><option value="330000">浙江省</option><option value="340000">安徽省</option><option value="350000">福建省</option><option value="360000">江西省</option><option value="370000">山东省</option><option value="410000">河南省</option><option value="420000">湖北省</option><option value="430000">湖南省</option><option value="440000" selected="selected">广东省</option><option value="450000">广西壮族自治区</option><option value="460000">海南省</option><option value="500000">重庆</option><option value="510000">四川省</option><option value="520000">贵州省</option><option value="530000">云南省</option><option value="610000">陕西省</option><option value="640000">宁夏回族自治区</option></select>
                    <select value="-1" id="sel_city"><option value="-1">请选择市</option><option value="440100">广州市</option><option value="440200">韶关市</option><option value="440300">深圳市</option><option value="440400">珠海市</option><option value="440500">汕头市</option><option value="440600">佛山市</option><option value="440700">江门市</option><option value="440800">湛江市</option><option value="440900">茂名市</option><option value="441200" selected="selected">肇庆市</option><option value="441300">惠州市</option><option value="441400">梅州市</option><option value="441500">汕尾市</option><option value="441600">河源市</option><option value="441700">阳江市</option><option value="441800">清远市</option><option value="441900">东莞市</option><option value="442000">中山市</option><option value="445100">潮州市</option><option value="445200">揭阳市</option><option value="445300">云浮市</option></select>
                    <select value="-1" id="span_town"><option value="-1">请选择县/区</option><option value="441202">端州区</option><option value="441203">鼎湖区</option><option value="441223" selected="selected">广宁县</option><option value="441224">怀集县</option><option value="441225">封开县</option><option value="441226">德庆县</option><option value="441283">高要市</option><option value="441284">四会市</option><option value="441285">其它区</option></select>-->
                </li>
                <li id="sel_val" style="visibility: hidden; display: none;">
                    <input type="hidden" name="address[province]" value="广东省" code="440000">
                    <input type="hidden" name="address[city]" value="肇庆市" code="441200">
                    <input type="hidden" name="address[area]" value="广宁县" code="441223">
                </li>
                <li>
                    <label><em>*</em>详细地址：</label>
                    <input class="wid1" id="address_address_info" name="address[address_info]" size="30" type="text" value="的功夫的故事">
                </li>
                <li>
                    <label>手机号码：</label>
                    <input id="address_phone_number" name="address[phone_number]" size="30" type="text" value="13666666666">
                </li>
                <li>
                    <label>或电话号码：</label>
                    <input class="wid2 ph_1" id="address_area_code" name="address[area_code]" size="30" type="text"><i>-</i><input class="ph_2" id="address_phone" name="address[phone]" size="30" type="text"><i>-</i><input class="ph_3" id="address_ext" name="address[ext]" size="30" type="text">
                </li>
                <li>
                    <label>&nbsp;</label><em class="colf0">提示：手机和电话至少填写一项</em>
                </li>
                <li>
                    <label>QQ号：</label>
                    <input id="address_qq_number" name="address[qq_number]" size="30" type="text" value="">
                </li>
                <li>
                    <label>&nbsp;</label><em class="colf0">提示：如抽中Q币请填写您的QQ号，以便进行发放</em>
                </li>
                <li>
                    <label>邮政编码：</label>
                    <input id="address_zipcode" name="address[zipcode]" size="30" type="text" value="100029">
                </li>
                <li class="tj">
                    <label>&nbsp;</label>
                    <input class="btn" type="submit" value="">
                </li>

            </form>  </ul>

    </div>
    <div class="paycls">
        <h2><span></span>支付及配送方式</h2>
        <p>
            <em>0元包邮</em>
            <strong>1.</strong>为了更好的回馈折会员，所有礼品不收取任何费用，我们包邮为您送到家<br>
            <strong>2.</strong>由于参与兑换的人数较多，工作人员会在兑换成功后的15-20个工作日内将礼品发出<br>
            <strong>3.</strong>兑换成功后您可以到 <strong>个人中心</strong> &gt; <strong>我的礼品</strong> 中根据快递单号查看您的订单配送情况
        </p>
    </div>
    <div class="confcls">
        <h2><span></span>确认订单信息</h2>
        <form accept-charset="UTF-8" action="<?php echo Yii::app()->createUrl("exchange/doExchange"); ?>" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓"><input name="authenticity_token" type="hidden" value="SHVx8KPwqtNhU3cDANmmmpahohXHTv/vPXXoA9iLS/o="></div>
            <div class="gift">
                <p><span>礼品详情</span><span>花费积分</span></p>
                <div class="">
                    <dl class="ginfo">
                        <dt>
                        <?php
                        echo CHtml::hiddenField("Order['goods_id']", Des::encrypt($data->exchange->id));
                        $goodsUrl = Yii::app()->createUrl('exchange/exchangeIndex', array('id' => Des::encrypt($data->exchange->id)));
                        ?>
                        <a href="<?php echo $goodsUrl; ?>" target="_blank">
                            <img src="<?php echo $data->exchange->img_url; ?>">
                        </a>
                        </dt>
                        <dd>
                            <span class="maxh40"><a target="_blank" href="<?php echo $goodsUrl; ?>"><?php echo $data->exchange->name; ?></a></span>
                            <input id="id" name="Exchange[id]" type="hidden" value="<?php echo Des::decrypt($data->exchange->id); ?>">
                        </dd>
                    </dl>
                    <dl class="jifn">
                        <dt><em><?php echo $data->exchange->integral; ?></em><span></span></dt>
                        <dd>提示：兑换礼品后您将减少<?php echo $data->exchange->integral; ?>积分，一旦兑换成功，积分将不退还！请确定喜欢此礼品再兑换</dd>
                    </dl>
                </div>
            </div>
            <div class="jadinfo" data-must_memo="0" data-memo="">
                <span>备注信息：<input id="memo" name="Order['remark']" type="text"></span>
                <input class="welfare_btn" type="submit" value="">
            </div>
        </form>  
    </div>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
</div>

<?php $this->renderPartial('//site/side'); ?>
<div id="footer" class="footer">
    <?php $this->renderPartial('//site/footer'); ?>
</div>
