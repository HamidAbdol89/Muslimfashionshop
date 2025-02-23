<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
{
    /**
     * Xác định quyền cho request này.
     */
    public function authorize()
    {
        return true; // Đặt là true nếu bạn muốn tất cả người dùng đều có thể gửi request này
    }

    /**
     * Các quy tắc xác thực.
     */
	public function rules()
	{
    return [
        'name' => 'bail|required|string|max:255|unique:products,name,' . $this->id, // Kiểm tra trùng tên (ngoại trừ sản phẩm hiện tại khi sửa)
        'price' => 'bail|required|numeric|min:0',
        'category_id' => 'bail|required|exists:categories,id',
        'feature_image_path' => 'bail|nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'image_path.*' => 'bail|nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ];
	}


    /**
     * Tùy chỉnh thông báo lỗi.
     */
    public function messages()
{
    return [
        'name.required' => 'Vui lòng nhập tên sản phẩm.',
        'name.string' => 'Tên sản phẩm phải là chuỗi ký tự.',
        'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
        'name.unique' => 'Tên sản phẩm đã tồn tại, vui lòng chọn tên khác.',

        'price.required' => 'Vui lòng nhập giá sản phẩm.',
        'price.numeric' => 'Giá sản phẩm phải là một số.',
        'price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0.',

        'category_id.required' => 'Vui lòng chọn danh mục.',
        'category_id.exists' => 'Danh mục không tồn tại.',

        'feature_image_path.image' => 'Ảnh đại diện phải là một file ảnh.',
        'feature_image_path.mimes' => 'Ảnh đại diện phải có định dạng: jpg, jpeg, png, gif.',
        'feature_image_path.max' => 'Ảnh đại diện không được vượt quá 2MB.',

        'image_path.*.image' => 'Ảnh chi tiết phải là một file ảnh.',
        'image_path.*.mimes' => 'Ảnh chi tiết phải có định dạng: jpg, jpeg, png, gif.',
        'image_path.*.max' => 'Ảnh chi tiết không được vượt quá 2MB.',
    ];
}

}
