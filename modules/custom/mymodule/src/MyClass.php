<?php 

namespace Drupal\mymodule;

class MyClass {
	
	public function drupal7_to_drupal8($string) {
		$str = str_replace('Drupal 7', 'Drupal 8', $string);
		return $str;
	}

	public function my_array_range() {
		$rand_arr = range(1, 5);
		return $rand_arr;
	}
	
}
