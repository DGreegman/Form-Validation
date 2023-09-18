<?php 

class FileUpload{

    public $errors;

    public function __construct()
    {
        $this->errors = array();
    }
    
    /**
     * uploadFiles
     *
     * @return mixed
     */
    public function uploadFiles()  
    {

        if (empty($_FILES['avatar']['name'])) {
            $this->errors[] = 'Profile avatar is mandatory';
        } else {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
    
            // Check if it's a valid image file
            if (!in_array($fileExtension, $allowedExtensions)) {
                $this->errors[] = 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.';
            }
    
            // Check if the file size is within limits (2MB in this example)
            if ($_FILES['avatar']['size'] > 2 * 1024 * 1024) {
                $this->errors[] = 'File size exceeds the maximum limit (2MB).';
            }
        }

        return $this->errors; 
    }
    
    /**
     * save
     *
     * @param  mixed $folder
     * @return void
     */
    public function save($folder = 'uploads')
    {
        // name of uploaded file
        $targetName = basename($_FILES['avatar']['name']);

        // extension name
        $targetExtension = pathinfo($targetName, PATHINFO_EXTENSION);

        // realpath to main directory
        $directoryPath = str_replace('\updated', '', __DIR__);
        $directoryPath = str_replace('\\', '/', $directoryPath);
        $directoryPath = trim($directoryPath, '/') . "/{$folder}/";

        // if directory does'nt exists
        if(!is_dir($directoryPath)){
            mkdir($directoryPath, 0777);
        }

        // We shuffle the name and wrap using md5 for random name generating
        // we append to time and include the file extension name
        $targetFile = md5(str_shuffle($targetName)) . '_'. strtotime('now') . ".{$targetExtension}";


        // uploade file path
        $uploadedPath = "{$directoryPath}{$targetFile}";

        move_uploaded_file(
            $_FILES['avatar']['tmp_name'], 
            $uploadedPath
        );

        return $uploadedPath;
    }
    
}