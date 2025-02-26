<?php

$options = getopt("hs:n:", ["help", "size::", "name::"]);

if (isset($options['h']) || isset($options['help'])) {
    echo "Usage: php dummy_file_generator.php -s 10 -n \"test.pdf\"\n";
    echo "Options:\n";
    echo "  -s, --size    Sets the size of the file (in MB)\n";
    echo "  -n, --name    Sets the name of the file\n";
    echo "  -h, --help    Displays this help message\n";
    exit(0);
}

$size = $options['s'] ?? $options['size'] ?? 10;
$name = $options['n'] ?? $options['name'] ?? null;

$sizeBytes = $size * 1024 * 1024;

$fileName = !is_null($name) ? $name : 'dummy_file_' . $size . 'MB.txt';

$file = fopen($fileName, 'w');

if ($file === false) {
    die('Unable to open the file.');
}

if (ftruncate($file, $sizeBytes) === false) {
    fclose($file);
    die('Unable to set the file size.');
}

fclose($file);

echo "File '$fileName' created successfully with a size of " . number_format($sizeBytes / 1024 / 1024, 2) . " MB.";

die;