Framework
=========

MVC PHP Framework

### Directory structure

* application/
	+ Controller/
		* BaseController.php
		* IndexController.php
	+ Model/
		+ BaseModel.php
		+ User.php
	+ View/
		* Elements/
			+ navigation.php
		* Index/
			+ login.php
		* Layouts/
			+ auth.php
			+ panel.php
		* BaseView.php
* library/
	+ Controller/
		* Component/
			+ AuthComponent.php
			+ SessionComponent.php
		* Component.php
		* Controller.php
	+ Model/
		* Model.php
	+ Database.php
	+ Router.php
* index.php