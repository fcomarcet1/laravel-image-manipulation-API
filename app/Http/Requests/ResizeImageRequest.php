<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class ResizeImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules =  [
            'image' => ['required'],
            'w' => ['required', 'regex:/^\d+(\.\d+)?%?$/'], // 50, 50.5, 50.5%, 50%, 50.123, 50.123%
            'h' => 'regex:/^\d+(\.\d+)?%?$/', // 50, 50.5, 50.5%, 50%, 50.123, 50.123%
            'album_id' => 'required|exists:albums,id',
        ];

        $image = $this->all()['image'] ?? false;

        // check if image ig generated from url http://s3.amazomws.com/uploads/2020/11/235
        // or uploaded file image.jgp
        if ($image instanceof UploadedFile) {
            $rules['image'][] =  'image';
        }else {
            $rules['image'][] =  'url';
        }
        return $rules;

        /*$rules = [
            'image' => ['required'],
            'w' => ['required', 'regex:/^\d+(\.\d+)?%?$/'], // 50, 50.5, 50.5%, 50%, 50.123, 50.123%
            'h' => 'regex:/^\d+(\.\d+)?%?$/'
        ];
        // get all of the request inputs and files.
        $all = $this->all();

        if (isset($all['image']) && $all['image'] instanceof UploadedFile) {
            $rules['image'][] = 'image';
        } else {
            $rules['image'][] = 'url';
        }

        return $rules;*/
    }

    public function messages()
    {
        return [
            'w.regex' => 'Please specify width as a valid number in pixels or in %',
            'h.regex' => 'Please specify height as a valid number in pixels or in %',
        ];
    }
}
