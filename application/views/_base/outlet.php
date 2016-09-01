<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('_base/head'); ?>
	</head>
	<body>
		<div id="wrapper">
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<?php $this->load->view('_base/nav');?>
				<?php $this->load->view('_base/side');?>
			</nav>
			<div id="page-wrapper">
				<div class="container-fluid">
					<?php echo $outlet;?>
				</div>
			</div>
		</div>
		<?php $this->load->view('_base/foot'); ?>
	</body>
</html>