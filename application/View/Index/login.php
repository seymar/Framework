<?php

$layout = 'auth';

?><form action="" method="post"><?php echo $_SESSION['flash']; ?>
	<input type="email" name="email" />
	<input type="password" name="password" />
	<input type="submit" name="submitButton" value="Login" />
</form>