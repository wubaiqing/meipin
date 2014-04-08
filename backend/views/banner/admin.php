<?php
CHtml::$afterRequiredLabel = '';
$form=$this->beginWidget('CActiveForm', array(
    'id' => 'category-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    )
));
CHtml::$errorSummaryCss = 'text-warning';
?>
<style>
    span{
        color: #ccc;
    }
</style>

<div class="box">
    <div>
        <h4 class="box-header">头部</h4>
        <label class="span1">链接：</label>
        <input name="Top[url]" id="name" type="text" value="<?php echo $top->url;?>" class="span3">
        </br>
        </br>
        <label class="span1">图片：</label>
        <input name="Top[picture]" id="name" type="text" value="<?php echo $top->picture;?>" class="span3">
        </br>
        </br>
        <label class="span1">宽度：</label>
        <input name="Top[width]" id="url" type="text" value="<?php echo $top->width;?>" class="span3">
        <span>px</span>
        </br>
        </br>
        <label class="span1">高度：</label>
        <input name="Top[height]" id="url" type="text" value="<?php echo $top->height;?>" class="span3">
        <span>px</span>
        </br>
        </br>
        <label class="span1">颜色：</label>
        <input name="Top[color]" id="url" type="text" value="<?php echo $top->color;?>" class="span3">
        <span>16进制RGB（0163d2）</span>
        </br>
        </br>
        <div style="display:block; width:60px; height:35px; background:#<?php echo $top->color;?>; float:left; margin-right:10px;"></div>
        <a href="<?php echo $top->url;?>" target="_blank"> <img src="<?php echo $top->picture;?>" width="600"/></a>
    </div>

    <div>
        <h4 class="box-header">底部</h4>
        <label class="span1">URL：</label>
        <input name="Footer[picture]" id="name" type="text" value="<?php echo $footer->picture;?>" class="span3">
        <span>宽度980高度不限</span>
        </br>
        </br>
        <img src="<?php echo $footer->picture?>" width="600"/>
        </br>
        </br>
        <input class="btn btn-danger" type="submit" value="保存">
    </div>
</div>
<?php $this->endWidget();?>
