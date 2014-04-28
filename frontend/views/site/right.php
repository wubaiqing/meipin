<script type="text/javascript">$(function(){	$backToTopFun = function() {		var $backToTopEle = $('#go_top');		var st = $(document).scrollTop(), winh = $(window).height();		(st > 0)? $backToTopEle.css('display','block'): $backToTopEle.css('display','none');		if (!window.XMLHttpRequest) {			$backToTopEle.css("top", st + winh - 40);		};	};	$(window).bind("scroll", $backToTopFun);	$backToTopFun();	$('#go_topa').click(function(){		$('html,body').animate({'scrollTop':0},200);		return false;	});});</script>
<div class="ju-rbar" id="go_top" style="display: block;">
    <ul>
        <a class="backtop J_BackToTop" id="go_topa" style="position:relative;" _hover-ignore="1"><i class="tip-back"></i></a>
    </ul>
</div>
