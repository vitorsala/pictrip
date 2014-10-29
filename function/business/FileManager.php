<?php
include_once 'function/business/exception/UploadException.php';

/**
 * @todo implementar os métodos
 * @author Vitor Kawai Sala
 *
 */
class FileManager{
	/** @var Permissão padrão */
	const DEFAULT_PERMISSION = 755;
	/** @var Raíz da pasta de imagens */
	const IMAGE_FOLDER_ROOT = "image/upload/";
	
	const AVATAR = 0;
	const PHOTO = 1;
	
	/** @var Tipos de arquivos aceito */
	private $fileType = [
		"image/x-png",
		"image/jpeg",
		"image/gif",
		"image/bmp"
	];
	/** @var Mensagens de erro de upload */
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
	
	private function checkDirectory($userMail){
		$path = $this::IMAGE_FOLDER_ROOT."$userMail";
		if(!file_exists($path)){
			mkdir($path, $this::DEFAULT_PERMISSION, true);
		}
		return $path;
	}
	
	public function upload($type, $file, $userMail){
		if($file['error'] != 0){
			throw new UploadException($this->upload_errors[$file['error']],1);
		}
		
		if(array_search($file['type'], $tiposAceitos) == FALSE){
			throw new UploadException("Tipo não permitido!	Utilize apenas JPG,BMP,PNG ou GIF",1);
		}
		
		if($file['size'] == 0 || $file['tmp_name'] == NULL){
			throw new UploadException("Arquivo vazio!",1);
		}
		
		if($file['size'] > $tamanho){
			throw new UploadException("Arquivo muito grande!",1);
		}
		
		if($type == $this::AVATAR)		$upType = "avatar";
		elseif($type == $this::PHOTO)	$upType = "photo";
		else							$upType = "other";
		
		$fileName = date('Y-m-d h.i.s')."-".$file['name'];
		//$path_info = pathinfo($fileName);
		$path = $this->checkDirectory($userMail)."/$upType/";
		$path .= $fileName;
		echo "$path<br/>";
		if(move_uploaded_file($file['tmp_name'],$path)){
			return $path;
		}
		else{
			throw new UploadException("Ocorreu um erro ao tentar mover o arquivo", -1);
		}
	}
	
}
?>
