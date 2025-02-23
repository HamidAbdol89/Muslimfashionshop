
<table class="min-w-full table-auto">
<tbody class="bg-gray-800 text-white">
                                        @foreach($users as $user)
                                            <tr>
                                                <td class="py-3 px-4">{{ $user->id }}</td>
                                                <td class="py-3 px-4">{{ $user->name }}</td>
                                                <td class="py-3 px-4">{{ $user->email }}</td>
                                                <td class="py-3 px-4 text-center">
                                                    <a href="{{ route('users.sua', ['id' => $user->id]) }}" class="btn btn-primary btn-sm mr-2">
                                                        <i class="fas fa-edit"></i> Sửa
                                                    </a>
                                                    <a href="javascript:void(0)" data-url="{{ route('users.xoa', ['id' => $user->id]) }}" class="btn btn-danger btn-sm action_delete">
                                                        <i class="fas fa-trash"></i> Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>