<a href="<?php echo $this->createUrl('user/info');?>" <?php echo ($current == 'info') ? 'class="current"' : '';?> >用户信息</a>|
<a href="<?php echo $this->createUrl('user/address');?>" <?php echo ($current == 'address') ? 'class="current"' : '';?> >收货地址</a>|
<a href="<?php echo $this->createUrl('user/password');?>" <?php echo ($current == 'password') ? 'class="current"' : '';?>>修改密码</a>
