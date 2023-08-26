<?php

/**
 * File: stringUtils.php
 * Author: katcdavi
 * Date: 26/08/2023
 * License: GNU GPLv3
 */

namespace Firewolf\Utils\String;

class StringUtils
{
	public static function stripLeadingSlash(string $string): string
	{
		if (str_starts_with($string, "/")) {
			return substr($string, 1);
		}
		return $string;
	}

	public static function stripTrailingSlash(string $string): string
	{
		if (str_ends_with($string, "/")) {
			return substr($string, 0, strlen($string) - 1);
		}
		return $string;
	}
}
