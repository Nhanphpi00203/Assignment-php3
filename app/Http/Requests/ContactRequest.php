<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		// return [
		//     'name' =>['required','min:2','max:20'],
		// ];
		return [
			'name'    => ['required', 'min:2', 'max:20'],
			'email'   => ['required', 'email'],
			// 'title'   => ['nullable', 'string', 'max:255'],
			// 'phone'   => ['nullable', 'string', 'max:20'],
			// 'descsription' => ['required', 'string', 'min:5'],
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array<string, string>
	 */
	public function messages(): array
	{
		// return [
		// 	'name.required' => 'Vui lòng nhập họ và tên',
		// 	'name.min' => 'Độ dài của tên tối thiểu 2 ký tự',
		// 	'name.max' => 'Độ dài của tên tối đa 20 ký tự',
		// ];
		return [
			'name.required' => 'Vui lòng nhập họ và tên',
			'name.min' => 'Độ dài của tên tối thiểu 2 ký tự',
			'name.max' => 'Độ dài của tên tối đa 20 ký tự',

			'email.required' => 'Vui lòng nhập email',
			'email.email' => 'Email không hợp lệ',

			'descsription.required' => 'Vui lòng nhập nội dung liên hệ',
			'descsription.min' => 'Nội dung phải ít nhất 5 ký tự',
		];
	}
}
