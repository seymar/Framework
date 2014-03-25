<?php

function pluralize($name) {
	if(substr($name, -1) == 'y') {
		return substr($name, 0, -1) . 'ies';
	} else if(substr($name, -3) == 'ess') {
		return $name . 'es';
	} else {
		return $name . 's';
	}
}