<?php

namespace App\Helpers;

class viewHelper {

	/**
	 * To convert bytes into mb.
	 * 
	 * @param string $bytes
	 * 
	 * @return string
	*/
	function bytes_to_mb($bytes): string {
		
		if ($bytes < 0) {
			return 0;
		}

		$mb = $bytes / 1024 / 1024;

		return round($mb, 2);
	}

	/**
	 * To format the storage size..
	 * 
	 * @param string $mb
	 * 
	 * @return string
	*/
	function formatted_storage_size($mb): string {
		
		if ($mb < 0) {
			return "Invalid input (negative value)";
		}

		if ($mb < 500) {
			return round($mb, 2) . " MB";
		} else {
			$gb = $mb / 1024;
			return round($gb, 2) . " GB";
		}
	}
}