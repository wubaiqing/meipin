<div class="area about">
    <div class="mid">
        <dl class="dl1">
            <dt>        关于美品        </dt>
            <dd><a href="javascript:;" target="_blank">美品</a></dd><dd><a href="javascript:;" target="_blank">9块9包邮</a></dd><dd><a href="javascript:;" target="_blank">所有商品</a></dd><dd><a href="javascript:;" target="_blank">商品API</a></dd>
        </dl>
        <dl class="dl2">
            <dt>        帮助中心        </dt>
            <dd><a href="javascript:;">积分攻略</a></dd><dd><a href="javascript:;">购物拿积分</a></dd><dd><a href="javascript:;">VIP品牌折扣价</a></dd><dd><a href="javascript:;">9块9包邮价</a></dd>
        </dl>
        <dl class="dl2">
            <dt>        商务合作        </dt>
            <dd><a href="javascript:;">美品商家合作</a></dd><dd class="taowenwidls"><a  href="javascript:;">品牌折扣合作</a></dd><dd><a href="javascript:;" target="_blank">友情链接</a></dd>
        </dl>
        <dl class="dl4">
            <dt>      关注美品      </dt>
            <dd><a href="javascript:;" target="_blank">美<strong>品</strong>新浪微博</a></dd><dd><a href="javascript:;" target="_blank">美<strong>品</strong>腾讯微博</a></dd><dd><a href="javascript:;">下载快捷方式到桌面</a></dd><dd><a href="javascript:;" title="意见反馈" target="_blank">意见反馈</a></dd>
        </dl>
        <dl class="dl5">
            <dt>下次怎么来?</dt>
            <dd>记住域名：<a href="javascript:;"><em>meipin.com</em></a></dd><dd>百度搜索：<input type="text" value="美品" onfocus="this.blur()" class="bdtxt"><a href="http://www.baidu.com/s?tn=baiduhome_pg&ie=utf-8&bs=%E7%BE%8E%E5%93%81&f=8&rsv_bp=1&rsv_spt=1&wd=%E7%BE%8E%E5%93%81&inputT=0" target="_blank" class="smt"></a></dd><dd>收藏本站：<a href="javascript:void(0)" onclick="javascript:addToFavorite();"><u>加入收藏</u></a></dd>
        </dl>
        <dl class="dl3">
            <dt>手机客户端</dt>
            <dd class="sub"><img src="/assets/images/wxcode.png" alt="">
            <div class="info">
                <p>
                    关注美品网，秒杀早知道
                </p>
                <p>
                    如何关注？
                </p>
                <p>
                    1) 查找微信号“<em>meipin</em>”<br>
                    2) 用微信扫描左侧二维码
                </p>
            </div>
            </dd>
        </dl>
    </div>
    <div class="footer_yq_div">
        <h3 class="footer_yq_h3 fl"><a href="javascript:;" target="_blank">友情链接</a></h3>
        <?php
            $links = Links::getLink();
            foreach ($links as $link) :
        ?>
        <a target="_blank" class="youq_a" href="<?php echo $link->url;?>" title="<?php echo $link->image_url;?>"><?php echo $link->image_url;?></a>
        <?php endforeach; ?>
    </div>
</div>
