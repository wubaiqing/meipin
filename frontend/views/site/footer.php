<div class="area about">
    <div class="mid">
        <dl class="dl1">
            <dt>        关于美品        </dt>
            <dd><a href="/site/about" target="_blank">关于我们</a></dd>
        </dl>
        <dl class="dl2">
            <dt>        帮助中心        </dt>
            <dd><a href="/site/connect">联系我们</a></dd><dd><a href="/feedback">意见反馈</a></dd>
        </dl>
        <dl class="dl2">
            <dt>        商务合作        </dt>
            <dd><a href="/site/bsrg" target="_blank">广告合作</a></dd><a href="/site/moreship" target="_blank">友情链接</a></dd>
        </dl>
        <dl class="dl4">
            <dt>      关注美品      </dt>
            <dd><a href="/site/xiazai">下载快捷方式到桌面</a></dd>
        </dl>
        <dl class="dl5">
            <dt>下次怎么来?</dt>
            <dd>记住域名：<a href="javascript:;"><em>meipin.com</em></a></dd><dd>百度搜索：<input type="text" value="美品网" onfocus="this.blur()" class="bdtxt"><a href="http://www.baidu.com/s?tn=baiduhome_pg&ie=utf-8&bs=美品网&f=8&rsv_bp=1&rsv_spt=1&wd=美品网&inputT=0" target="_blank" class="smt"></a></dd><dd>收藏本站：<a href="javascript:void(0)" onclick="javascript:addToFavorite();"><u>加入收藏</u></a></dd>
        </dl>
        <style type="text/css">
         /* .dl3 dl dd a{float: left;width: 38px;height: 52px;background: url('/static/images/icon_device_bottom_ie6.png') no-repeat scroll 0% 0% transparent;margin-right: 11px;} */
        </style>
        <dl class="dl3">
            <dt>手机客户端下载</dt>
            <!-- icon_device_bottom_ie6.png -->
            <dd class="sub">
            <a class="ios" target="_blank" href="<?php echo  $this->createUrl('site/phone');?>#iphone"></a>
            <a class="android" target="_blank" href="<?php echo  $this->createUrl('site/phone');?>#android"></a><br/>
            
            <img src="/static/images/qrcode_for_gh_fd42be538647_258.jpg" style="float:left">
            <p style="float:left">
            关注美品网，秒杀早知道
            <br/>如何关注？
            <br>
            1) 查找微信号“<em>meipin-com</em>”
            <br>
            2) 用微信扫描左侧二维码
            </p>
       
            </dd>
        </dl>
    </div>
    <div class="footer_yq_div">
        <h3 class="footer_yq_h3 fl"><a href="javascript:;" target="_blank">友情链接</a></h3>
        <?php
        $links = Links::getLink();
        foreach ($links as $link) :
            ?>
            <a target="_blank" class="youq_a" href="<?php echo $link->url; ?>" title="<?php echo $link->image_url; ?>"><?php echo $link->image_url; ?></a>
        <?php endforeach; ?>
       
    </div>
    <div style="float:right;margin-right:337px;margin-top:-18px;">京ICP备14018553号-1</div>
    <span style='display:none'><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1000462720'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1000462720%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script></span>
</div>
