<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;
use Http;

class ContactWebController extends Controller
{
    private ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        $contacts = $this->contactService->getAllContacts();
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);

        // Appel à l'API pour ajouter un contact via HTTP
        $this->contactService->createContact($data);
        return redirect()->route('contacts.index');
    }

    public function destroy($id)
    {
        if (Contact::destroy($id)) {
            // Contact deleted successfully
            return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully');
        } else {
            // Deletion failed
            return response()->json(['error' => 'Failed to delete contact'], 500);
        }
    }


    public function edit($id)
    {
        $contact = $this->contactService->getContactById($id);
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);

        $this->contactService->updateContact($id, $data);
        return redirect()->route('contacts.index');
    }


}
