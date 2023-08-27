<?php

/**
 * File: logger.php
 * Author: katcdavi
 * Date: 02/07/2023
 * License: GNU GPLv3
 */

namespace Firewolf\Logger;

require_once('severity.php');

abstract class Logger
{
	public function logDebug(string $message)
	{
		$this->log($message, Severity::DEBUG);
	}

	public function logInfo(string $message)
	{
		$this->log($message, Severity::INFO);
	}

	public function logWarn(string $message)
	{
		$this->log($message, Severity::WARN);
	}

	public function logError(string $message)
	{
		$this->log($message, Severity::ERROR);
	}

	public function logFatal(string $message)
	{
		$this->log($message, Severity::DEBUG);
	}

	abstract protected function log(string $message, Severity $severity);
}
