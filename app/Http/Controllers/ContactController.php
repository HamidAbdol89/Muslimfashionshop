<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Hiển thị form liên hệ
    public function showForm()
    {
        return view('frontend.lienhe.lienhe');
    }

    // Xử lý khi người dùng gửi thông tin
    public function submitForm(Request $request)
{
    // Validate dữ liệu
    $validated = $request->validate([
        'fullname' => 'required|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
        'message' => 'required',
    ]);

    // Lưu thông tin vào cơ sở dữ liệu
    Contact::create([
        'name' => $validated['fullname'],
        'email' => $validated['email'],
        'phone' => $validated['phone'] ?? null,
        'message' => $validated['message'],
    ]);

    // Thông báo thành công
    return back()->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi!');
}


public function showContacts()
{
    $contacts = Contact::all(); // Lấy tất cả dữ liệu liên hệ
    return view('admin.lienhe.lienhe', compact('contacts'));
}


public function searchContacts(Request $request)
{
    $emailQuery = $request->input('email', ''); // Lấy giá trị email từ yêu cầu

    // Tìm kiếm các liên hệ có email chứa giá trị nhập vào
    $contacts = Contact::where('email', 'like', '%' . $emailQuery . '%')->get();

    // Trả về kết quả dưới dạng JSON để cập nhật bảng
    return response()->json([
        'contacts' => $contacts->map(function ($contact) {
            return [
                'id' => $contact->id,
                'name' => $contact->name,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'message' => $contact->message,
                'created_at' => $contact->created_at->format('d-m-Y H:i'),
                'updated_at' => $contact->updated_at->format('d-m-Y H:i'),
            ];
        }),
    ]);
}



}
