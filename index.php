<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title>投票系统</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/fu.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/style.js"></script>
	
</head>
<body oncontextmenu="return false;" onselectstart="return false">
	<div id="main">
		<div id="top">
			<p>java1班投票系统   </p>
		</div>
		<div id="main_left">

			<?php require_once 'ys_index.php'; ?>

			<!-- <div id="active"> -->
				<?php require_once 'wsp_tj.php';  ?>
			<!-- </div> -->
		</div>
		<div id="groups">
			<?php require_once 'ccad_tp.php';  ?>
		</div>
	</div>
	<div id="footer">
		<p>java1班&copy; 版权所有 仿冒必究</p>
	</div>
	
</body>
</html>