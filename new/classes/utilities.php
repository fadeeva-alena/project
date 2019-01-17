<?php

if(!function_exists('lcfirst')) {
	function lcfirst($str) {
		if(0 == strlen($str)) {
			return '';
		}

		if(1 == strlen($str)) {
			return strtolower($str);
		}

		return strtolower(substr($str, 0, 1)) . substr($str, 1);
	}
}

if(!function_exists('strendswith')) {
	function strendswith($str, $end, $caseSensitive = true) {
		if(strlen($str) < strlen($end)) {
			return false;
		}

		return 0 == substr_compare($str, $end, strlen($str) - strlen($end), strlen($end), !$caseSensitive);
	}
}

if(!function_exists('strstartswith')) {
	function strstartswith($str, $start, $caseSensitive = true) {
		if(strlen($str) < strlen($start)) {
			return false;
		}

		return 0 == substr_compare($str, $start, 0, strlen($start), !$caseSensitive);
	}
}

if(!function_exists('strgetfirst')) {
	function strgetfirst($str, $count) {
		if(strlen($str) < $count) {
			return $str;
		}

		return substr($str, 0, $count);
	}
}

if(!function_exists('strgetlast')) {
	function strgetlast($str, $count) {
		if(strlen($str) < $count) {
			return $str;
		}

		return substr($str, strlen($str) - $count);
	}
}

?>