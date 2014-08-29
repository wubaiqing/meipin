<?php
// 去掉必填项kk
CHtml::$afterRequiredLabel = '';
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'shai-form',
    'method' => 'post',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    ),
        ));
CHtml::$errorSummaryCss = 'text-warning';
?>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/My97DatePicker/WdatePicker.js"></script>
<?php
echo $form->errorSummary($shaiModel);

?>
<style type="text/css">input{width: 700px;}</style>
<div class="control-group">
    <?php echo $form->labelEx($shaiModel, 'goods_id', ['class' => 'control-label']); ?>
    <div class="controls">
        <?php echo $form->textArea($shaiModel, 'goods_id', ['maxlength' => 50]); ?>
        <label class="line-note">不是淘宝id是商品id</label>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($shaiModel, 'username', ['class' => 'control-label']); ?>
    <div class="controls">
        <?php echo $form->textArea($shaiModel, 'username', ['maxlength' => 50]); ?>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($shaiModel, 'content', array('class' => 'control-label')); ?>
    <div class="controls">
       <?php echo $form->textArea($shaiModel, 'content', ['class' => 'span5']); ?>
    </div>
</div>


<!-- 图片 -->
<?php if($shaiModel->isNewRecord): ?>
<div class="control-group">
    <div class="controls">
        <input type="button" value="添加" onclick="addRowToTable();" />
        <input type="button" value="删除" onclick="removeRowFromTable();" />
        _220x220.jpg
    </div>
</div>
<?php endif;?>
<div class="control-group">
    <?php echo $form->labelEx($shaiModel, 'img', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php if($shaiModel->isNewRecord): ?>
        <table border="1" id="tblSample">
        <tr>
        <th colspan="3">添加图片</th>
        </tr>
        <tr>
            <td>1</td>
            <td><input type="text" name="Shai[img][1]" id="img1" size="40" /></td>
        </table>
    <?php else:?>
        <?php echo $form->textArea($shaiModel, 'img',['style' => 'width:797px;height:148px;']);?>
    <?php endif;?>
    </div>
</div>

<!-- 图片 -->
<div class="control-group">
    <?php echo $form->labelEx($shaiModel, 'ptime', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        echo $form->textField($shaiModel, 'ptime', array(
            'onfocus' => "WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss', onpicking:function (dp) { $('#Shai_ptime').val(dp.cal.getNewDateStr()); dp.hide();}})",
            "class" => "Wdate",
            'value' => $shaiModel->ptime != 0 ? $shaiModel->ptime : $shaiModel->ptime,
            'readonly' => 'readonly',
        ));
        ?>
    </div>
</div>

<div class="form-actions">
    <?php
    echo CHtml::hiddenField("isChange", 0);
    echo CHtml::submitButton($shaiModel->isNewRecord ? '添加' : '修改', array('class' => 'btn btn-primary save'));
    ?>
</div>
<?php $this->endWidget(); ?>

<script>

function addRowToTable()
{
    var tbl = document.getElementById('tblSample');
    var lastRow = tbl.rows.length;
    // if there's no header row in the table, then iteration = lastRow + 1

    var iteration = lastRow;
    var row = tbl.insertRow(lastRow);
    // left cell

    var cellLeft = row.insertCell(0);
    var textNode = document.createTextNode(iteration);
    cellLeft.appendChild(textNode);
    // right cell

    var cellRight = row.insertCell(1);
    var el = document.createElement('input');
    el.type = 'text';
    el.name = 'Shai[img][' + iteration+']';
    el.id = 'img' + iteration;
    //el.onkeypress = keyPressTest;
    cellRight.appendChild(el);
}

//删除input框
function removeRowFromTable()
{
    var tbl = document.getElementById('tblSample');
    var lastRow = tbl.rows.length;
    if (lastRow > 2) tbl.deleteRow(lastRow - 1);
}
</script>
