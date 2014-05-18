<?php
// 去掉必填项kk
CHtml::$afterRequiredLabel = '';
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'score-form',
    'method' => 'post',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    ),
    'action' => Yii::app()->createUrl("exchange/ajaxShipUpdate", array('id' => $model->id)),
        ));
CHtml::$errorSummaryCss = 'text-warning';
?>
<?php echo $form->errorSummary($model); ?>
<style type="text/css">
    .v_table_con {
        width: 98%;
        margin: 10px auto 0px;
        margin-left: 20px;
        border: 0;
    }
    .v_table_label{
        text-align: right;
        vertical-align: top;
        width: 0px;
        color: #666;
        word-wrap: break-word;
        padding: 15px;
    }
    .v_table_line{border-bottom: 1px solid #e5e5e5;width: 100%;text-align: center;font-weight: bold;font-size: 16px;}
    .userCity,.userProvice{width:100px;}
</style>
<table border="0" class="v_table_con">
    <tr>
        <td colspan="2"  class='v_table_line'>商品信息</td>
    </tr>
    <tr>
        <td class="v_table_label">淘宝ID：</td>
        <td>
            <?php echo!empty($model->exchange->taobao_id) ? $model->exchange->taobao_id : ""; ?>
        </td>
    </tr>
    <tr>
        <td class="v_table_label">商品标题：</td>
        <td>
            <?php
            echo $model->exchange->name;
            ?>
        </td>
    </tr>
    <?php if (!empty($model->exchange->taobaoke_url)): ?>
        <tr>
            <td class="v_table_label">链接：</td>
            <td>
                <a href="<?php echo $model->exchange->taobaoke_url; ?>" target="_blank"><?php echo $model->exchange->taobaoke_url; ?></a>
            </td>
        </tr>
    <?php endif; ?>
    <?php
    $province = City::getByParentId(0);
    $provinceId = City::getProvinceId($model->city_id);
    $model->province = $provinceId;
    $city = City::getCityList($provinceId);
    ?>
    <tr class='v_table_line'>
        <td colspan="2">兑换详情</td>
    </tr>
    <tr>
        <td class="v_table_label">兑换时间：</td>
        <td>
            <?php echo date("Y-m-d H:i:s", $model->created_at); ?>
        </td>
    </tr>
    <tr class="exchange_detail">
        <td class="v_table_label">收货人姓名：</td>
        <td>
            <?php echo $form->textField($model, 'name', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
    <tr class="exchange_detail">
        <td class="v_table_label">联系电话：</td>
        <td>
            <?php echo $form->textField($model, 'mobile', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
    <tr class="exchange_detail">
        <td class="v_table_label">邮编：</td>
        <td>
            <?php echo $form->textField($model, 'postcode', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
    <tr class="exchange_detail">
        <td class="v_table_label">备注信息：</td>
        <td>
            <?php echo $form->textField($model, 'remark', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
    <tr class="exchange_detail">
        <td class="v_table_label">收货地址：</td>
        <td>
            <?php echo $form->dropDownList($model, 'province', $province, array('class' => 'userProvice', 'id' => 'userProvince', 'empty' => '请选择', 'disabled' => 'disabled')); ?>
            &nbsp;&nbsp;
            <?php echo $form->dropDownList($model, 'city_id', $city, array('class' => 'userCity', 'id' => 'userCity', 'empty' => '请选择', 'disabled' => 'disabled')); ?>
            <br/><br/>
            <?php echo $form->textArea($model, 'address', array('disabled' => 'disabled', 'maxLength' => '100')); ?>
        </td>
    </tr>
    <tr class="">
        <td class="v_table_label">&nbsp;</td>
        <td>
            <?php echo CHtml::button("编辑", array('class' => 'btn btn-primary save', 'id' => 'edit')); ?>
        </td>
    </tr>
    <?php echo $form->hiddenField($model, 'id'); ?>
    <?php echo CHtml::hiddenField("formType", 'address'); ?>
    <?php
    $this->endWidget();
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'status-form',
        'method' => 'post',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'form-horizontal',
        ),
        'action' => Yii::app()->createUrl("exchange/ajaxShipUpdate", array('id' => $model->id)),
    ));
    ?>
    <tr class='v_table_line'>
        <td colspan="2">操作状态</td>
    </tr>
    <tr>
        <td class="v_table_label">发货状态：</td>
        <td>
            <?php echo CHtml::hiddenField("formType", 'status'); ?>
            <?php echo $form->hiddenField($model, 'id'); ?>
            <?php echo $form->dropDownList($model, 'status', ExchangeLog::$status, array()); ?>
            <?php echo CHtml::button("修改", array('class' => 'btn btn-primary save', 'id' => 'status_edit')); ?>
        </td>
    </tr>
</table>
<?php
$this->endWidget();
?>

<script>
    $(function() {
        $("#edit").click(function() {
            var input = this;
            if ($(this).val() == "编辑") {
                $(".exchange_detail").find("input,select,textarea").attr("disabled", false);
                $(this).val("保存")
            }
            else if ($(this).val() == "保存") {
                var url = $("#score-form").attr("action");
                var params = $("#score-form").serialize();

                $("#score").remove();
                $(input).after("<span id='score' style='color:red;'>请稍等...</span>");

                $.post(url, params, function(d) {
                    $(".exchange_detail").find("input,select,textarea").attr("disabled", true);
                    $(input).val("编辑")
                    $("#score").remove();
                    $(input).after("<span id='score' style='color:red;'>" + d.data.message + "</span>");
                });
            }
        });

        $("#status_edit").click(function() {
            var input = this;
            var url = $("#status-form").attr("action");
            var params = $("#status-form").serialize();

            $("#status").remove();
            $(input).after("<span id='status' style='color:red;'>请稍等...</span>");

            $.post(url, params, function(d) {
                $("#status").remove();
                $(input).after("<span id='status' style='color:red;'>" + d.data.message + "</span>");
            });
        });

    });
</script>
