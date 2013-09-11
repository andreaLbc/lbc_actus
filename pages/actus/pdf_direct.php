<?php
/**
 * Elgg profile icon cache/bypass
 * 
 * 
 * @package ElggProfile
 */

group_gatekeeper();

global $CONFIG;

// get the variables
$guid = get_input('guid', null);

// set file name
$file = md5($guid).'.pdf';

// set dir
$data_root = $CONFIG->dataroot;
$filename = "{$data_root}documents/{$guid}/files/{$file}";

//get file content
$contents = @file_get_contents($filename);

if (!empty($contents)) {
	header("Content-type: application/pdf");
	header('Expires: ' . date('r', strtotime("+6 months")), true);
	header("Pragma: public");
	header("Cache-Control: public");
	header("Content-Length: " . strlen($contents));
	header("ETag: $etag");

	// this chunking is done for supposedly better performance
	$split_string = str_split($contents, 1024);
	foreach ($split_string as $chunk) {
			echo $chunk;
	}
	exit;
}
		
forward();
