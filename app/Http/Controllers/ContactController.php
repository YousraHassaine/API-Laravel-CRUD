<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContactController extends Controller
{
    private ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        try {
            $contacts = $this->contactService->getAllContacts();

            if ($contacts->isEmpty()) {
                return response()->json(['error' => 'Not Found', 'message' => 'No contacts found'], 404);
            }
            return response()->json($contacts, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Bad Request', 'message' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|email'
            ]);

            $contact = $this->contactService->createContact($request->all());

            return response()->json($contact, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Bad Request', 'message' => $e->errors()], 400); 
        } catch (\Exception $e) {
            return response()->json(['error' => 'Bad Request', 'message' => $e->getMessage()], 400); 
        }
    }

    public function show($id)
    {
        try {
            $contact = $this->contactService->getContactById($id);
            return response()->json($contact, 200); 
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Not Found', 'message' => 'Contact not found'], 404); 
        } catch (\Exception $e) {

            return response()->json(['error' => 'Bad Request', 'message' => $e->getMessage()], 400); 
        }
    }

   
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|email'
            ]);

            $contact = $this->contactService->updateContact($id, $request->all());

            return response()->json($contact, 200);
        } catch (ValidationException $e) {
  
            return response()->json(['error' => 'Bad Request', 'message' => $e->errors()], 400); 
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Not Found', 'message' => 'Contact not found'], 404); 
        } catch (\Exception $e) {

            return response()->json(['error' => 'Bad Request', 'message' => $e->getMessage()], 400); 
        }
    }


    public function destroy($id)
    {
        try {
            $this->contactService->deleteContact($id);
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Not Found', 'message' => 'Contact not found'], 404); 
        } catch (\Exception $e) {

            return response()->json(['error' => 'Bad Request', 'message' => $e->getMessage()], 400); 
        }
    }
}
