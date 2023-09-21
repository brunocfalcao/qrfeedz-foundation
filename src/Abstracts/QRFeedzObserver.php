<?php

namespace QRFeedz\Foundation\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class QRFeedzObserver
{
    protected function validate(Model $model, array $rules)
    {
        $validator = Validator::make($model->getAttributes(), $rules);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->messages()->toArray());
        }
    }
}
