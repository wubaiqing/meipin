			function getBrowser(){
				var OsObject = "";
				if (navigator.userAgent.indexOf("MSIE") > 0) {
					return "MSIE";
				}
				if (isFirefox = navigator.userAgent.indexOf("Firefox") > 0) {
					return "Firefox";
				}
				if (isSafari = navigator.userAgent.indexOf("Safari") > 0) {
					return "Safari";
				}
				if (isCamino = navigator.userAgent.indexOf("Camino") > 0) {
					return "Camino";
				}
				if (isMozilla = navigator.userAgent.indexOf("Gecko/") > 0) {
					return "Gecko";
				}
			}


			function load_item_display(){
				var $ni=parseInt($("#pbl").attr("ni"));
				if($ni<$item_json_encode_count){
					$.each($item_json_encode[$ni],function($i,$item){
						$html=getDeal($item);
						$("#pbl").append(getDeal($item));
					});
					$("#pbl").attr("ni",parseInt($ni)+1);
				}
			}

			function getDeal($item){
				$html="<li ";
				if($item['jssj']<$item['dqsj'] || $item['yjjs']==1){
					$html+=" class='over'";
				}else{
					$html+=" class='time'";
				}
				$html+=">";
				$html+="<a title='"+$item['bt']+"' target='_blank' href='"+$item['lj']+"' class='on'>";
				$html+="<img src='"+$item['tpdz']+"' alt='"+$item['bt']+"'";
				if($item['tpsx']==0){
					$html+=" height='190' style='padding:58px 0px 53px 7px;' align='center' valign='middle'";
				}
				$html+=" width='290' height='290' />";
				$html+="<div class='price'><div class='fl jiage_l'><span class='new_price'><em>￥</em>"+Math.floor($item['zkjg'])+".<em>";
				$html+=$item['zkjgxsd']+"</em></span>";
				$html+="("+$item['zk']+"折)</div>";
				$html+="<span class='btn fr'>去抢购</span>";
				$html+="</div>";
				if($item['jssj']<$item['dqsj'] || $item['yjjs']==1){
					$html+="<div class='over_tips'><p>该宝贝已经下架</p>点击继续前往店铺</div>";
				}
				$html+="</a>";
				if($item['ssp']=="new"){
					$html+="<i></i>";
				}
				$html+="<i class='baoyou'></i><i class='jifen'></i>";
				if($item['zkjg']>9.9){
					$html+="<a href='/tttj/detail/"+$item['id']+".html' class='a' target='_blank'><strong>【"+$item['fl']['name']+"】</strong>"+$item['bt'].replace("多数地区包邮","");
				if($item['by']==1){
					$html+=" 多数地区包邮";
				}
				$html+="</a>";
				}else{
					$html+="<a href='/baoyou/detail/"+$item['id']+".html' class='a' target='_blank'><strong>【"+$item['fl']['name']+"】</strong>"+$item['bt'].replace("多数地区包邮","");
				if($item['by']==1){
					$html+=" 多数地区包邮";
				}
				$html+="</a>";
				}
				$html+="<a onclick='u_report("+$item['id']+");' id='"+$item['id']+"' href='javascript:;' style='cursor:pointer;' alt='"+$item['jblj']+"'  title='成功举报可获得1积分奖励！' class='aa' target='_blank'>举报</a>";
				$html+="</li>";
				return $html;
			}