<?php

# Includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Storage as Storage;

$disk = Storage::disk('gcs');

// check if a file exists
$exists = $disk->exists('test.png');

if($exists !== false) {
// get file modification date
$time = $disk->lastModified('test.png');

echo "The last modified date for our file was: $time\n";
// copy a file
// $disk->copy('old/file1.jpg', 'new/file1.jpg');

// move a file
// $disk->move('old/file1.jpg', 'new/file1.jpg');

// get url to file
$url = $disk->url('images/test.png');
} else {
	echo "Unable to find file at: " . $disk->url('images/test.png');
}

?>
