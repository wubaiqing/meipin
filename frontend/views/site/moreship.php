<link rel="stylesheet" type="text/css"  href="/static/moreship.css?v=201404131000" />
<style>
.footer {}
</style>
<div id="wrap_ship" style="height:630px">
    <h3>友情链接</h3><br/>
    <div id="main_ship">
        <?php
        $links = Links::getLink();
        $linknum = count($links);
        ?>
        <div id="lianjie">
            <ul>
                <?php if($linknum <=7):?>
                   <?php for ($i=0; $i <$linknum ; $i++) {?>
                     <li><a href="<?php echo $links[$i]->url;?>" target='_blank'><?php echo $links[$i]->image_url;?></a></li>
                    <?php }?>
                <?php endif;?>
                <br>
            </ul>
        </div>
        <?php if($linknum >7 && $linknum<=14):?>
        <div id="lianjie">
            <ul>
                <?php for ($i=7; $i <$linknum ; $i++) {?>
                     <li><a href="<?php echo $links[$i]->url;?>" target='_blank'><?php echo $links[$i]->image_url;?></a></li>
                    <?php }?>

                <br>
            </ul>
        </div>
       <?php endif;?>

    </div>

    <div id="shenqing">
        <h3>友链申请</h3>
        <p>衷心感谢您对本站的关注和支持，本站欢迎与各优秀网站交换友情链接，以达到互为推广，共同提高网站竞争力的目的。</p>
        <p>友链申请步骤：(暂时只接受文字链接申请)</p>
        <p>1.请先在贵站做好美品网的文字链接：</p>
        <p>链接文字：美品网</p>
        <p>链接地址： http://www.meipin.com/</p>
        <p>2.做好链接后，将贵网站的网站名称、网站地址、联系方式等信息通过Email:534095228@qq .com 提交给我们！(本邮箱只负责友情链接相关事宜)</p>
        <p>3.已经开通我站友情链接且内容键康，符合本站友情链接要求的网站，经美品管理员审核后，可以显示在此友情链接页面。</p>
    </div>
</div>
