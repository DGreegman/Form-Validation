<?php 

class FileUpload{

    public $errors;

    public function __construct()
    {
        $this->errors = array();
    }

    public function uploadFiles()  {

        if (empty($_FILES['avatar']['name'])) {
            $this->errors[] = '<span class="text-red-600">Profile avatar is mandatory</span>';
        } else {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
    
            // Check if it's a valid image file
            if (!in_array($fileExtension, $allowedExtensions)) {
                $this->errors[] = '<span class="text-red-600">Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.</span>';
            }
    
            // Check if the file size is within limits (2MB in this example)
            if ($_FILES['avatar']['size'] > 2 * 1024 * 1024) {
                $this->errors[] = '<span class="text-red-600">File size exceeds the maximum limit (2MB).</span>';
            }
        }
       return $this->errors; 
    }
}