<style>
@charset "utf-8";
/* CSS Document */
em,i{ font-style:normal}
body{background:url(/v1/ju/core/img/icon1.png) fixed repeat;min-width: 980px;}
a,a *{cursor: pointer;}

/* 浮动属性 */
.left,.center,.l,.right,.r{display:inline;float:left;}
.right,.r{float:right;}
.pp,.pt,.list12 ul,.list14 ul,.area{width:100%;margin:0 auto;}
.area{width:980px;}/*页面属性 */

/*icon*/
.icon-arrow{display:inline-block;*display:inline;*zoom:1;height:0;line-height: 0;width:0;vertical-align:middle;border-width:3px;border-style:solid;margin-left:3px;border-color:#CCC #FFF #FFF #FFF;_overflow:hidden;}

/*头*/
#toolbar{width:100%; background:#FFF;color:#333;line-height:23px;position:relative; z-index:998;font-family:\5B8B\4F53;padding-top:5px;}
.toolbar{ position:relative; z-index:100000;color: #D5D5D5;}
.toolbar .flow{overflow: hidden;margin-left:5px;_display:inline;}
.toolbar a.user{filter:alpha(opacity=100);opacity:1;}
.toolbar .l{position:relative;_padding-top:5px;width: 270px;text-align: left;white-space: nowrap;}
.toolbar .l .yqhy i{width:51px;height:18px;display:inline-block;background:url(/v1/2012/images/top_icon_2.png) no-repeat -36px 0;_background:url(/v1/2012/images/top_icon_2_ie6.png) no-repeat -36px 0;font-style: normal;text-align: center;line-height: 18px;color:#fff;}
.toolbar .l a{margin-right:10px;}
.toolbar .digtao{width:180px;height:52px;background:url(/v1/2012/images/top_icon_2.png) no-repeat -87px 0;_background:url(/v1/2012/images/top_icon_2_ie6.png) no-repeat -87px 0;position: absolute;right:145px;top:25px;}
.toolbar a{/*margin-right: 3px;*/filter:alpha(opacity=100);opacity:1;color:#666;*display:inline;*zoom:1;}
.toolbar a:hover{filter:alpha(opacity=100);opacity:1;color: #e02f2f;text-decoration: none;}
.toolbar .digtao a.clo{width:15px;height:15px;position: absolute;right:4px;top:9px;display: inline-block;}
.toolbar .digtao a.img{width:35px;height:35px;position: absolute;left:10px;top:11px;display: inline-block;}
.toolbar .digtao a.txt{position: absolute;left:53px;top:12px;font-size: 14px;}
.toolbar .right{color:#D5D5D5}
.toolbar .right span{color:#666;}
.toolbar #tblogin .user{color: #E12E2F;}
.toolbar .right em{color:#D5D5D5;}
/*.toolbar .right em .user{color:#cc0000;}*/
.toolbar .right em .maxuser{height: 30px;overflow: hidden;vertical-align: top;*vertical-align: middle;max-width: 180px;display: inline-block;}
.toolbar .right a.sina i,.toolbar .right a.qq i{background:url(/v1/ju/core/img/icon_log.png) no-repeat;display:inline-block;*display:inline;*zoom:1;width:20px;height:14px;vertical-align:text-bottom;*vertical-align:middle;}
.toolbar .right a.qq i{background-position:-20px 0;}
.toolbar .right a.sina{margin-left: 7px;}
.toolbar .right a.qq{opacity: 1;filter:alpha(opacity=100);}
/*下拉*/
.dropdown{display:inline-block;*display:inline;*zoom:1;position:relative;position:relative;border:1px solid transparent;border-bottom:none;_border:none;_padding-top: 5px;}
.dropdown.open{color:#e02f2f;background:#fff;border-bottom:none;*z-index:999;}
.dropdown .arrow-down{-webkit-transition:-webkit-transform ease .3s;-moz-transition:-moz-transform ease .3s;-webkit-transform-origin:3px 1.5px;-moz-transform-origin:3px 1.5px;}
.dropdown.open .arrow-down{border-color:#CCC #fff #fff #fff;-webkit-transform:rotate(180deg);-moz-transform:rotate(180deg);}
.dropdown-menu{border:1px solid #999;position:absolute;top:100%;min-width:100%;_width:100%;left:-1px;display:none;background:#fff;z-index:9999;text-align:left;}
.myzhe .dropdown-menu{left:-6px;}
.dropdown-menu li{line-height:24px;}
.dropdown.open .dropdown-menu{display:block;}
.dropdown-menu li a{color:#333;display:block;padding-left:8px;text-decoration:none;*width: 100%;}
.dropdown-menu li a:hover{background:#f0f0f0}
.dropdown.open a{color:#e02f2f}
.dropdown.open a:hover{_color: #e02f2f;}
.toolbar .dropdown.open a{filter:alpha(opacity=100);opacity:1;}
.toolbar .dropdown-menu a{color:#333;}
.web-focus{padding-bottom: 0px;position: relative;height:25px;*height: 32px;_height: 0px;}
.web-focus a{text-decoration: none;cursor: default;}
.web-focus .icon-mid{vertical-align:text-bottom;*vertical-align:middle;margin-right:5px;}
.web-focus a:hover{_color: #e02f2f;;}
.web-focus .dropdown-menu{padding-bottom:5px;_width:138px;_overflow:hidden;}
.web-focus .dropdown-menu a{color:#1582bd;*width: 112px;cursor: pointer;}
.web-focus .dropdown-menu li{padding-left:8px;}
.web-focus .dropdown-menu li iframe{margin:0;*display: block;}
.myzhe{margin:0 0 0 10px;}
.myzhe .dropdown-menu{*width: 68px;_top:19px;*overflow: hidden;_width:76px;}
.zhe_intro .dropdown-menu{*width:110px;*overflow: hidden}
.sign_panel .dropdown-menu{_top:35px;}
/*气泡提示*/
.tooltip{position:absolute;z-index:1000}
.tooltip .tooltip-arrow{position:absolute;width:11px;height:7px;z-index:999;margin-top:-1px;left:50%;margin-left:-5px;_overflow:hidden;}
.tooltip .tooltip-arrow{background:url(/v1/ju/core/img/arrow.png) no-repeat;}
.tooltip .tooltip-content{border:1px solid #c9c9c9;font-size:12px;background:#fffbeb;color:#666;padding:2px 10px;line-height:20px;position:relative;width:195px;text-align: left;}
.tooltip .tooltip-content a{color: #09c}
.tooltip .tooltip-content .close{background: url(/v1/ju/core/img/bdsj.png) no-repeat -202px -4px;position:absolute;width:10px;height:10px;cursor:pointer;top:2px;right:3px;_overflow:hidden;display:block;}

/*等级图标*/
.toolbar .right em .usz0,.toolbar .right em .usz1,.toolbar .right em .usz2,.toolbar .right em .usz3,.toolbar .right em .usz4,.toolbar .right em .usz5{display: inline-block;width: 20px;height: 20px;background: url(/v1/ju/core/img/tb_bg.png) no-repeat 1px -2px;vertical-align: middle; }
.toolbar .right em .usz1{background-position: -22px -2px;}
.toolbar .right em .usz2{background-position: -50px -2px;}
.toolbar .right em .usz3{background-position: -77px -2px;}
.toolbar .right em .usz4{background-position: -103px -2px;}
.toolbar .right em .usz5{background-position: -127px -2px;}

.toolbar .icon-level{filter:alpha(opacity=100);opacity:1;}
.icon-level{display:inline-block;*display:inline;*zoom:1;width:16px;height:12px;background:url(/v1/ju/core/img/tb_bg2.png) no-repeat;vertical-align:middle;margin:0 5px;}
.icon-level.level1{background-position:-30px 0;}
.icon-level.level2{background-position:-60px 0;}
.icon-level.level3{background-position:-90px 0;}
.icon-level.level4{background-position:-120px 0;}
.icon-level.level5{background-position:-150px 0;}

/*我的收藏*/
.toolbar .right .mco{display: inline-block;*display: inline;height:30px;width: 66px;margin: 0 3px;position: relative;vertical-align: top;*vertical-align: middle;}
.toolbar .right .mcoa{display: inline-block;height:28px;width: 54px;padding-right:10px;background:#f8f8f8 url(/v1/ju/core/img/tb_co.png) no-repeat -126px 5px;_background:#f8f8f8 url(/v1/ju/core/img/tb_co_ie6.png) no-repeat -126px 5px;border:1px solid #f8f8f8;}
.toolbar .right .mcoa:hover{color:#333;text-decoration: none;}
.toolbar .right .mco div{width: 390px;position: absolute;left:0;top:30px;background: #f8f8f8;display:none;padding-bottom: 3px;}
.toolbar .right .mco ul{border:1px solid #c9c9c9;text-align: left;}
.toolbar .right .mco ul li{height: 69px;background: #fff;border-bottom: 1px dotted #d8d8d8;color:#333;}
.toolbar .right .mco ul li img{width: 75px;height: 49px;float:left;}
.toolbar .right .mco ul li span{float:left;height: 49px;width: 200px;overflow: hidden;line-height: 16px;padding:10px 0 10px 10px;}
.toolbar .right .mco ul li span.w2,.toolbar .right .mco ul li span.w3{width: 60px;font-family: "微软雅黑";word-break:break-all;word-wrap:break-word;}
.toolbar .right .mco ul li span.w3{width: 60px;text-align: center;}
.toolbar .right .mco ul li span.w4{width: 15px;overflow: visible;}
.toolbar .right .mco ul li .w1 em{float:left;width: 118px;height: 48px;padding-left: 7px;overflow: hidden;}
a.coys,a.cotn{display: inline-block;width: 14px;height: 14px;background: url(/v1/ju/core/img/tb_co.png) no-repeat 0 -1px;_background: url(/v1/ju/core/img/tb_co_ie6.png) no-repeat 0 -1px;vertical-align: middle;}
a.coys:hover{background-position: -16px -1px;}
a.cotn{background-position: -31px -1px;}
a.cotn:hover{background-position: -46px -1px;}
span.diacol{border:1px solid #c9c9c9;background: #fffbeb;position: absolute;left:-150px;top:-5px;width: 120px;text-align: center;padding: 10px;color:#955d35;}
span.diacol .close{position: absolute;top:5px;right:5px;display:block;width:10px;height:10px;background:url(http://css.tuanimg.com/global/images/bg_content.png) -388px -181px;cursor:pointer;overflow: hidden;}
span.diacol .close:hover{background-position: -388px -147px;}
span.diacol .btn,span.diacol .rel{width:35px;height:20px;margin:0 2px;line-height:20px;color:#fff;display: inline-block;background: #cc0000;border:1px solid #cc0000;border-color: #cc0000 #a50000 #a50000 #cc0000;}
span.diacol a:hover{text-decoration: none;color:#fff;}
span.diacol .rel,span.diacol .rel:hover{background: #fafafa;border-color: #fafafa #cac4ab #cac4ab #fafafa;color:#955d35;}
span.diacol p{line-height: 30px;}
.toolbar .right .mco ul li.more{height:30px;line-height: 30px;background: #f8f8f8;text-align: right;border: none;padding-right: 10px;}
.toolbar .right .mco ul li.more a{color:#09c;}
.toolbar .right .mco ul li.tit,.toolbar .right .mco ul li.tit span{height:30px;line-height: 30px;background: #f8f8f8;font-family: "";}
.toolbar .right .mco ul li.tit span{padding:0 0 0 10px;}
.toolbar .right .mcoon .mcoa{border:1px solid #c9c9c9;border-bottom: none;height:30px;position: relative;z-index: 2;}
.toolbar .right .mcoon div{display: block;}
.toolbar .right .mco ul li.ncent{background: #f8f8f8;border: none;text-align: center;color:#955d35;line-height: 20px;padding: 20px 0;height: auto;}
.toolbar .right .mco ul li.ncent p{font-size: 14px;}
.toolbar .right .mco ul li.ncent b{display: inline-block;width: 18px;height: 18px;background: url(/v1/ju/core/img/tb_co.png) no-repeat -320px 0;_background: url(/v1/ju/core/img/tb_co_ie6.png) no-repeat -320px 0;vertical-align: middle;}
.toolbar .right .mco ul li.loading{background:#fff url(/v1/profile/img/loading.gif) no-repeat center center;}
.toolbar .flow,.toolbar .right em{color: #ccc;}
.toolbar .right em{color: #ccc;}

.mycol_msg{width: 125px;height: 24px;line-height: 24px;position: absolute;top:30px;right:270px;background: #fffbeb;border:1px solid #c9c9c9;text-align: left;text-indent: 12px;color:#955d35;}
.mycol_msg span {background: url("http://css.tuanimg.com/global/images/bg_content.png") -388px -181px;cursor: pointer;display: block;height: 10px;position: absolute;right: 5px;top: 5px;width: 10px;overflow: hidden;}
.mycol_msg span:hover{background-position: -388px -147px;}
.mycol_msg em {background: url("/v1/ju/core/img/tb_co.png") -289px 0;_background: url("/v1/ju/core/img/tb_co_ie6.png") -289px 0;display: block;height: 7px;position: absolute;left: 80px;top: -7px;width: 11px;overflow: hidden;}

/*icon2.png背景*/
.header .clientLink,.header .sc,.header .sc i,.header .dy,.header .fx,.head_nav .r .signin_a,.head_nav .r .signin_on  span.signin_a,.topf a.def,.topf a.def:hover{background:url(/v1/ju/core/img/icon2_4.png) no-repeat;}

/*mini icon*/
.icon-mini{width:11px;height:11px;position:absolute;}
.icon-mini,.icon-mid{background:url(/v1/ju/core/img/icon_head.png) no-repeat;display:inline-block;*display:inline;*zoom:1;_background-image:url(/v1/ju/core/img/icon_head_ie6.png);}

.icon-mini.icon-new{background-position:0 0;}
.icon-mini.icon-hot{background-position:-15px 0;}
.icon-mid{width:16px;height:16px;}
.icon-mid.icon-clt{background-position:-20px -42px;}

.header{width:100%; background:#FFF; height:60px;overflow: hidden;}
.header h1{overflow:hidden; height:47px}
.header h1 .l img{vertical-align:top}
.header .clientLink{width:128px;height:22px;float:left;display:inline;margin:25px 0 0 20px;background-position: 0 0;}
.header .sc{width:39px;height:39px;margin-top:15px;background-position: -83px -115px;position: relative;z-index:10000;}
.header .sc:hover{background-position: -125px -116px;}
.header .sc i{width:65px;height:25px;display:none;position: absolute;left:-13px;top:-28px;z-index:10000;background-position: -176px -1px;}
.header .sc:hover i{display:inline-block;}
.header .dy{width:39px;height:39px;display:inline;margin:15px 10px 0 0;background-position: -42px -115px;}
.header .dy input{display:none;}
.header .dyon{width:245px;background-position: 0 -61px;text-align: left;}
.header .dyon input{display:inline;border:none;background: none;}
.header .dyon .int{height: 20px; line-height: 20px; margin: 9px 0px 0px 50px; width: 130px;}
.header .dyon .btn{padding: 0px; margin: 3px 0px 0px 1px; height: 25px; width: 48px; cursor: pointer;}
.header .fx{width:39px;height:39px;display:inline;margin:15px 10px 0 0;background-position: -1px -115px;}
.header .fxon{background-position: 0 -21px;text-align: left;font-size: 0px;letter-space: -8px;}/*width:172px;*/
.header .fxon a{width:20px;height:22px;display:inline-block;margin:8px 0 0 4px;}
.header .fxon a.sina{margin-left:40px;}

.header .search{position:relative;width: 220px;}
.header .search,.header .device{height:34px;line-height:34px;float:right;font-size:0;margin-top:11px;}
.header .search .sort{float:left;width:69px;*height:34px;background:#fff;padding:0;border:none;border-right:1px solid #dbdbdb;font-size:12px;}
.header .search .sort .dropdown-menu{padding-bottom:0;}
.header .search .sort a{display:block;text-align:center;color:#333;text-decoration:none;}
.header .search .sort a.active,.header .search .sort a:hover{background:#f0f0f0;}
.header .search .sort a .arrow-down{border-color:#b0b0b0 #fff #fff #fff;}
.header .search .sort a.active .arrow-down,.header .search .sort a:hover .arrow-down{border-color:#b0b0b0 #f0f0f0 #f0f0f0 #f0f0f0;}
.header .search .sort a{_padding:9px 0 10px;}
.header .search .sort .dropdown-menu a{_padding:0;}
.header .search input,.header .search label{border:none;padding:0;font-size:14px;vertical-align:middle;padding:0;*line-height: 34px;}
.header .search input.txt{width:165px;padding:4px 0 4px 10px;background:#fff;height:20px;line-height: 20px;border: 1px solid #e5e5e5;}
.header .search .smt{width:40px;height:32px;background:url(/v1/ju/core/img/icon_search.png) no-repeat #ee4743 center;cursor:pointer;_background-image:url(/v1/ju/core/img/icon_search_ie6.png);}
.header .search .smt:hover{background-color:#ff7b78}
.header .search label{display: none;position:absolute;z-index:10;color:#b8b8b8;right:50px;top:0;}
/* 高版本ie和ie8 在ie7文档模式下显示差异 高版本会有1px的位移*/
.header .search{*width: 220px;}
.header .search input{*position: absolute;*top: 0;}
.header .search .txt{*left:3px;}
.header .search .smt{*right: 0;}
/* ie8 fix end */
.header .device{float:right;height:38px;line-height:38px;}
.header .device a.all{width:92px;}
.header .device a{width:38px;height:38px;margin-right:1px;display:inline-block;*display:inline;*zoom:1;background:url(/v1/ju/core/img/icon_device.png) no-repeat;filter:alpha(opacity=70);opacity:.7;}
.header .device a:hover{filter:alpha(opacity=100);opacity:1;}
.header .device a.ios{background-position:-93px 0;}
.header .device a.android{background-position:-132px 0;}
.header .device a.wp{background-position:-171px 0;}
.header .device a.wap{background-position:100% 0;}
.header .links {background: url(http://z0.tuanimg.com/v2/core/img/toolbar_links.png);width: 378px;height: 29px;float: right;margin: 15px 15px 0 0;}
.header .links i {display:inline-block;float: left;width: 126px;height: 30px;}

/* .header .area,#toolbar .area{background: #cf201c}
#head_nav .area{background: #c11713}
#junav .area{background: #fff;}
 */
#head_nav{width:100%; background:#cf201c; height:35px;line-height:34px;}
/*#head_nav .area{height:35px;}*/
.head_nav .l{position: relative;}
.head_nav .l a{width:88px;float:left;height:35px;overflow: hidden;position:relative;}
.head_nav .l a i,i.line{position:absolute;height:17px;right:0;top:50%;margin-top:-8px;_line-height:0;}
.head_nav .l a.first{border-left:1px solid #d7412c;}
.head_nav .l a.on i{display:none}
.head_nav .l a i{color: #bb120f;border-right: 1px solid #bb120f;}
.on i.line,.open i.line{display: none;}
.head_nav .l a.on,.head_nav .l a.on:hover,.head_nav .r_con a.on,.head_nav .r_con a.on:hover{background: #bb120f;color:#FFF;font-weight:bold;}
.head_nav .l a:hover{background: #bb120f;}
.head_nav .l a,.head_nav .r a{color:#fff;font:14px/35px "";}
.head_nav .l a{ text-decoration:none;}

.head_nav .r_con{float:right;color:#9a0c0a;font-size:0;_width:320px;position: relative;*z-index: 999;height: 35px;}
.head_nav .r_con a,.head_nav .r_con {color:#fff;padding:0 15px 0 0;_border-right: none;_zoom:1;}
.head_nav .r_con{position:relative;padding-right: 0px;}
.head_nav .r_con .open{_height:26px;}
.head_nav .r_con .yg_wrap{float:left;position: relative;display: inline-block;_float: left;overflow: hidden;height: 34px;}
.head_nav .r_con .yg{padding-right: 15px;padding-right:5px\9;padding-left: 10px;*height: 35px;*line-height: 36px;overflow: hidden;}
.head_nav .r_con a:hover{text-decoration: none;color: white;}
.head_nav .r_con .zhe_intro,.sign_panel{float: left;}
.head_nav .r_con .zhe_intro,.head_nav .r_con .sign_panel{_height: 25px;_padding-top: 9px;}
.head_nav .r_con .zhe_intro .line_left{_line-height:0;position: absolute;left: 0px;top: 50%;height: 17px;_height: 17px;border-left: solid 1px #bb120f;margin-top: -8px;}
.head_nav .r_con .zhe_intro .trigger{padding-left: 25px;position: relative;}
.head_nav .r_con .zhe_intro {padding-left: 0px}
.head_nav .r_con a.on{display: inline-block;*display: inline;*zoom:1;height: 35px;}

.head_nav .r_con .tooltip{right: 0;top: -65px}
.head_nav .r_con .tooltip a{padding: 0;color:#09c;border: none;position: static;}
.head_nav .r_con .tooltip .tooltip-arrow{left: auto;right: 30px}
.head_nav .r_con{font-size:14px}
.head_nav .r_con .signin{border-right:0;padding:0 15px 0 15px}
.head_nav .r_con .signin i{width:16px;height:16px;display:inline-block;*display:inline;*zoom:1;background:url(/v1/ju/core/img/icon_head.png) no-repeat -40px -20px;vertical-align:text-top;*vertical-align:middle;margin-right:4px;_background-image:url(/v1/ju/core/img/icon_head_ie6.png);}
.head_nav .r_con .signin i.icon-mini{background-position: -30px 0 !important;width: 11px;height: 11px;right: 10px;margin: 0;_top:5px;}
.head_nav .r_con a.signin:hover i{background-position:0px -20px;}
.head_nav .r_con .signin_on .signin i,.head_nav .r_con .signin_on a.signin:hover i{background-position:-20px -20px;}
.head_nav .r_con .zhe_notice{display:inline-block;*display:inline;*zoom:1;}
.head_nav .r_con .zhe_notice.active{color:#e02f2f;font-weight:bold;background:#fff;}
.head_nav .r_con .zhe_intro .trigger{text-decoration: none;_border-right: none;}
.head_nav .r_con .zhe_intro .open .trigger{color:#FFF;border-color:transparent;}
.head_nav .r_con .zhe_intro .icon-arrow{display:inline-block;*display:inline;*zoom:1;height:0;line-height: 0;width:0;vertical-align:middle;border-width:3px;border-style:solid;margin-left:3px;border-color:#eca6a4 #cf201c #cf201c #cf201c;_overflow:hidden;}
.head_nav .r_con .open .icon-arrow{display:inline-block;*display:inline;*zoom:1;height:0;line-height: 0;width:0;vertical-align:middle;border-width:3px;border-style:solid;margin-left:3px;border-color:#eca6a4 #bb120f #bb120f #bb120f;_overflow:hidden;}
.head_nav .r_con .open{color:#FFF;background:#bb120f;border-bottom:none;*z-index:999;}
.head_nav .r_con .dropdown .arrow-down{-webkit-transition:-webkit-transform ease .3s;-moz-transition:-moz-transform ease .3s;-webkit-transform-origin:3px 1.5px;-moz-transform-origin:3px 1.5px;}
.head_nav .r_con .dropdown{border-top:none;border-bottom: none;}

.head_nav .r_con .dropdown-menu li a{color:#333;padding:0 0 0 25px;border-right:none;font-size:12px;}

.head_nav .r_con .dropdown-menu a{border-right:none;}
.head_nav .r_con .dropdown-menu a:hover{_color: #333;}
/*修改签到样式，已签状态下父级样式名sign_panel替换为sign_board*/
.dropdown.sign_panel,.dropdown.sign_board{border:none;background:none;*z-index:999;}

.sign_panel .dropdown-menu{font:12px/20px "";color:#666;width:190px;left:auto;right:0;}
.sign_panel .dropdown-menu b{color:#e02f2f}
.sign_panel .dropdown-menu .gotuan{margin-top:10px;padding-top:10px;border-top: 1px dotted #999999; }

.head_nav .r_con .sign_panel dl a{color:#1b80a9;font-size:12px;padding:0}
.head_nav .r_con .sign_panel dl a:hover{color:#ff6000;}
.sign_panel dl dt,.sign_panel dl dd{padding:10px 0;}
.sign_panel dl dd{background:#f0f0f0;padding:10px;color:#cccccc}
.sign_panel dl dt{text-align:center;}
.sign_panel dl dd span{color:#666;}
.sign_panel dl dd .addQQ{color:#666;margin-top: 6px;}
.sign_panel dl dd .addQQ span{color:#e02f2f;font-weight: bold;}
.sign_panel.open .signin:hover{_color: #fff;}
.head_nav .r_con .signin{white-space: nowrap;}
.sign_panel .dropdown-menu,.sign_board .dropdown-menu{border-color: #c11713;}
.sign_board .dropdown-menu{width: 455px;padding: 20px 25px;right: 0;left: auto;color: #666;}
.sign_board .hd{font: 12px/25px "宋体";margin-bottom: 10px;}
.sign_board .hd b{font-size: 14px;vertical-align: top}
.sign_board .hd span{color: #e20000;margin: 0 12px 0 5px}
.head_nav .r_con .sign_board .dropdown-menu a{color: #1b80a9;}
.sign_board{_height:26px;_padding-top:12px;}
.sign_board .dropdown-menu a:hover{color: #FF6000 !important;}
.sign_board .bd{padding-bottom:20px;background: url('../img/qd_border.png') repeat-x 0 100%;}
.sign_board .side{float: right;margin-left: 12px;width: 225px;_margin-left:5px;}
.sign_board .bd .article{background: url('../img/calendar.png') no-repeat;width: 218px;}
.sign_board .bd .side{height: 220px;}
.sign_board .calendar{line-height: 26px;width: 100%;text-align: center;font-family:microsoft yahei;border-collapse: collapse;border-spacing: 0;border: 1px solid #c2c2c2;border-top: none;}
.sign_board .calendar th{line-height: 28px;color: #cf201c;font-weight: normal;}
.sign_board .calendar td,.sign_board .calendar th{padding: 0;}
.sign_board .calendar td{border: 1px solid #c2c2c2;font: 14px/26px Arial}
.sign_board .calendar td.disable{color: #c8c8c8;}
.sign_board .calendar td.on{background-color:#ff9daa;color: #fff;}
.sign_board .bd .article .tit{line-height: 30px; text-align: center;color: #fff;}
/*解决逛页面样式冲突*/
.sign_board .bd .article .tit,.sign_board .bd .side .tit{width: auto;margin-bottom: 0;border: none;}

.sign_board .bd .side .tit{font: 14px/30px "宋体";color: #e20000;padding-left: 30px;background: url('../img/icon_heart.png') no-repeat 10px 8px #fef096;_background-image: url('../img/icon_heart_8.png');}
.sign_board .bd .side .con{border: 1px solid #fef096; border-top: none;height: 160px;background:#fdfaec;padding: 30px 10px 0;position: relative;font: 12px/20px "宋体";}
.sign_board .bd .side .con h3{color: #333;}
.sign_board .bd .side .con p{color: #999;margin-top: 10px;}
.sign_board .bd .side .con i.icon_ft{background: url('../img/qd_ft.png');position: absolute;right: -1px;bottom: -1px;width: 27px;height: 28px;_bottom:-2px;_right:-2px;}
.sign_board .ft{padding-top: 15px;font:12px/22px "宋体";}
.sign_board .ft .article{white-space: nowrap;}
.sign_board .ft .side{width:195px;}
.sign_board .ft h3{font-weight: bold;}
.sign_board .ft em{color: #e20000;font-family: arial;}
.sign_board .ft b{font:bold 14px/22px Arial;}

.head_nav .r_con a .icon-mini{top:4px;right:5px;top: 1px\9;right:2px\9;}
.head_nav .r_con a.on .icon-mini{top: 5px;right: 6px;top: 1px\9;right:1px\9;}
.head_nav .r_con a.on{*background: #bb120f;}

.head_nav .r{text-align:left;padding-right:80px;position: relative;z-index: 10000;}
.head_nav .r a.on{color:#ffd696}
.head_nav .r a{margin:0 10px;display:inline-block;}
.head_nav .r a.alink{margin-left:110px;}
.head_nav .r em{width:2px;font:0/0 ""; height:40px; background:url(/v1/2012/images/tao_20125.16bg2.png) -239px -63px no-repeat; display:inline-block; vertical-align:top}
.head_nav .r i{width:14px; height:38px; background:url(/v1/2012/images/tao_20125.16bg2.png) -241px -63px no-repeat; float:left;margin-right:10px}
.head_nav .r i.i1{ background-position:-241px -63px}
.head_nav .r i.i2{ background-position:-256px -63px}
.head_nav .l .zhibg{width:36px;height:15px;display:inline-block;background:url(/v1/2012/images/top_icon_2.png);_background:url(/v1/2012/images/top_icon_2_ie6.png);position: absolute;top:0;left: 205px;}
.head_nav .l span.n{display: none;width: 13px;height: 11px;position: absolute;left:276px;top:10px;background: url(/v1/zhi/guang/img/icon.png) no-repeat -92px 0;overflow: hidden;}

/**左侧导航**/
.side_nav{position:absolute;top:245px;width:128px;left:50%;text-align:left;margin-left:-635px;z-index:999;background:#cf201c}
.side_nav .logo{display:none;}
.side_nav.affix{padding-top:70px;}
.side_nav.affix-bottom{position: absolute;top: auto;padding-top: 70px;}
.side_nav.affix .logo,.side_nav.affix-bottom .logo{display:block;}
.side_nav .logo{position:absolute;left:-4px;top:0;width:132px;}
.side_nav .content,.side_nav .bottom{border:1px solid #e2e2e2;border-left:none;border-top:none;background:#fff;}
.side_nav h3{background:#ffeed9;color:#bf7c53;line-height:30px;padding-left:10px;}
.side_nav h3 a{color:#bf7c53;}
.side_nav h3 a{color:#bf7c53;}
.side_nav .bd{padding:8px 0;}
.side_nav ul{zoom:1;padding-left:10px;}
.side_nav ul:after{clear:both;content:"";line-height:0;font-size:0;visibility:hidden;display:block;}
.side_nav li{float:left;width:50%;line-height:26px;*overflow:hidden;*width:58px;}
.side_nav li a{color:#666;display:inline-block;*display:inline;*zoom:1;text-decoration:none;padding:3px 4px;line-height:18px;border-radius:2px;}
.side_nav li a.on,.side_nav li a.on:hover{background:#e02f2f;color:#fff;}
.side_nav li a:hover{background:#f0f0f0}
.side_nav .qrcode img{width:92px;height:92px;}
.side_nav .qrcode{text-align: center;padding: 8px;}
.side_nav .qrcode p{margin-top: 5px;}
.side_nav .qrcode a{color:#666;}
.side_nav .bottom{position:absolute;bottom:0;left:0;margin-bottom:-59px;width:100%;height:39px;}
.side_nav .bottom a{display:block;line-height:39px;text-decoration:none;color:#666;font-family:tahoma;text-align:center;_height:27px;_padding-top:12px;}
.side_nav .bottom a.on{background:#e02f2f}
.side_nav .bottom a:hover{background:#e2e2e2}
.side_nav .bottom a .icon-top{}
.icon-top{display:inline-block;*display:inline;*zoom:1;background:url(/v1/ju/core/img/icon_head.png) no-repeat 0 -45px;_background-image:url(/v1/ju/core/img/icon_head_ie6.png);width:11px;height:9px;margin-right:3px;}
.affix{position:fixed;top:0;_position:absolute;_padding-top:70px;}
.affix .logo{_display:block;}

/*Feature #32787*/
.side_nav .bd .qrcode .add_link{ margin-top: 0;}
.side_nav .move_padding{ padding: 0px;}
.side_nav .add_link{ position:relative;height: 40px;border-top: 1px solid #e2e2e2;margin-top: 0;padding: 0;}
.side_nav .bd .add_link span{margin:13px 0 0 5px;font-size: 12px;color: #666;width: 70px;display: inline-block;}
.side_nav .add_link i{ display: inline-block;background: url(http://z0.tuanimg.com/v2/core/img/32787_icon.png);}
.side_nav .add_link a{ text-decoration: none;}
.side_nav .add_link .phone_w{float:left;margin:8px 0 0 10px;width:30px;height:25px;background-position: 0px -39px;}
.side_nav .add_link .contact_w{float:left;margin:8px 0 0 10px;height: 23px;width: 30px;background-position: 0px 0px;}
.side_nav .add_link_hover{background-color: #f5f5f5;cursor: pointer;}
.side_nav .add_link_hover .phone_w{width:30px;height:25px;background-position: -35px -39px;}
.side_nav .add_link_hover .contact_w{height: 23px;width: 30px;background-position: -34px 0px;}
.side_nav .add_link .qr_code {display: none;width:190px;height:137px;position: absolute;top: 0px;left: 124px;}
.side_nav .add_link .qr_code .border{width: 5px;height: 137px;float: left;}
.side_nav .add_link .qr_code .border i{margin-top:15px;width: 5px;height:10px;background: url(http://z0.tuanimg.com/v2/core/img/32787_icon.png);background-position: -74px -9px;}
.side_nav .add_link .qr_code .left{float:left;border:2px solid #bf7c53;width:175px;height:137px;background-color: #FFF;background: url(http://z0.tuanimg.com/v2/core/img/32787_qr_code.png) no-repeat;background-color: #FFF;}
.side_nav .add_link .qr_code .left a{display: block;width: 100%;height: 100%;}

/*右侧导航34847*/
.side_panel{position: absolute;visibility:hidden;left: 50%;margin-left: 507px;bottom: 0;_visibility:visible;z-index: 1000}
.side_panel .content{position: relative;}
.side_panel.affix{top: auto;visibility:visible;position: fixed;bottom: 0;}
.side_panel.affix-bottom{visibility:visible;}
.side_panel .icon{display: inline-block;*display:inline;*zoom:1;width: 28px;height: 28px;background: url('/v1/ju/core/img/icon_head.png') no-repeat 0 -65px;_background-image: url('/v1/ju/core/img/icon_head_ie6.png');}
.side_panel .icon-pen{background-position: -35px -65px;}
.side_panel .icon-smile{background-position: 0 -65px;}
.side_panel .icon-up{background-position: -70px -65px;width: 24px;height: 13px;}
.side_panel .trigger{display: block;width: 44px;height: 44px;padding: 5px;background: url('../img/btn_side.png') no-repeat 0 100%;_background-position: 0 -62px;color: #fff;text-decoration: none;text-align: center;line-height: 22px;_overflow:hidden;margin-bottom: 8px;}
.side_panel .trigger p{font-size: 14px;display: none;}
.side_panel .trigger span{display: table-cell;width: 44px;height: 44px;vertical-align: middle;}
.side_panel .trigger:hover{background-position: 0 0;_color: #fff;_text-decoration: none;}
.side_panel .trigger:hover span{display: none}
.side_panel .trigger:hover p{display: block}
.side_panel .trigger b{font:bold 16px/30px Arial;}

.side_panel .dropdown-menu{display: block;position: static;min-width: 0;}
.side_panel .tooltip-content{padding: 0;border:none;width: auto}
.side_panel .tooltip .tooltip-arrow{border: none;width: 8px;height: 16px;}
.side_panel .tooltip .tooltip-arrow.right{left: 100%;margin-left: -1px;bottom:80px;background: url('../img/arrow_mix.png') no-repeat}
.side_panel.signin_on .tooltip .tooltip-arrow.right{background-position: 0 -16px;}
.side_panel .tooltip-content a{text-decoration: none;}
.side_panel .tooltip-content .hd a{padding-right: 15px;}

/*底*/
.about{border-top: 3px solid #E02F2F;background: #fff;}
.about li{float: left;width: 105px;text-align: left;border-right: 1px solid #E1E1E1;padding: 30px 0 0 20px;height: 200px;line-height: 24px;}
.about li span{display: block;font:16px/30px "microsoft yahei";}
.about .lw a{display: block;color:#666;}.about .lw a:hover{color:#c00;}
.about li.w1{padding-left: 0;}
.about li.w2{width: 125px;}
.about li.w3{width: 180px;}
.about li.w3 h3 a{color:#c00;}
.about li.w3 h4 .bdtxt{color:#e02f2f;height:20px;line-height:20px;width:63px;padding-left:5px;}
.about li.w3 h4 .smt{display:inline-block;*display:inline;*zoom:1;background:#fafafa no-repeat;}
.about li.w3 h4 input,.about li.w3 h4 .smt{border:1px solid #eaeaea;}
.about li.w3 h4 a.smt{width:22px;height:20px;background-image:url(/v1/ju/core/img/icon_search_grey.png);background-position:center;opacity:.6;filter:alpha(opacity=60);border-color:#ddd;vertical-align:top;margin-top: 1px;}
.about li.w3 h4 .smt{border-left:none;}
.about li.w3 h4 .smt:hover{background-color:#FFF;}
.about li.w3 h6 .txt{height:20px;line-height:20px;width:63px;padding-left:5px;}
.about li.w3 h6 .smt{display:inline-block;*display:inline;*zoom:1;background:#fafafa no-repeat;}
.about li.w3 h6 input,.about li.w3 h6 .smt{border:1px solid #eaeaea;vertical-align: middle;}
.about li.w3 h6 a.smt{width:22px;height:20px;background-image:url(/v1/ju/core/img/icon_search_grey.png);background-position:center;opacity:.6;filter:alpha(opacity=60);border-color:#ddd;vertical-align:top;margin-top: 1px;}
.about li.w3 h6 .smt{border-left:none;}
.about li.w3 h6 .smt:hover{background-color:#FFF;}
.about li.w3 h6 .txt{height:25px;line-height:25px;width:98px;padding-left:5px;}
.about li.w3 h6 .dysmt{height:25px;line-height:25px;width:42px;cursor:pointer;color:#666;}
.about li.w4{width: 253px;border: none;}
.about li.w4 a{float:left;width:38px;height:52px;background:url(/v1/ju/core/img/icon_device_bottom_ie6.png) no-repeat;margin-right:11px;}
.about li.w4 a:hover{filter:alpha(opacity=50); -moz-opacity:0.8; opacity:0.8;}
.about li.w4 a.android{background-position:-49px 0;}
.about li.w4 a.wp{background-position:-98px 0;}
.about li.w4 a.wap{background-position:right 0;}
.about li.w4 h4{clear: left;line-height: 20px;padding-top: 10px;height: 80px;overflow: hidden;}
.about li.w4 h4 img{float:left;display: inline;margin:3px 10px 0 0;width: 72px;height: 73px;}
.about li.w4 h4 em{color:#E02F2F;}

.friendly_links{margin: 20px auto 0;color:#666;width: 750px;}
.friendly_links span{float: left;}
.friendly_links .links{float: left;width: 620px;height:14px;overflow: hidden;position: relative;}
.friendly_links .links ul{width: 1000px;height:14px;position: absolute;left:0;top:0}
.friendly_links .links ul li{float: left;margin-right: 12px;}
.friendly_links .links ul li a{color: #999;}
.friendly_links .more{float: left;margin-left: 20px;color:#666;}
.friendly_links .more:hover{color:#cc0000;}

.footer{margin-top:10px;height:60px; line-height:30px;}
.footer img{ vertical-align:middle;margin:0 auto; border:1px solid #c3bfbe;display:block;}

/*弹窗-默认样式*/
.dialog-wrapper{position: absolute;background:#fffbeb;border: 5px solid #e6e6e6;z-index: 100000;}
.dialog-wrapper .diginfo{padding:10px 20px;border:1px solid #c9c9c9;}
.dialog-wrapper .diginfo em{margin-left:5px;}
.dialog-wrapper .diginfo u{float:left;width:18px;height:18px;overflow:hidden;background: url(http://css.tuanimg.com/global/images/msg.png);}
.dialog-wrapper .diginfo u.m0{background:none;display:none}
.dialog-wrapper .diginfo u.m1{background-position:0 0;}
.dialog-wrapper .diginfo u.m2{background-position:0 -18px;}
.dialog-wrapper span.close{position: absolute;top:5px;right:5px;display:block;width:10px;height:10px;background:url(http://css.tuanimg.com/global/images/bg_content.png) -388px -181px;cursor:pointer;}
.dialog-wrapper a:hover span.close{background-position: -388px -147px;}

/*弹窗样式*/
#dialog_empty_deal{border:none;background:none;width:380px;height:210px;position:absolute;z-index:99999}
#dialog_empty_deal .diginfo{ border:0}
#dialog_empty_deal span.close{width:32px;height:32px; display:block; position:absolute; top:17px;right:-12px; background:url(/v1/2012/images/tao_20125.22bg2.png) 0 0 no-repeat; _background:url(/v1/2012/images/tao_20125.22bg3.png) 0 0 no-repeat; z-index:4}
#dialog_empty_deal.dialog-wrapper-ad{width:auto;height:auto;border: 5px solid #B2B2B2;background:#fff;font-size: 14px;line-height: 26px;position:absolute;z-index:99999}
#dialog_empty_deal.dialog-wrapper-ad span.close,#signal_diglog.dialog-wrapper a:hover span.close{background: url("/v1/2012/images/tao_20125.22bg2.png") no-repeat scroll 0 0 transparent;display: block;height: 32px;position: absolute;right: -15px;top: -15px;width: 32px;z-index: 4;_background:url(/v1/2012/images/tac_ie6_clo.png);_width:28px;_height:28px;}
#dialog_empty_deal .diginfo{padding:10px 20px;}

/*导航-帮助中心入口*/
.topf{float: right;width:110px;position: absolute;right:155px;top:0;}
.topf a.def,.topf a.def:hover{width:102px;height: 39px;margin:0 4px;background-position:-8px -162px;text-decoration: none;overflow: hidden;}
.topf dl{display:none;background:#f7f7f7;border:1px solid #999;position: absolute;width:110px;left:-5px;top:2px;}
.topf dt{font:800 14px/34px "";background:#eee url(/v1/2012/images/top_icon_2.png) no-repeat -175px -91px;padding-left: 10px;color:#333;}
.topf dd{padding:5px;}
.head_nav .r .topf dd a{color:#666;display:block;margin:0;font: 12px/30px "";padding-left: 10px;}.head_nav .r .topf dd a:hover{background:#eee;text-decoration: none;}
.topfon a.def{display:none;}
.topfon dl{display:block;}

.defaback {background: url("/v1/2012/images/i3.png") repeat scroll 0 -122px transparent;cursor: pointer;display: inline-block;height: 30px;line-height: 30px;padding-left: 20px;}
.defaback em {background: url("/v1/2012/images/i3.png") repeat scroll right -122px transparent;color: #FFFFFF;display: inline-block;font: bold 16px/30px "微软雅黑";height: 30px;padding-right: 20px;}

/*顶部广告*/
.topad{padding:10px 0;}
.topad img{width:980px}
.topad .fi01{position:relative;cursor:pointer;width:980px;margin:0 auto;float:left;font-size:0;zoom:1;}
.topad .fi01 .fi_player{width:100%;}
.topad .fi01 .fi_tt{display: none;}
.topad .fi01 .fi_tab{height:16px;display:inline;position:absolute;background:#fff;}
.topad .fi01 .fi_tabRB{right:-1px;bottom:0;_bottom:2px;}
.topad .fi01 .fi_tab span{width:28px;margin-right:1px;font:9px/10px 'Arial';color:#CECECE;float:left;}
.topad .fi01 .fi_tab span.now{background-color:#2295a1;}
.topad .fi01 .fi_tabLB span,.topad .fi01 .fi_tabRB span{height:13px;padding-top:3px;background-color:#666;}
.topad .fi01 .fi_tabLT span,.topad .fi01 .fi_tabRT span{height:16px;padding-top:0;background-color:#d07325;}

/*签到登录弹窗*/
#dialog_log_qiandao,#dialog_log_qiandao .diginfo{background: none;border: none;margin: 0;padding: 0;}
.qd_login{width: 450px;border:1px solid #d6d5bd;}
.qd_login a{color:#09c;}
.qd_login a:hover{color:#c00;}
.qd_login .ht{padding:0 20px;height:72px;background: url(/v1/jifen/welfare/img/weldialog.png) repeat-x 0 -194px;line-height: 72px;text-align: right;}
.qd_login .ht .logo{float:left;width:187px;height:29px;margin-top: 16px;background: url(/v1/jifen/welfare/img/weldialog.png) repeat-x 0 -115px;overflow: hidden;}
.qd_login .hc{background: #fff;padding:20px 0;}
.qd_login .hc h3,.qd_login .hc ul{width:330px;padding:0 50px;float:left;text-align:left;font-size: 14px;line-height: 30px;}
.qd_login .hc h3{color:#555;font-weight: bold;}
.qd_login .hc li {padding-top: 10px;}
.qd_login .hc li input{width:200px;height:20px;padding:4px 10px;background: url(/v1/jifen/welfare/img/weldialog.png) no-repeat 0 -28px;border:none;font-size: 12px;line-height:20px;}
.qd_login .hc li.btn{font-size: 12px;}
.qd_login .hc li.btn input{width:68px;height:30px;margin-left:57px;background: url(/v1/jifen/welfare/img/weldialog.png) no-repeat -176px -84px;cursor: pointer;font-size: 16px;}
.qd_login .hc li.btn a{margin-left:15px;}
.qd_login .hc li.tb{padding-top: 20px;}
.qd_login .hc li a.tbbtn{background:url(/v1/jifen/welfare/img/tblogin.png);float:left;width:107px;height:25px;line-height:500px;overflow:hidden;margin-left:57px;}
#pperrmsg{font-size: 12px;color:#c00;}
.qd_login .sf {float:left;width:100%;margin-top:10px;border-top: 1px dotted #999;height: 75px;}
.qd_login .sf p{height: 45px;margin-top: 10px;margin-left: 90px;}
.qd_login .sf a{float: left;display: inline;margin-left: 15px;width: 107px;height: 25px;background: url(/v1/login/img/bg2.png) no-repeat 0 0;text-indent: -900px;overflow: hidden;margin-bottom:10px}
.qd_login .sf a:hover{text-decoration: none;}
.qd_login .sf a.qq {background-position: 0 0;width: 92px;height: 33px;}
.qd_login .hb {height: 37px;border-top: 1px dotted #d2cd68;background: #fefef3;text-align: right;line-height: 37px;padding: 0 20px;}
.qd_login .hb input {vertical-align: text-bottom;margin: 0;}
.qd_login .morela span{float:left;display: inline-block;text-indent:0;color: #999}
.qd_login a.morela{float:left;display: inline-block;margin: 10px 0 0 15px;background: none}
.qd_login .moreicona {float:left;display: inline-block;background: url(/v1/login/img/bg2.png) no-repeat 0 -113px;width: 9px;height: 6px;text-indent: -900px;overflow: hidden;margin:5px;}
.qd_login .iconup {background-position: -14px -113px;}
.qd_login p.more_logina{margin-top: 0px;}
.qd_login .more_logina .sina,.more_logina .taobao,.more_logina .renren{float:left;display: inline-block;width:83px;height:25px;background: url(/v1/login/img/bg2.png) no-repeat 0 0;margin-right: 10px;text-indent: -900px;overflow: hidden;}
.qd_login .more_logina .sina{background-position: 0px -33px;width: 83px}
.qd_login .more_logina .renren{background-position: 0px -58px;width: 83px;margin-left: 0}
.qd_login .more_logina .taobao{background-position: 0px -83px;margin: 0 10px 0 0;width: 83px}
.hct {background: #fff;line-height: 50px;padding: 20px 0 30px;}
.hct h3 {font-weight: bold;font-size: 14px;}
.hct p a {margin: 0 5px;display: inline-block;width: 65px;height: 22px;background: url(/v1/ju/core/img/mbg.png) no-repeat -253px 0;}
.hct p a.hl {margin:1px 5px 0;width: 58px;height:21px;background-position: -312px -40px;}
.hct p a.gz{background: none;overflow: hidden;}
.qd_login .ht .xllogo {height: 41px;width: 135px;margin-top: 13px;background: url(/v1/ju/core/img/mbg.png) no-repeat -0 -10px;}
.qd_login .ht .qqlogo {height: 41px;width: 115px;margin-top: 13px;background: url(/v1/ju/core/img/mbg.png) no-repeat -135px -10px;}
.qd_login .hbt{border-top:1px solid #fff;text-indent: 600px;background: #fff;}
.qd_login .hbt *{display: none;}

/*明日预告弹窗*/
.classifi .area{position: relative;}
.classifi div.r{position: absolute;overflow:visible;right:0;top:0;}
#nicmrmsg{width: 230px;height: 24px;line-height: 24px;text-align: left;text-indent: 10px;border: 1px solid #c9c9c9;background: #fffbeb;z-index: 100;display:block;position: absolute;top: 64px;right:-6px;_position: relative;_top:0;_right:0;_margin: 0px 0 0 -150px;}
#nicmrmsg em{display: block;padding:0;width: 11px;height: 7px;background: url(../img/mbg.png) no-repeat -313px -31px;overflow: hidden;position: absolute;top: -7px;right:30px;}
#nicmrmsg i {color: #09c;font-style: normal;cursor: pointer;vertical-align: middle;}
#nicmrmsg span{position: absolute;top:5px;right:5px;display:block;width:10px;height:10px;background:url(http://css.tuanimg.com/global/images/bg_content.png) -388px -181px;cursor:pointer;}
#nicmrmsg span:hover{background-position: -388px -147px;}
.head_nav .r .bdsj_ts{display: block;width: 217px;height: 32px;background: url(/v1/ju/core/img/bdsj2.png) no-repeat 0 0;position: absolute;right: 0;top:-28px;}
.head_nav .r .bdsj_ts span{display: block;width: 10px;height: 10px;position: absolute;right: 5px;top:5px;cursor: pointer;}

/*绑定手机-弹窗*/
#dialog_bdsj_bangding,#dialog_bdsj_bangding .diginfo{background: #fff;border: none;margin: 0;padding: 0;}
#dialog_bdsj_bangding .diginfo .bangdtit{width:425px;text-align: left;}
#dialog_bdsj_bangding .diginfo .bangdtit h3{padding-left:40px;padding-top:15px;font:bold 14px/40px "宋体";color:#333;background: url("/v1/jifen/welfare/img/weldialog.png") repeat-x 0 -194px;}
#dialog_bdsj_bangding .diginfo .bangdtit p{padding:5px 30px;color:#666;font:12px "";background: url("/v1/jifen/welfare/img/weldialog.png") repeat-x 0 -194px;}
#dialog_bdsj_bangding .diginfo .bangdtit p i{color:#cc0000;font-style: normal;font-weight: bold;}

.reg_box{text-align: left;width:425px;}
.reg_box input{vertical-align: middle;padding: 4px 10px;background: url(/v1/ju/core/img/bdsj2.png) no-repeat;border:none;}
.reg_box .itext1{background-position: 0 -40px;width: 200px;height: 20px;}
.reg_box .itext2{background-position: 0 -72px;width: 115px;height: 20px;}
.reg_box #reg_submit_i{background-position: 0 -172px;width: 82px;height: 35px;}
.reg_box .item{padding:10px 0 0 108px;width:550px;height:56px;}
.reg_box .i_code,.reg_box .i_txt{padding-top: 0;}
.reg_box .nextbind{margin-top: 10px;margin-left: 10px;color: #0099cc;text-decoration: none;display: inline-block;}
.reg_box .item label{margin-left:-100px;text-align: right;float:left;width:100px;height:28px;font: 12px/28px "宋体";display: inline;color:#666}
.reg_box .item label em{color:#c20000;padding-right:5px;}
.reg_box .item .i_codeP a,.reg_box .item .i_codeP a:hover{width: 84px;height: 28px;margin-left:7px;line-height: 28px;display: inline-block;background: url(/v1/ju/core/img/bdsj2.png) no-repeat 0 -142px;vertical-align: middle;text-align: center;text-decoration: none;}
.msg_box{line-height: 28px;height: 28px;overflow: hidden;}
.msg_box em{display: inline-block;width: 20px;height: 28px;vertical-align: middle;background: url(/v1/ju/core/img/bdsj2.png) no-repeat -84px -108px;}
.reg_box .item .row1{color:#c20000;}
.reg_box .item .row1 em{background-position: -143px -108px;}
.reg_box .item .row2{color:#c20000;}
.reg_box .item .row2 em{background-position: -114px -108px;}
.reg_box .item input.btn{display: inline;float:left;margin-right:10px;width: 68px;height: 30px;padding: 0;background: url(/v1/ju/core/img/bdsj2.png) no-repeat 0 -107px;cursor: pointer;}

/*绑定手机-绑定成功*/
#dialog_bdsj_bangding .diginfo .bangdok{padding:60px 0;width:500px;}
#dialog_bdsj_bangding .diginfo .bangdok h3{font:bold 26px/30px "微软雅黑";color:#390;margin-bottom: 30px;}
#dialog_bdsj_bangding .diginfo .bangdok p{font-size:14px;color:#333;}

/*手机绑定提示信息样式修改  wn*/
.reg_box .msg_zt3 .row1{color:#c20000;}
.reg_box .msg_zt3 .row1 em{background-position: -143px -108px;}
.reg_box .msg_zt1 .row1{color:#c20000;}
.reg_box .msg_zt1 .row1 em{background-position: -114px -108px;}
.reg_box .msg_zt2 .row1{color:#c20000;}
.reg_box .msg_zt2 .row1 em{background-position: -84px -108px;}

#dialog_bdsj_bangding .diginfo .reg_box .item{width:auto;}

/*签到双倍积分弹窗*/
#dialog_tishi_qiandao,#dialog_tishi_qiandao .diginfo{width: 480px;background: #fff;border: none;margin: 0;padding: 0;}
#dialog_tishi_qiandao .btn1,#dialog_tishi_qiandao .btn1:hover{display: inline-block;padding-left: 10px;margin-top:10px;height: 30px;line-height: 30px;font-weight:bold;background: url(/v1/ju/core/img/qd_ts.png) 0 0;color:#fff;text-decoration: none;}
#dialog_tishi_qiandao .btn1 em{display: inline-block;padding-right: 10px;height: 30px;background: url(/v1/ju/core/img/qd_ts.png) 100% 0;vertical-align: top;}
#dialog_tishi_qiandao .blockA{padding:25px;line-height: 30px;text-align: left;}
#dialog_tishi_qiandao .blockA span{font:bold 22px/30px "微软雅黑";color:#c33;}
#dialog_tishi_qiandao .blockA div{height:140px;padding: 10px;padding-bottom:0;background: #f4f4f4;-moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius:5px;margin: 20px 0 0px;}
#dialog_tishi_qiandao .blockA .l{text-align: center;width: 110px;color:#333;}
#dialog_tishi_qiandao .blockA .l em{display: block;width: 100px;height: 100px;background: url(/v1/ju/core/img/qd_ts.png) 0 -30px;margin: 0 auto;border:5px solid #fff;}
#dialog_tishi_qiandao .blockA .r{width: 260px;}
#dialog_tishi_qiandao .blockA b{float:left;text-indent: 6px;}
#dialog_tishi_qiandao .blockA ul{float: left;width: 100%;text-align: left;line-height: 30px;}
#dialog_tishi_qiandao .blockA li{margin-top: 2px;height: 30px;}
#dialog_tishi_qiandao .blockA label{float:left;width: 65px;text-align: right;}
#dialog_tishi_qiandao .blockA input{width:180px;height:20px;border:1px solid #ccc;vertical-align: middle;-moz-border-radius: 3px;-webkit-border-radius: 3px;border-radius:3px;}
#dialog_tishi_qiandao .blockA input.yzm{width: 80px;}
#dialog_tishi_qiandao .blockA img{vertical-align: bottom;margin-left: 10px;height: 30px;}
#dialog_tishi_qiandao .blockA .btn1,#dialog_tishi_qiandao .blockA .btn1:hover{margin-top: 5px;vertical-align: top;}

#dialog_tishi_qiandao .blockB{padding:25px;line-height: 30px;}
#dialog_tishi_qiandao .blockB  span{font:bold 22px/40px "微软雅黑";color:#c33;}
#dialog_tishi_qiandao .blockB p em{color:#c33;font-weight: 800;margin: 0;}

.head_nav .r .hdts{width: 215px;height: 60px;padding-left:10px;border: 1px solid #c9c9c9;position: absolute;right: 0;top:-64px;background: #fffbeb;line-height: 18px;}
.head_nav .r .hdts b{display: inline-block;padding: 2px 0 1px;}
.head_nav .r .hdts a{color:#09c;font-size:12px;display: inline;margin: 0;line-height: 18px;}
.head_nav .r .hdts span{position: absolute;right:3px;top:2px;display: block;width:10px;height:10px;background: url(/v1/ju/core/img/bdsj2.png) no-repeat -202px -4px;cursor: pointer;}
.head_nav .r .hdts em{position: absolute;right:30px;top:60px;display: block;width:11px;height:7px;background: url(/v1/ju/core/img/bdsj2.png) no-repeat -175px -25px;}

/*33067*/
.side_nav{top: 220px;}
.affix{top:0;}
.jzdcls{position: relative;}
.jzdcls b{display: block;width: 11px;height: 11px;position: absolute;right: -4px;top: 1px;background: url("/v1/ju/core/img/icon_head.png") no-repeat  0 0;overflow: hidden;}

/*37217 消息系统*/
.toolbar .msg-num{background:url(/v1/ju/core/img/msgs.png) no-repeat -18px 0;color:#fff;width:20px;height:13px;display:inline-block;padding-left:2px;text-align:center;*zoom:1;}
.toolbar .msg-tips{position:absolute;top:25px;left:639px;background-color:#fffca9;border:1px solid #ece0ba;padding:5px 30px 5px 12px;max-width:225px;color:#333;border-radius:3px;text-align:left;}
.toolbar .msg-tips a{color:#1582bd;text-decoration:underline;}
.toolbar .msg-tips .up-arr{position:absolute;background:url(/v1/ju/core/img/msgs.png) no-repeat -7px 0;width:11px;height:6px;top:-6px;left:88px;}
.toolbar .msg-tips .close-tips{background:url(/v1/ju/core/img/msgs.png) no-repeat 0 0;width:7px;height:7px; top:5px;right:5px;position:absolute;cursor:pointer;}
.toolbar .msg{line-height:13px;}
</style>

<div id="toolbar">
    <div class="toolbar area">
    <div id="login" class="right">
        <em id="tblogin">
        <a href="http://www.zhe800.com/login?return_to=http%3A%2F%2Fwww.zhe800.com%2F">登录</a>
        <a href="http://www.zhe800.com/signup?return_to=http%3A%2F%2Fwww.zhe800.com%2F">会员注册</a>

        <span>您好，</span>
        <a href="http://www.zhe800.com/profile/recheck" class="user" target="_blank">hugedalin</a>

        <div class="dropdown myzhe">
            <a href="http://www.zhe800.com/jifen/profile/score_histories/all" target="_blank">我的折800<i class="icon-arrow arrow-down"></i></a>
            <ul class="dropdown-menu">
            <li><a href="http://passport.tuan800.com/account/safe" target="_blank" class="trigger">账号信息</a></li>
            <li><a href="http://www.zhe800.com/profile/my_invitation/mode" target="_blank" class="trigger">邀请好友</a></li>
            <li><a href="http://www.zhe800.com/profile/my_favorites/all" target="_blank" class="trigger">我的收藏</a></li>
            <li><a href="http://www.zhe800.com/jifen/profile/score_histories/all" target="_blank" class="trigger">我的积分</a></li>
            <li><a class="exit" href="javascript:PassportCardList[0].doLogout();">退出</a></li>
            </ul>
        </div>
        </em>
        <div class="hidden"></div>
        <script type="text/javascript">
        tuanpub.getModule("toolbar_pp").init();
        </script>
    </div>
    </div>
</div>
