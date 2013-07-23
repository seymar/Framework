<!doctype html>
<html>
	<head>
		<title>Devcube Development</title>
		
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.5, user-scalable=no" />
		
		<link rel="stylesheet/less" type="text/css" href="/css/main.less" />
		<script src="/js/less.js"></script>
	</head>
	
	<body>
		<section class="row light">
			<header class="container">
				<div class="banner-wrapper">
					<a href="/">
						<div class="cube-wrapper">
							<div class="cube">
								<figure class="top"></figure>
								<figure class="front"></figure>
								<figure class="right"></figure>
							</div>
						</div>
					</a>
					
					<div class="logo-wrapper">
						<h1><a href="/">Devcube <span class="blue">Development</span></a></h1>
						<h2>Web development & mechatronics</h2>
					</div>
				</div>
				
				<nav>
					<ul>
						<?php $this->element('navigation'); ?>
					</ul>
				</nav>
			</header>
		</section>
	        
		<?php echo $content; ?>
		
		<section class="row grey">
			<footer class="container">
				<span class="col-4">&copy; <?php echo date('Y'); ?> <a href="/">Devcube Development</a></span>
				<span class="col-4 center">
					<ul class="horizontal">
						<li><a href="about/">about</a></li>
						<li><a href="portfolio/">portfolio</a></li>
						<li><a href="blog/">blog</a></li>
						<li><a href="contact/">contact</a></li>
					</ul>
				</span>
				<span class="col-4"></span>
			</footer>
		</section>
    </body>
    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-42191936-1', 'devcube.nl');
      ga('send', 'pageview');
    
    </script>
</html>