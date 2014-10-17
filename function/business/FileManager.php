<?php

class FileManager{
	const DEFAULT_PERMISSION = 755;
	
	private $fileType = [
		"image/x-png",
		"image/jpeg",
		"image/gif",
		"image/bmp"
	];
	
	private $upload_errors = array(
		0						=>	"There is no error, the file uploaded with success",
		UPLOAD_ERR_INI_SIZE		=>	"The uploaded file exceeds the upload_max_filesize directive in php.ini",
		UPLOAD_ERR_FORM_SIZE	=>	"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
		UPLOAD_ERR_PARTIAL		=>	"The uploaded file was only partially uploaded",
		UPLOAD_ERR_NO_FILE		=>	"No file was uploaded",
		UPLOAD_ERR_NO_TMP_DIR	=>	"Missing a temporary folder",
		UPLOAD_ERR_CANT_WRITE	=>	"Failed to write to disk",
		UPLOAD_ERR_EXTENSION	=>	"File upload stopped by extension"
	);
	
	
	public function t(){
		
	}
?>
