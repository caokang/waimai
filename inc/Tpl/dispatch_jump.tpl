<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>


<style type="text/css">
body{ background-color: #eee; font-family: '微软雅黑'; color: #333; font-size: 16px;  padding-top: 10px;
  }
.system-message{ padding: 1px 48px;}
.system-message h1{ font-size: 100px; font-weight: 900; line-height: 120px; margin-bottom: 12px; }
.system-message h1 small{ font-size: 16px; font-weight: 300; color: #333; }
.system-message .jump{ padding-top: 10px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}

.container {
    margin-left: auto;
    margin-right: auto;
    padding-left: 15px;
    padding-right: 15px;
}

.form-signin {
  max-width: 630px;
  padding: 15px;
  margin: 0 auto;
}
</style>
</head>
<body>


<div class="container">

      <div class="form-signin">
	  
        <div class="system-message">
<present name="message">
<h1 style="color:green">√ <small><?php echo($message); ?></small></h1>

<else/>
<h1 style="color:red">× <small><?php echo($error); ?></small></h1>

</present>
<p class="detail"></p>
<p class="jump">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</p>
</div>
      </div>

    </div>



<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>