@extends('layouts.admin')

@section('content')
    @include('partials.content-header', ['name' => 'User Favorites', 'key' => 'List'])

    <div class="card shadow-md rounded-lg">
        <div class="card-header bg-gradient-to-r from-indigo-600 to-indigo-800 text-white text-lg font-semibold">Danh sách yêu thích của người dùng</div>
        <div class="card-body p-4">
            <!-- Form lọc -->
            <form method="GET" action="{{ route('sanpham_yeuthich.index') }}" class="mb-4 flex items-center gap-4">
                <input type="text" name="search" class="form-input" placeholder="Tìm kiếm theo tên sản phẩm" value="{{ request('search') }}" />
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </form>

            <table class="table table-bordered table-hover table-sm mb-0 text-center">
                <thead class="bg-gray-100">
                    <tr>
                        <th width="5%" class="px-4 py-2">#</th>
                        <th width="30%" class="px-4 py-2">Tên người dùng</th>
                        <th width="30%" class="px-4 py-2">Tên sản phẩm</th>
                        <th width="20%" class="px-4 py-2">Hình ảnh</th>
                        <th width="15%" class="px-4 py-2">Tùy chọn</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($favorites as $favorite)
                        <tr class="transition-all transform hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $favorite->user->name }}</td>
                            <td class="px-4 py-2">{{ $favorite->product->name }}</td>
                            <td class="px-4 py-2">
                                <img src="{{ isset($favorite->product->feature_image_path) ? asset('storage/' . str_replace(['http://localhost:8001/storage/', 'http://127.0.0.1:8001/storage/'], '', $favorite->product->feature_image_path)) : asset('storage/default-image.jpg') }}" 
                                     alt="{{ $favorite->product->name }}" 
                                     class="w-24 h-24 object-cover rounded-xl mx-auto shadow-lg hover:scale-105 transition-transform duration-300">
                            </td>
                            <td class="px-4 py-2">
                                <button class="btn btn-info view-favorites" data-product-id="{{ $favorite->product->id }}">
                                    Xem số lần yêu thích
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="favoritesModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="favoritesModalLabel">Thông tin sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="favoritesCount">Đang tải...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
      const buttons = document.querySelectorAll('.view-favorites');
      
      buttons.forEach(button => {
          button.addEventListener('click', function () {
              const productId = this.getAttribute('data-product-id');
              
              // Gửi yêu cầu Fetch tới API để lấy số lần yêu thích
              fetch(`/admin/yeuthich/sanpham/${productId}/count`)
                  .then(response => response.json())
                  .then(data => {
                      // Hiển thị thông báo với SweetAlert2
                      if (data.count) {
                          Swal.fire({
                              title: 'Thông tin sản phẩm',
                              html: `Số lượt yêu thích: <span class="font-bold text-indigo-600">${data.count}</span> Người đã thích sản phẩm này`,
                              icon: 'success',
                              confirmButtonText: 'Đóng',
                              customClass: {
                                  popup: 'bg-gray-100 text-gray-900',
                                  title: 'font-semibold text-lg',
                                  content: 'text-base',
                                  confirmButton: 'bg-indigo-600 text-white hover:bg-indigo-700'
                              },
                              imageUrl: 'https://img.icons8.com/ios/452/filled-like.png',
                              imageWidth: 50,
                              imageHeight: 50,
                              imageAlt: 'Heart Icon'
                          });
                      } else {
                          Swal.fire({
                              title: 'Thông tin sản phẩm',
                              text: 'Không có dữ liệu về số lần yêu thích.',
                              icon: 'info',
                              confirmButtonText: 'Đóng',
                              customClass: {
                                  popup: 'bg-gray-100 text-gray-900',
                                  title: 'font-semibold text-lg',
                                  content: 'text-base',
                                  confirmButton: 'bg-indigo-600 text-white hover:bg-indigo-700'
                              },
                              imageUrl: 'https://img.icons8.com/ios/452/filled-like.png',
                              imageWidth: 50,
                              imageHeight: 50,
                              imageAlt: 'Heart Icon'
                          });
                      }
                  })
                  .catch(error => {
                      console.error('Có lỗi khi tải dữ liệu:', error);
                      Swal.fire({
                          title: 'Lỗi',
                          text: 'Không thể tải dữ liệu, vui lòng thử lại sau.',
                          icon: 'error',
                          confirmButtonText: 'Đóng',
                          customClass: {
                              popup: 'bg-gray-100 text-gray-900',
                              title: 'font-semibold text-lg',
                              content: 'text-base',
                              confirmButton: 'bg-red-600 text-white hover:bg-red-700'
                          },
                          imageUrl: 'https://img.icons8.com/ios/452/filled-like.png',
                          imageWidth: 50,
                          imageHeight: 50,
                          imageAlt: 'Heart Icon'
                      });
                  });
          });
      });
  });
</script>

@endsection
