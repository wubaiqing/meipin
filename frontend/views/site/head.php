<div id="t-header">
    <div id="t-area">
    <h1 class="l">
        <a href="http://www.meipin.com/"><img src="/static/images/logo.gif" height="45" width="250"></a>
    </h1>
    <div class="search">
        <form target="_self" action="<?php echo $this->createUrl('search/index');?>">
        <input type="text" name="title" class="txt" value="<?php if(isset($_GET['title'])){echo $_GET['title'];}?>">
        <input type="submit" value="" class="smt">
            </form>
        </div>
    <div class="links">
        <i class="tmall"></i>
        <i class="lowest"></i>
        <i class="check"></i>
    </div>
    </div>
</div>
