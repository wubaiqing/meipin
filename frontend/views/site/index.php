<div id="header">
    <?php $this->renderPartial('prompt'); ?>
    <?php $this->renderPartial('head'); ?>
    <?php $this->renderPartial('nav'); ?>
</div>

<div id="content" class="wp">
    <?php $this->renderPartial('menu'); ?>
    <?php $this->renderPartial('menuWp'); ?>
    <?php $this->renderPartial('content'); ?>
    <?php $this->renderPartial('page'); ?>
</div>

<div class="side_nav">
    <?php $this->renderPartial('side'); ?>
</div>

<div id="footer" class="footer">
    <?php $this->renderPartial('footer'); ?>
</div>
