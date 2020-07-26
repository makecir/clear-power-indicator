<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Validation\Validator;

class CSVForm extends Form
{
    protected function validationUpdate(Validator $validator)
    {
        //$validator->provider('customValidate', 'App\Model\Validation\CustomValidation');
        // $validator
        //   ->add('upload_file', 'limitFileSize', [
        //     'provider' => 'customValidate',
        //     'rule' => 'limitFileSize',
        //     'message' => '20Mバイト以内にしてください',
        //   ]);

        return $validator;
    }
}