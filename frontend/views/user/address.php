<div id="content" class="wp">
    <div class="user_r r">
        <div class="box admin hei">
            <h3>
                <span>收货地址修改</span>
            </h3>
            <span class="t_l"></span>
            <span class="t_r"></span>
            <div class="info">
                <h6>
                    <a href="<?php echo $this->createUrl('user/info');?>">用户信息</a>|
                    <a href="<?php echo $this->createUrl('user/address');?>" class="current">收货地址修改</a>|
                    <a href="<?php echo $this->createUrl('user/password');?>">修改密码</a>
                </h6>
                <form action="/user/address.html" method="post">
                    <table cellspacing="1" cellpadding="0" border="0" bgcolor="#DFE2E7" class="table_user">
                        <tbody>
                            <tr align="center">
                                <td bgcolor="#F9FAFC" align="right">收货人姓名：</td>
                                <td height="32" align="left"><input type="text" value="" id="consignee_name" name="consignee_name" class="text"><em>*您的收货姓名</em></td>
                            </tr>
                            <tr align="center">
                                <td bgcolor="#F9FAFC" align="right">联系电话：</td>
                                <td height="32" align="left"><input type="text" class="text" value="" id="phone_number" name="phone_number"><em>*收货时快递联系电话，很重要。</em></td>
                            </tr>
                            <tr align="center" class="color">
                                <td bgcolor="#F9FAFC" align="right">收货地址：</td>
                                <td height="32" align="left"><select id="J_province" name="province"><option value="北京">北京</option><option value="上海">上海</option><option value="重庆">重庆</option><option value="安徽">安徽</option><option value="福建">福建</option><option value="甘肃">甘肃</option><option value="广东">广东</option><option value="广西">广西</option><option value="贵州">贵州</option><option value="海南">海南</option><option value="河北">河北</option><option value="黑龙江">黑龙江</option><option value="河南">河南</option><option value="香港">香港</option><option value="湖北">湖北</option><option value="湖南">湖南</option><option value="江苏">江苏</option><option value="江西">江西</option><option value="吉林">吉林</option><option value="辽宁">辽宁</option><option value="澳门">澳门</option><option value="内蒙古">内蒙古</option><option value="宁夏">宁夏</option><option value="青海">青海</option><option value="山东">山东</option><option value="山西">山西</option><option value="陕西">陕西</option><option value="四川">四川</option><option value="台湾">台湾</option><option value="天津">天津</option><option value="新疆">新疆</option><option value="西藏">西藏</option><option value="云南">云南</option><option value="浙江">浙江</option><option value="海外">海外</option></select>&nbsp;&nbsp;<select id="J_city" name="city"><option value="东城">东城</option><option value="西城">西城</option><option value="崇文">崇文</option><option value="宣武">宣武</option><option value="朝阳">朝阳</option><option value="丰台">丰台</option><option value="石景山">石景山</option><option value="海淀">海淀</option><option value="门头沟">门头沟</option><option value="房山">房山</option><option value="通州">通州</option><option value="顺义">顺义</option><option value="昌平">昌平</option><option value="大兴">大兴</option><option value="平谷">平谷</option><option value="怀柔">怀柔</option><option value="密云">密云</option><option value="延庆">延庆</option></select>&nbsp;&nbsp;<input type="text" class="text" style="width:250px;" id="address_info" name="address_info" value=""><em>*请确认快递能否寄到</em></td>
                            </tr>
                            <tr align="center" class="color">
                                <td bgcolor="#F9FAFC" align="right">邮编：</td>
                                <td height="32" align="left"><input type="text" class="text" value="" id="zipcode" name="zipcode"></td>
                            </tr>
                            <tr align="center" class="color">
                                <td height="32" colspan="2"><input type="submit" class="submit" value="提交"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <p class="b_tit">请详细填写收货地址，因为收货地址信息而导致的退货，我们将不退还积分。</p>
            </div>
        </div>
    </div>
    <span class="clear"></span>
</div>
