<?php
$form = $this->beginWidget('CActiveForm');
?>
<div id="wrap">
    <p>欢迎提出您的宝贵意见和建议！您的意见我们会认真考虑并采纳。<br>如果您有什么想淘的宝贝，也可以跟我们说说，我们会帮您实现！</p>

        <div>
            <?php echo $form->textArea($model, 'advise', array('cols'=>'50' ,'rows'=>'8','value'=>'您的建议对我们非常重要，是支持我们的最大动力！')); ?>
            <br/>
             <?php echo $form->error($model,'advise',array('class'=>'f_advise'));?>
        </div>
        <div>
            <label><span>* </span>QQ号：</label>
             <?php echo $form->textField($model, 'qq',array('class'=>'input_off')); ?>
             <?php echo $form->error($model,'qq',array('class'=>'f_qq'));?>
        </div>
        <div>
            <label>邮  &nbsp;箱：</label>
          <?php echo $form->textField($model, 'email',array('class'=>'input_off')); ?>
          <?php echo $form->error($model,'email',array('class'=>'f_email'));?>
        </div>
    <p class="one">建议您留下邮箱，这将有助于我们及时对您提出的建议进行处理反馈</p>
        <div class="sub">
            <input type="submit" value="确定"/>
        </div>

    <p class="two">感谢您的关注和支持，我们会将美品网的服务做得更好！</p>
    <div></div>
    <div></div>
</div>
<?php $this->endWidget(); ?>
