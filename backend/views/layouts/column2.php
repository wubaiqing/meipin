<?php $this->beginContent('//layouts/main'); ?>
<div class="container-fluid">
    <div class="row-fluid btn-block" style="border-bottom:1px solid #ccc;">
    </div>
    <div class="row-fluid btn-block">
        <div class="span2 mt10">
            <ul class="nav nav-list pagination-centered">
                <?php foreach($this->menu as $key => $item): ?>
                <li class="nav-header"><h4><?php echo $item['label'];?></h4></li>
                <?php foreach($item['items'] as $key => $item): ?>
                <li><a href="<?php echo Yii::app()->createUrl($item['url']);?>"><?php echo $item['label'];?></a></li>
                <?php endforeach;?>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="span10">
            <?php echo $content; ?>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>
