<?php

/**
 * File: fileLogger.php
 * Author: katcdavi
 * Date: 02/07/2023
 * License: GNU GPLv3
 */

namespace Firewolf\Logger;

require_once('logger.php');
require_once('severity.php');

class FileLogger extends Logger
{
	private $file = null;

	public function __construct(string $pathPrefix = '', string $fileName = null, string $mode = 'w')
	{
		$fileName = $fileName ? $fileName : self::createLogFileName();
		$pathPrefix = self::fixPathPrefix($pathPrefix);
		$this->file = fopen($pathPrefix . $fileName, $mode);
	}

	public function __destruct()
	{
		fclose($this->file);
	}

	protected function log(string $message, Severity $severity)
	{
		$severityStr = $severity->asString();
		$timestamp = date('m/d/Y H:i:s', time());
		$logMessage = sprintf("[%-19s][%5s] %s\n", $timestamp, $severityStr, $message);

		fwrite($this->file, $logMessage);
	}

	private static function fixPathPrefix(string $pathPrefix): string
	{
		if (strlen($pathPrefix) > 0 && $pathPrefix[-1] != "/") {
			$pathPrefix .= '/';
		}
		return $pathPrefix;
	}

	private static function createLogFileName(): string
	{
		$timestamp = date('Ymd_His', time());
		return "fileLog_$timestamp.log.txt";
	}
}
