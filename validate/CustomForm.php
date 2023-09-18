<?php

class CustomForm{
    
    public $form;

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

            $this->form = form();
    }

    public function validateForm(){
        $this->form->submit([
            'string:name' => "Name is Required",
            'str_len:name:<:5' => "Name is less than 5 characters",
            'int:age' => "Age is Required",
            'int:age:<:18' => "Age is less than 18",
            'array:activities' => "You Must Select Atleast One Parameter"
        ])->error(function($response){
            
            $param = $response->param;
            
            // return $param;
            
        });
    }

    public function checkbox($attribute='activities', $key=null){

        if (isset($this->form->old($attribute)[$key])) {
           return 'checked';
        }

    }
}