<div>

<?php
$form = $this->beginWidget('CActiveForm');
?>
             <p>
                <em>好弄吗？：建议</em>
                <?php echo $form->textArea($model, 'advise', array('cols'=>'50' ,'rows'=>'8')); ?>
                <?php echo $form->error($model,'advise');?>  
            <p>
               <p>
                <em>qq：</em>
                <?php echo $form->textField($model, 'qq', array('class' => 'input_off')); ?>
                <?php echo $form->error($model,'qq');?>  
            <p>
            <p>
                <em>邮箱：</em>
                <?php echo $form->textField($model, 'email', array('class' => 'input_off')); ?>
                <?php echo $form->error($model,'email');?>  
            <p>
              <p>
                <em>&nbsp;</em>
                <input type="submit" value="登 录" class="submit">
            </p>
 <?php $this->endWidget(); ?>
</div>