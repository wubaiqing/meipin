<div id="header">
    <?php $this->renderPartial('//site/prompt'); ?>
    <?php $this->renderPartial('//site/login'); ?>
    <?php $this->renderPartial('//site/head'); ?>
    <?php $this->renderPartial('//site/nav_person', array('cat' => 0)); ?>
</div>
<div id="content" class="wp">
     <div class="search">
          <div class="txt-tips">
          <p class="txt-img">纳尼？竟然木有“<?php echo $title;?>”宝贝~</p>
               <p class="txt">
               好吧，小编已经记录下这次的失败数据，并会尽快补充宝贝~<br>
           给小编点时间，先去浏览下 <a href="http://www.meipin.com">全部宝贝</a> 吧~
               </p>
          </div>
     </div>
</div>
<?php $this->renderPartial('//site/side'); ?>
<div id="footer" class="footer">
    <?php $this->renderPartial('//site/footer'); ?>
</div>
