<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">    
	<title>失物招领-发布</title>
	<link rel="stylesheet" href="/lostandfound/css/issue.css">
	<link rel="stylesheet" href="/lostandfound/css/zepto.mdatetimer.css">
</head>
<body>
	<div class="shade"></div>
	<p class = "info-device">
		<span class="item">
			信息分类
		</span>
		<img src="/lostandfound/img/arrow.png" alt="." class = "content">
	</p>
	<ul class = "list" id = "info-item">
		<li class="list-item">全部分类</li>
    	<li class="list-item">寻物启事</li>
   		<li class="list-item">失物招领</li>
  	</ul>

	<p class = "things-device">
		<span class="item">
			物品分类
		</span>
		<img src="/lostandfound/img/arrow.png" alt="." class = "content">
	</p>
	<ul class = "list" id = "things-item">
		<li class="list-item">全部分类</li>
    	<li class="list-item">一卡通</li>
    	<li class="list-item">钱包</li>
    	<li class="list-item">电子产品</li>
    	<li class="list-item">书包</li>
    	<li class="list-item">钥匙</li>
    	<li class="list-item">雨伞</li>
    	<li class="list-item">衣物</li>
   		<li class="list-item">其他</li>
  	</ul>

	<p class = "detail">
		<textarea placeholder = "请输入10-100字对您的物品进行描述"></textarea>
	</p>
	<p class = "time">
		<span class="item">
			时间
		</span>
		<img src="/lostandfound/img/arrow.png" alt="." class = "content">
		<input class = "info" id="picktime" value="2016-05-05" readonly>
	</p>
	<p class = "location">
		<span class="item">
			地点
		</span>
		<input class="info" id = "place" placeholder = "请填写地点"> 
		</input>
	</p>
	<p class = "phone">
		<span class="item">
			电话
		</span>
		<input class="info" id = "phone" placeholder = "请填写电话号码">
	</p>
	<p class = "qq">
		<span class="item">
			QQ
		</span>
		<input class="info" id = "qq" placeholder = "请填写QQ号码">
	</p>
	<div id = "issue">
		发布
	</div>
</body> 
<script src="http://a.alipayobjects.com/??amui/zepto/1.1.3/zepto.js,static/fastclick/1.0.6/fastclick.min.js"></script>
<script src = "/lostandfound/js/zepto.mdatetimer.js"></script>
<script src = "/lostandfound/js/issue.js"></script>
<script>
	$(function(){
		$('#picktime').mdatetimer({
			mode : 1, //时间选择器模式：1：年月日，2：年月日时分（24小时），3：年月日时分（12小时），4：年月日时分秒。默认：1
			format : 2, //时间格式化方式：1：2015年06月10日 17时30分46秒，2：2015-05-10  17:30:46。默认：2
			years : [2014,2015,2016, 2017,2018,2019,2020], //年份数组
			nowbtn : true, //是否显示现在按钮
		});	
	});
</script>
</html>