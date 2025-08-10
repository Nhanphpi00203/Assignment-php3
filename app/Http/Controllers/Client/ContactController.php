<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
	public function index()
	{
		return view('client.contact');
	}


	public function store(ContactRequest $request)
	{
		// back() -> quay lại trang trước đó
		// return redirect()->back()->with('success', 'Đã gửi thành công');


		// $data = $request->validated();
		// Mail::to('phamhoangnhan09z12@gmail.com')->send(new ContactMail($data));
		// $data = $request->validated();
		// dd($request->all());
		Mail::to('phamhoangnhan09z12@gmail.com')->send(new ContactMail($request->all()));

		// gửi email
		return redirect()->back()->with('success', 'Đã gửi thành công');
	}
}
