<table class="min-w-full table-auto">
<tbody class="bg-gray-800 text-white">
    @foreach($categories as $category)
        <tr>
            <td class="py-3 px-4">{{ $category->id }}</td>
            <td class="py-3 px-4">
                {{ $category->name }}
            </td>
            <td class="py-3 px-4 text-center">
                <a href="{{ route('categories.sua', ['id' => $category->id]) }}" class="btn btn-primary btn-sm mr-2">
                    <i class="fas fa-edit"></i> Sửa
                </a>

                <a href="javascript:void(0)" data-url="{{ route('categories.xoa', ['id' => $category->id]) }}" class="btn btn-danger btn-sm action-delete">
                    <i class="fas fa-trash"></i> Xóa
                </a>
            </td>
        </tr>
    @endforeach
</tbody>
</table>