<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $validate = [];

        $validate += [
            'content_title' => [
                'required',
                'max:30'
            ]
        ];

        $validate += [
            'content' => [
                'required',
                'max:2500'
            ]
        ];

        $validate += [
            'image_title' => [
                'max:30'
            ]
        ];

        $validate += [
            'related_word1' => [
                'max:30'
            ]
        ];

        $validate += [
            'related_word2' => [
                'max:30'
            ]
        ];

        $validate += [
            'related_word3' => [
                'max:30'
            ]
        ];

                // $validate += [
        //     '' => [
        //         '',
        //     ]
        // ];

        return $validate;
    }


    public function messages()
    {
        return [
            'content_title.required'    => '入力必須です',
            'content_title.max'         => 'およそ30文字以内で入力してください',

            'content.required'          => '入力は必須です',
            'content.max'               => 'およそ2500文字以内で入力してください',

            'image_title.max'           => 'およそ30文字以内で入力してください',

            'related_word1.max'         => 'およそ30文字以内で入力してください',
            'related_word2.max'         => 'およそ30文字以内で入力してください',
            'related_word3.max'         => 'およそ30文字以内で入力してください',
        ];
    }


}
