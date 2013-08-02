<!doctype html>
<html>
	<head>
		<title>Default Layout</title>
	</head>
	
	<body>
		<nav>
			<ul>
				<?php $this->element('navigation'); ?>
			</ul>
		</nav>

		<section>
				<?php echo $page; ?>
		</section>
	</body>
</html>