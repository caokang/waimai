<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title><?php echo $Title; ?> - <?php echo $Powered; ?></title>
<link rel="stylesheet" href="./css/install.css?v=9.0" />
<script src="js/jquery.js"></script>
</head>
<body>
<div class="wrap">
  <?php require './templates/header.php';?>
  <section class="section">
    <div class="">
      <div class="success_tip cc"> <a href="http://<?php echo $domain ?>/admin.php" class="f16 b">安装完成，进入后台管理</a>
		<p>为了您站点的安全，安装完成后即可将网站根目录下的“Install”文件夹删除。<p>
      </div>
      <div class=""> </div>
    </div>
  </section>
</div>

<?php require './templates/footer.php';?>
<div style="display:none;">
<script language="javascript" type="text/javascript" src="http://js.users.51.la/16868462.js"></script></div>
<script>
$(function(){
	$.ajax({
	type: "POST",
	url: "http://www.bijiadao.net/api/index.php",
	data: {host:'<?php echo $host;?>',ip:'<?php echo $ip?>'},
	dataType: 'json',
	success: function(){}
	});
});
</script>
</body>
</html>