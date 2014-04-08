<?php $this->renderPartial('afp', array('banner' => $banner)); ?>
<div id="wrapper">
	<?php $this->renderPartial('head', array('cat' => $cat)); ?>
	<div id="body">
	<div class="main">
		<div class="infopage_bd">
			<div class="goods_show fl">

				<div class="goods-show">
					<div class="show_body" data-gid="15t70p">
						<!-- 商品标题信息 -->
						<p class="goods-title" style="color:#333; font-size:18px;"><?php echo $goods->title;?></p>
						<!-- 商品图片 -->
						<div class="img_show fl">
							<div class="show_big_wrap">
								<div class="show_bgimg">
									<a class="show_big" title="<?php echo $goods->title;?>">
										<img src="<?php echo $goods->picture;?>">
									</a>
								</div>
							</div>
							<div class="other-show">
								<div class="like no-like fl"></div>
								<div class="share-box fl">
									<span>分享</span>
									<div class="box">


										<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a><a title="分享到网易微博" href="#" class="bds_t163" data-cmd="t163"></a></div>
										<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","t163"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","t163"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=86835285.js?cdnversion='+~(-new Date()/36e5)];</script>

									</div>
								</div>
							</div>
						</div>
						<!-- 商品相关信息 -->
						<div class="body_info fl">
							<div class="center_detail">
								<div class="body_link">
									<div class="buy-action">
										<em class="dujia-icon"></em>
										<p class="price_tag buy-t">
											<span class="price" style="margin-left:0px;"><em>￥</em><?php echo $goods->price;?></span>
											<span class="cur-line">/</span>
											<span class="by">包邮</span>
											<a class="btn" target="_blank" href="<?php echo $goods->url;?>"></a>
											<div id="detailsButton" style="display:block; position: absolute; right:12px; top:21px;">
												<a data-type="0" biz-itemid="<?php echo $goods->tb_id;?>" data-tmpl="192x40" data-tmplid="625" data-rd="2" data-style="2" data-border="1" href="<?php echo $goods->url;?>"></a>
											</div>

											
										</p>
										<script>
											$('.btn').css('display', 'none');
											setTimeout(function () {
												var html = $('#detailsButton').html();
												if (html.indexOf('tkbox') == -1) {
													$('#detailsButton').css('display', 'none');
													$('.btn').css('display', 'block');
													$('.price').css('margin-left', '18px');
												}
											},2500);
										</script>
									</div>
									<div class="detail buy-t">
										<ul>
											<li>折扣<br><span class="discount"><?php echo number_format($goods->price / $goods->origin_price * 10, 1);?><em>折</em></span></li>
											<li>原价<br><span class="old-p"><em>￥</em><?php echo $goods->origin_price;?></span></li>
											<li class="last">现价<br><span class="cur-p"><em>￥</em><?php echo $goods->price;?></span></li>
										</ul>
									</div>
									<p class="time_tips">
										<span class="zhe_tips">开抢时间：<span class="zhe_time"><?php echo date('m月d日 h时i分', $goods->start_time);?></span></span>
									</p>
									<div class="relevant">
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>


				<div class="guess_like taeapp">
					<h3>猜你喜欢</h3>
					<div class="wrap area" style="width: 750px;">
						<?php for($i = 0; $i < 12; $i++){?>
						<?php if($i == 0 || $i == 4 || $i == 8 ) {?>
						<div class="left">
						<?php }?>
							<div class="mode">
								<p class="pic">
									<a href="<?php echo $guangCate[$i]->url?>" target="_blank">
										<img class="goods-item-img" data-url="<?php echo $guangCate[$i]->image;?>" src="<?php echo $guangCate[$i]->image;?>">
									</a>
								</p>
								<h3 class="tit"><span><a href="<?php echo $guangCate[$i]->url;?>" target="_blank"><?php echo $guangCate[$i]->title;?></a></span><em>￥<b><?php echo $guangCate[$i]->price;?></b></em></h3>
							</div>
						<?php if($i == 3 || $i == 7  || $i == 11) {?>
						</div>
						<?php }?>
						<?php }?>
					</div>
					<p class="more_goods"><a target="_blank" href="<?php echo $this->createUrl('site/guang', array('tagId' => 23))?>">查看更多内容</a></p>
				</div>
			</div>



			<div class="right_show fr">
				<div class="normal-show kind-show">
					<h3>同类爆款</h3>
					<ul class="same-goods-list">
						<?php foreach($goodsCate as $key => $val) :?>
						<li>
							<div class="pic">
								<a target="_blank" href="<?php echo $val->url;?>" title="<?php echo $val->title;?>">
									<img src="<?php echo $val->picture;?>" width="170px" >
								</a>
							</div>
							<p class="action-on"><span class="price"><em>￥</em><?php echo $val->price;?></span><span class="old-price"><em>￥</em><?php echo $goods->origin_price;?></span></p>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>



		</div>
	</div>

	<?php $this->renderPartial('share', array('cat' => $cat)); ?>
</div>







	<div id="footer">
		<?php $this->renderPartial('footer'); ?>
		<?php $this->renderPartial('fix'); ?>
	</div>
</div>

