<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    // Save message
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        ContactMessage::create($request->all());

        return back()->with('success', 'Message sent successfully!');
    }

    // Admin panel view
    public function index()
    {
        $messages = ContactMessage::latest()->get();
        return view('admin.contact-messages', compact('messages'));
    }
public function destroy($id)
{
    $message = ContactMessage::findOrFail($id);
    $message->delete();

    return redirect()->route('admin.contact.messages')
                     ->with('success', 'Message deleted successfully.');
}

}

