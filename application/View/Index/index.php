<section class="row dark">
	<div class="container">
		<div class="col-9 intro">
			<p>
				<img src="/img/profile.jpg" id="profile-pic" onclick="alert(document.body.clientWidth);" class="left" height="180" width="180" alt="Photo">
				<?php $this->cms->content('Intro'); ?>
			</p>
		</div>
		<div class="col-3 skills">
			<ul class="list">
				<li>PHP &amp; MySQL</li>
				<li>HTML &amp; CSS</li>
				<li>JavaScript &amp; jQuery</li>
				<li>LESS &amp; Sass</li>
				<li>Node.js &amp; WebSockets</li>
				<li>MVC &amp; OOP</li>
				<li>CakePHP</li>
			</ul>
		</div>
	</div>
</section>

<section class="row">
	<div class="container">
		<h3 class="col-12 center latest-work-heading">Some of my latest work</h3>
		<br>
		<br>
		<br>
		<br>
		<div class="col-4 project">
			<a href="#"><img src="/img/portfolio/roosterwebapp.jpg" height="175" width="350" alt="Screenshot"></a>
			<div class="caption">
				<a href="#"><h4>Rooster web-app</h4></a>
				<p>
					School timetable information made easy to access on iPad and iPhone.
				</p>
			</div>
		</div>
		<div class="col-4 project">
			<a href="#"><img src="/img/portfolio/cms.png" height="175" width="350" alt="Screenshot"></a>
			<div class="caption">
				<a href="#"><h4>CMS</h4></a>
				<p>
					Content management system for my personal website.
				</p>
			</div>
		</div>
		<div class="col-4 project">
			<a href="#"><img src="/img/portfolio/game.png" height="175" width="350" alt="Screenshot"></a>
			<div class="caption">
				<a href="#"><h4>Web based multiplayer game</h4></a>
				<p>
					Experiment to check out some of the newest technologies such as Node.
				</p>
			</div>
		</div>
	</div>
</section>