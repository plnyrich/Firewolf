<?php

/**
 * File: uriParser.php
 * Author: katcdavi
 * Date: 26/08/2023
 * License: GNU GPLv3
 */

namespace Firewolf\Utils\URI;

use Firewolf\Utils\String\StringUtils;

class UriParser
{
	private $fullPath = null;
	private $queryString = null;
	private $fragment = null;

	private $paths = [];
	private $args = [];

	public function __construct(string $uri)
	{
		$this->parse($uri);

		$this->paths = $this->parsePath($this->fullPath);
		$this->args = $this->parseQueryString($this->queryString);
	}

	public function getPath(): string
	{
		return $this->fullPath;
	}

	public function getQueryString(): string
	{
		return $this->queryString;
	}

	public function getFragment(): string
	{
		return $this->fragment;
	}

	public function hasNextPath(): bool
	{
		return count($this->paths) > 0;
	}

	public function getNextPath(): string
	{
		return array_shift($this->paths);
	}

	public function isArgSet(string $key): bool
	{
		return isset($this->args[$key]);
	}

	public function getArgValue(string $key): string
	{
		return $this->args[$key];
	}

	private function parse(string $uri)
	{
		$remainingUri = StringUtils::stripLeadingSlash($uri);

		$uriParts = $this->splitToTwoParts($remainingUri, "?");
		$this->fullPath = $uriParts[0];
		$remainingUri = $uriParts[1];

		$uriParts = $this->splitToTwoParts($remainingUri, "#");
		$this->queryString = $uriParts[0];
		$this->fragment = $uriParts[1];

		$this->paths = explode("/", $this->fullPath);
	}

	private function parsePath(string $path): array
	{
		return explode("/", $path);
	}

	private function parseQueryString(string $queryString): array
	{
		$args = explode("&", $queryString);
		$parsedArgs = [];
		foreach ($args as $arg) {
			if (strpos($arg, "=") === false) {
				$parsedArgs[$arg] = true;
			} else {
				$explodedArg = explode("=", $arg);
				$parsedArgs[$explodedArg[0]] = $explodedArg[1];
			}
		}
		return $parsedArgs;
	}

	private function splitToTwoParts(string $uri, string $separator): array
	{
		$parts = explode($separator, $uri);
		switch (count($parts)) {
			// It is empty
			case 0:
				return [
					'',
					''
				];
			// No separator found
			case 1:
				return [
					$parts[0],
					''
				];
			// Separator found once, return path and rest of URI
			case 2:
				return [
					$parts[0],
					$parts[1]
				];
			default:
				throw new \Exception("UriParser::splitToTwoParts(): More than one separator ($separator) found!");
		}
	}
}
