<!doctype html>
<html>
	<head>
		<title>Logged in page</title>
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