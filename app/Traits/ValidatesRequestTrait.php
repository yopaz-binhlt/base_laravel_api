<?php

namespace App\Traits;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

trait ValidatesRequestTrait
{


    /**
     * Validate request data
     *
     * @param array       $data
     * @param FormRequest $formRequestClass
     *
     * @return array
     *
     * @throws ValidationException
     */
    public function validateRequest(array $data, FormRequest $formRequestClass)
    {
        $request = new $formRequestClass();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();

    }//end validateRequest()


}
