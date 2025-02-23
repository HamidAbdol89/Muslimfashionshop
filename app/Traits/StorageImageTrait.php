<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait
{
    // Hàm upload 1 ảnh san pham
    public function storageTraitUpload($request, $fieldName, $folderName)
{
    if ($request->hasFile($fieldName)) {
        $files = $request->file($fieldName); // Lấy tất cả các tệp hoặc 1 tệp
        $dataUploadTrait = [];

        if (!is_array($files)) {
            $files = [$files]; // Đưa file vào một mảng để xử lý đồng nhất
        }

        foreach ($files as $file) {
            $fileNameOrigin = $file->getClientOriginalName(); // Lấy tên gốc
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension(); // Tên file sau khi hash

            // Lưu file vào thư mục 'public'
            $filePath = $file->storeAs($folderName . '/' . auth()->id(), $fileNameHash, 'public');

            $dataUploadTrait[] = [
                'file_name' => $fileNameOrigin, // Tên file gốc
                'file_path' => Storage::url($filePath) // URL của file
            ];
        }

        return $dataUploadTrait; // Trả về mảng thông tin của các tệp
    }

    return null; // Trả về null nếu không có file
}

	
	// Hàm upload 1 ảnh (Dùng cho ảnh đơn trong Slider)
public function storageTraitUploadSlider($request, $fieldName, $folderName)
{
    if ($request->hasFile($fieldName)) {
        $file = $request->file($fieldName); // Lấy tệp được upload
        $fileNameOrigin = $file->getClientOriginalName(); // Tên gốc của tệp
        $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension(); // Tên file sau khi hash

        // Lưu tệp vào thư mục 'public'
        $filePath = $file->storeAs($folderName . '/' . auth()->id(), $fileNameHash, 'public');

        // Trả về thông tin của tệp duy nhất
        return [
            'file_name' => $fileNameOrigin, // Tên file gốc
            'file_path' => Storage::url($filePath), // URL của tệp
        ];
    }

    return null; // Trả về null nếu không có file
}

    // Hàm upload nhiều ảnh
    public function storageTraitUploadMultiple($request, $fieldName, $folderName)
    {
        $dataUploadTrait = []; // Mảng lưu kết quả
        
        // Kiểm tra xem trường ảnh có tồn tại không
        if ($request->hasFile($fieldName)) {
            foreach ($request->file($fieldName) as $file) {
                try {
                    $fileNameOrigin = $file->getClientOriginalName(); // Tên gốc của file
                    $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension(); // Hash tên file
                    $filePath = $file->storeAs($folderName . '/' . auth()->id() . '/' . now()->format('Y-m-d'), $fileNameHash, 'public'); // Lưu file

                    // Lưu thông tin vào mảng
                    $dataUploadTrait[] = [
                        'file_name' => $fileNameOrigin,
                        'file_path' => Storage::url($filePath),
                    ];
                } catch (\Exception $e) {
                    \Log::error('Error uploading file: ' . $e->getMessage());
                }
            }
        }

        return $dataUploadTrait; // Trả về mảng các ảnh đã xử lý
    }
}
