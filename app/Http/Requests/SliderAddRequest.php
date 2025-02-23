<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
        return [
            'name' => 'required|unique:sliders|max:255',
            'description' => 'required',
            'image_path' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    /**
     * Custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên slider là bắt buộc.',
            'name.unique' => 'Tên slider đã tồn tại, vui lòng chọn tên khác.',
            'name.max' => 'Tên slider không được vượt quá 255 ký tự.',
            
            'description.required' => 'Mô tả slider là bắt buộc.',

            'image_path.required' => 'Hình ảnh slider là bắt buộc.',
            'image_path.image' => 'File tải lên phải là một hình ảnh.',
            'image_path.mimes' => 'Hình ảnh slider phải có định dạng: jpg, jpeg, png.',
            'image_path.max' => 'Hình ảnh slider không được vượt quá 2MB.',
        ];
    }
}
