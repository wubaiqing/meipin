<div class="box">
    <h3 class="box-header">查看分类</h3>
    <?php
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'attributes' => array(
                'id',
                'name',
                array(
                    'name' => 'parent_id',
                    'value' => $model->parent ? $model->parent->name : '无',
                ),
            ),
        ));
    ?>
</div>
