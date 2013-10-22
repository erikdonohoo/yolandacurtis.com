<?php

/**** Scripts for accepting, validating, renaming, and storing photo uploads ****/

//Setup the image, it's extension, and the list of allowd extensions
$image = $_FILES["name_of_input_field_used"];
$extension = end(explode(".", $image["name"]));
$allowedExts = array("jpg", "JPG", "jpeg", "JPEG", "gif", "GIF", "png", "PNG");

//If the upload was successful
if(!$image["error"]){
	//If $image's extension is allowed
	if(in_array($extension, $allowedExts)){
		//If $image meets size requirement
		if($image["size"] < image_size_limit){
			//Move file to new location and rename it something unique
			move_uploaded_file($image["tmp_name"], "you_relative_file_path" . $image["name"]);
			rename('your_relative_file_path' . $image["name"], 'your_relative_file_path/img' . $unique_id . '.' . $extension);
		}
	}
}
else{
	echo "Return Code: " . $_FILES["image"]["error"] . "<br>";
}

/******** OR ********/

class ImageUploader{

	protected
		$size_limit,
		$allowed_extensions;
		$failed_saves;

	public function __construct(int $limit, array $extensions){
		$this->size_limit = $limit;
		$allowed_extensions = $extensions;
	}

	public function saveImage(array $images){
		foreach($images as $image){
			if($this->meetsSizeLimit($image['size'])){
				if($this->hasValidExtension(end(explode(".", $image["name"])))){
					$this->storeImage($image, $this->getNextImageIndex());
				}
				else 	$failed_saves[$image["name"]] = "Invalid file type.";
			}
			else 	$failed_saves["name"] = "File is too large.";
		}
		return $failed_saves;
	}

	public function meetsSizeLimit(int $size){
		return $size <= $this->size_limit;
	}

	public function hasValidExtension(string $extention){
		return in_array($extension, $this->allowed_extensions)
	}

	public function storeImage($image, $unique_id){
		move_uploaded_file($image["tmp_name"], "you_relative_file_path" . $image["name"]);
		rename('your_relative_file_path' . $image["name"], 'your_relative_file_path/img' . $unique_id . '.' . $extension);
	}

	public function getNextImageIndex(){
		//Code to get the next available image id
	}
}

?>