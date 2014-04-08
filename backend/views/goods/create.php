<div class="box">
    <h3 class="box-header">添加商品</h3>
    <?php $this->renderPartial(Goods::getRenderTemplate($type), array('model'=>$model)); ?>
</div>
