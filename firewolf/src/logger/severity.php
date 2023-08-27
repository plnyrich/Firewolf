<?php

/**
 * File: severity.php
 * Author: katcdavi
 * Date: 02/07/2023
 * License: GNU GPLv3
 */

namespace Firewolf\Logger;

enum Severity: int
{
	case DEBUG = 0;
	case INFO = 1;
	case WARN = 2;
	case ERROR = 3;
	case FATAL = 4;

	public function asString(): string
	{
		return match ($this) {
			Severity::DEBUG => 'DEBUG',
			Severity::INFO => 'INFO',
			Severity::WARN => 'WARN',
			Severity::ERROR => 'ERROR',
			Severity::FATAL => 'FATAL',
		};
	}
}
