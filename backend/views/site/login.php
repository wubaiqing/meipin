<div class="container">
    <div class="box span6 offset2" style="margin-top: 80px;">
        <form class="form-horizontal" action="<?php echo $this->createUrl('login'); ?>" method="post">

            <div class="control-group">

                <label class="control-label" for="name">帐号</label>
                <div class="controls">
                    <input type="text" id="name" name="name" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="password">密码</label>
                <div class="controls">
                    <input type="password" id="password" name="password" />
                </div>
            </div>
            <?php if(!empty($_GET['flag'])){?>
            <div class="control-group">
                <div class="controls">
                    <a style="color:red">用户名或密码错误</a>
                </div>
            </div>         
            <?php }?>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary">登录</button>
                </div>
            </div>
        </form>
    </div>
</div>
