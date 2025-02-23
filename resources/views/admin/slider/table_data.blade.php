
                
                                <table class="min-w-full table-auto">
                                   
                                    <tbody class="bg-gray-800 text-white">
                                        @foreach ($sliders as $slider)
                                            <tr>
                                                <td class="py-3 px-4">{{ $slider->id }}</td>
                                                <td class="py-3 px-4">{{ $slider->name }}</td>
                                                <td class="py-3 px-4">{{ $slider->description }}</td>
                                                <td class="py-3 px-4">
                                                    <img class="product_image_150_100" src="{{ $slider->image_path }}" alt="">
                                                </td>
                                                <td class="py-3 px-4 text-center">
                                                    <a href="{{ route('slider.sua', ['id' => $slider->id]) }}" class="btn btn-primary btn-sm mr-2">
                                                        <i class="fas fa-edit"></i> Sửa
                                                    </a>
                                                    <a href="javascript:void(0)" data-url="{{ route('slider.xoa', ['id' => $slider->id]) }}" class="btn btn-danger btn-sm action-delete">
                                                        <i class="fas fa-trash"></i> Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                     
                   