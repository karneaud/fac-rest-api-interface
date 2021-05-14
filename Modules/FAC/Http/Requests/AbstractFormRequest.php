<?php

namespace Modules\FAC\Http\Requests;

use Illuminate\Http\Request;

abstract class AbstractFormRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules() : array;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize() : bool;
}
