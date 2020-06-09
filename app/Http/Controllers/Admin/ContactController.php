<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendContactMail;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        flash('Xóa liên hệ thành công!')->success();
        return redirect()->route('admin.contacts.index');
    }

    public function feedback(Request $request, int $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update([
            'status' => Contact::STATUS_RESPONDED,
            'feedback' => $request['feedback']
        ]);
        dispatch(new SendContactMail($contact, $request['feedback']));

        flash('Phản hồi liên hệ thành công!')->success();
        return redirect()->back();
    }
}
