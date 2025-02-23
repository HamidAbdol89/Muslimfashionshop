<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use App\Models\Slider;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\Storage;


class SliderAdminController extends Controller
{
    use StorageImageTrait, DeleteModelTrait;

    private $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    /**
     * Danh sách slider.
     */
    public function danhsach(Request $request)
{
    // Lấy danh sách slider và phân trang
    $sliders = Slider::paginate(5);

    // Kiểm tra nếu yêu cầu là AJAX
    if ($request->ajax()) {
        // Trả về dữ liệu bảng và phân trang
        return response()->json([
            'data' => view('admin.slider.table_data', compact('sliders'))->render(),
            'pagination' => (string) $sliders->links()
        ]);
    }

    // Nếu không phải AJAX, trả về view bình thường
    return view('admin.slider.danhsach', compact('sliders'));
}


    /**
     * Hiển thị trang thêm mới slider.
     */
    public function them()
    {
        return view('admin.slider.them');
    }

    /**
     * Xử lý lưu slider mới.
     */
    // Trong SliderAdminController
public function store(SliderAddRequest $request)
{
    $dataInsert = [
        'name' => $request->name,
        'description' => $request->description
    ];

    // Upload ảnh cho slider
    $dataImageSlider = $this->storageTraitUploadSlider($request, 'image_path', 'slider');
    
    if ($dataImageSlider) {
        $dataInsert['image_name'] = $dataImageSlider['file_name'];
        $dataInsert['image_path'] = $dataImageSlider['file_path'];
    } else {
        return back()->with('error', 'Vui lòng chọn ảnh');
    }

    // Lưu slider vào cơ sở dữ liệu
    $this->slider->create($dataInsert);
     // Thêm thông báo thành công cho phần thêm
    return redirect()->route('slider.danhsach')->with('add_success', 'Slider đã được thêm thành công!');
}

	public function sua($id)
	{
		$slider = $this->slider->find($id);
		return view('admin.slider.sua', compact('slider'));
	}



    

	public function update(Request $request, $id)
{
    // Lấy slider từ cơ sở dữ liệu
    $slider = $this->slider->find($id);

    if (!$slider) {
        return redirect()->route('slider.danhsach')->with('error', 'Slider không tồn tại!');
    }

    // Chuẩn bị dữ liệu để cập nhật
    $dataUpdate = [
        'name' => $request->input('name'),  // Lấy giá trị từ form
        'description' => $request->input('description')  // Lấy giá trị từ form
    ];

    // Kiểm tra nếu có ảnh mới được chọn
    if ($request->hasFile('image_path')) {
        // Upload ảnh mới
        $dataImageSlider = $this->storageTraitUploadSlider($request, 'image_path', 'slider');
        
        // Cập nhật ảnh mới vào dữ liệu
        if ($dataImageSlider) {
            $dataUpdate['image_name'] = $dataImageSlider['file_name'];
            $dataUpdate['image_path'] = $dataImageSlider['file_path'];

            // Xóa ảnh cũ nếu có ảnh mới
            if ($slider->image_path) {
                Storage::delete($slider->image_path);
            }
        } else {
            return back()->with('error', 'Vui lòng chọn ảnh hợp lệ');
        }
    } else {
        // Nếu không có ảnh mới, giữ nguyên ảnh cũ
        $dataUpdate['image_name'] = $slider->image_name;
        $dataUpdate['image_path'] = $slider->image_path;
    }

    // Cập nhật thông tin slider vào cơ sở dữ liệu
    $slider->update($dataUpdate);

    // Thêm thông báo thành công vào session
    return redirect()->route('slider.danhsach')->with('success', 'Cập nhật slider thành công!');
}



public function xoa($id)
{
    try {
        $slider = Slider::find($id);
        if ($slider) {
            $slider->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Xóa thành công.',
            ], 200);
        }

        return response()->json([
            'code' => 404,
            'message' => 'Không tìm thấy slider.',
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'code' => 500,
            'message' => 'Đã xảy ra lỗi khi xóa.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

public function index()
    {
        // Lấy dữ liệu slider từ cơ sở dữ liệu
        $sliders = Slider::orderBy('created_at', 'desc')->get();


        // Trả về view với dữ liệu sliders
        return view('frontend.Bosuutap.index', compact('sliders'));
    }

    public function showBillboard()
{
    $sliders = Slider::whereIn('id', [1, 2, 3, 4, 5, 6])->get();
    return view('frontend.billboard-section', compact('sliders')); // Truyền biến vào view
}


}
