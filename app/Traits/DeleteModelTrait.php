<?php
 
namespace App\Traits;

trait DeleteModelTrait
{
    public function deleteModelTrait($id, $model)
    {
        try {
            $modelInstance = $model->findOrFail($id); // Tìm bản ghi 
            if ($modelInstance) {
                $modelInstance->delete(); // Xóa bản ghi
                return response()->json([
                    'code' => 200,
                    'message' => 'Xóa thành công.',
                ], 200);
            }

            return response()->json([
                'code' => 404,
                'message' => 'Không tìm thấy bản ghi.',
            ], 404);
        } catch (\Exception $exception) {
            \Log::error('Error deleting model: ' . $exception->getMessage());
            return response()->json([
                'code' => 500,
                'message' => 'Đã xảy ra lỗi khi xóa bản ghi.',
                'error' => $exception->getMessage(),
            ], 500);
        }
    }
}
