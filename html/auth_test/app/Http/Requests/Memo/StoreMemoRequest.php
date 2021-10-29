<?php

namespace App\Http\Requests\Memo;

use Illuminate\Foundation\Http\FormRequest;

//---------------------------------------
//以下より追加
//---------------------------------------
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreMemoRequest extends FormRequest
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
        return [
            'title' => ['required', 'string', 'max:255'], //入力必須、文字列、最大255
            'content' => ['required', 'string', 'max:255'],
        ];
    }

    //validationでエラーがあった時のエラーメッセージを以下で生成する。
    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください。', //入力が無かった場合のエラー文
            'content.required' => '内容を入力してください。',
        ];
    }

    //validationでエラーがでた時にjsonで返す。
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 400, //jsonの返事の中身のエラー番号
            'errors' => $validator->errors(),
        ],400); //実際に送られるresponse codeが400番　これが無いと、jsonでエラーメッセージは返ってくるけど送れらてくるのは200番のstatusOKとくる。

        //例外を知らせる。
        //throw new 例外クラス名（例外message）
        throw new HttpResponseException($response);
    }
}
