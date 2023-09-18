<?php

class CustomForm{
    
    public $form;
    public $file;

    public function __construct(){
        config_form([
            'request'       => 'POST',
            'error_type'    => true,
            'csrf_token'    => true,
            'class' => [
                'error' => 'text-red-400',
                'success' => 'text-green-400'
            ]
        ]);

        $this->file = new FileUpload();
        $this->form = form();
    }
    
    /**
     * validateForm
     *
     * @return mixed
     */
    public function validateForm(){
        
        $this->form->submit(
            $this->initilizeError()
        )->error(function($response){
            
            $param = $response->param;
            // return $param;
        })->success(function($response){
            $param = $response->param;

            // file upload path
            $param->uploadPath = $this->file->save();

            $response->message = "Form Submitted successfully: {$param->uploadPath}";
        });
    }

    
    /**
     * initilizeError
     *
     * @return array
     */
    private function initilizeError()
    {
        $data = [];
        
        // We're adding a non existing error into the 
        // form submit() method, if no image was uploaded along with the form
        $errors = $this->file->uploadFiles();
        if (!empty($errors)){

            // this error will only be added to form errors, as long as no file was attached with the form
            // we can even use any error input name of choice, that doen't exist in the form
            // $data['string:someRandomInputName'] = $errors[0] ?? '';

            $data['string:avatar'] = $errors[0] ?? '';
        }
        
        return array_merge([
            'string:name' => "Name is Required",
            'str_len:name:<:5' => "Name is less than 5 characters", 
            'int:age' => "Age is Required",
            'int:age:<:18' => "Age is less than 18",
            'array:activities' => "You Must Select Atleast One Parameter"
        ], $data);
    }

    
    /**
     * checkbox
     *
     * @param  mixed $attribute
     * @param  mixed $key
     * @return mixed
     */
    public function checkbox($attribute='activities', $key=null){

        if (isset($this->form->old($attribute)[$key])) {
           return 'checked';
        }

    }
}