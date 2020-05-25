<?php

namespace App\Http\Controllers\Customer;

use App\Http\Requests\StoreContactRequest;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function create()
    {
        return view('customer.contacts.create');
    }

    public function store(StoreContactRequest $request)
    {
        Contact::create($request->all());
        Alert::success('Thành công', 'Lời nhắn của bạn đã được gửi!');
        return redirect()->back();
    }
}
