<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">    
	<title>失物招领-详细信息</title>
	<link rel="stylesheet" href="/static/css/detail.css">
</head>
<body>
	<p class = "baseInfo">
		<img src="{{ $data->wx_avatar }}" alt="." class = "headImg">
		<span class="info">
			<span class = "name">{{ $data->pro_name }}</span><span class = "time">{{ $data->created_at }}</span>
        	<span class = "user">发布者：{{ $data->connect_name }}</span>
		</span>
	</p>
	<p class = "detail">
		<span class="left">
			描述
		</span>
		<span class="right">
			{{ $data->pro_description }}
		</span>
	</p>
	<p class = "losttime">
		<span class="left">
			时间
		</span>
		<span class="right">
			{{ $data->L_or_F_time }}
		</span>
	</p>
	<p class = "location">
		<span class="left">
			地点
		</span>
		<span class="right">
			{{ $data->L_or_F_place }}
		</span>
	</p>
	<p class = "connect">
		<span class="left">
			联系人
		</span>
		<span class="right">
			{{ $data->connect_name }}
		</span>
	</p>
	<p class = "phone">
		<span class="left">
			电话
		</span>
		<span class="right">
			{{ $data->connect_phone }}
		</span>
	</p>
	<p class = "qq">
		<span class="left">
			QQ
		</span>
		<span class="right">
			{{ $data->connect_wx }}
		</span>
	</p>
	<span class="bottom">红岩网校工作站&青协共同出品</span>
</body>
 <script src="http://a.alipayobjects.com/??amui/zepto/1.1.3/zepto.js,static/fastclick/1.0.6/fastclick.min.js"></script>
</html>