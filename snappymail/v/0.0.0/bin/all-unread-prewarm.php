<?php

$root = \dirname(__DIR__, 4);
\chdir($root);

$_ENV['SNAPPYMAIL_INCLUDE_AS_API'] = '1';
\define('SNAPPYMAIL_INCLUDE_AS_API', 1);
\define('APP_VERSION', \basename(\dirname(__DIR__)));
\define('APP_INDEX_ROOT_PATH', $root . \DIRECTORY_SEPARATOR);

require __DIR__ . '/../include.php';

$force = \in_array('--force', $argv, true);

try {
	$result = \RainLoop\Api::Actions()->AllUnreadPrewarmCycle($force);
	echo \json_encode($result, \JSON_UNESCAPED_SLASHES) . "\n";
} catch (\Throwable $e) {
	\fwrite(STDERR, $e->getMessage() . "\n");
	exit(1);
}
