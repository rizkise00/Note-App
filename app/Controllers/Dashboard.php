<?php

namespace App\Controllers;

use App\Models\Note;

class Dashboard extends BaseController
{
    protected $noteModel;

    public function __construct()
    {
        $this->noteModel = new Note();
    }

    public function index()
    {
        // Prevent browser caching
        $this->response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $this->response->setHeader('Pragma', 'no-cache');
        $this->response->setHeader('Expires', '0');
        
        $notes = $this->noteModel->getNotesByUser(session()->get('user_id'));
        return view('dashboard', [
            'notes' => $notes,
        ]);
    }

    public function create()
    {
        $rules = [
            'title' => 'required|min_length[1]',
            'content' => 'required|min_length[1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->noteModel->save([
            'user_id' => session()->get('user_id'),
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'pinned' => false, // Default to unpinned
        ]);

        return redirect()->to('/dashboard')->with('success', 'Note created successfully');
    }

    public function edit($id)
    {
        $note = $this->noteModel->find($id);

        if (!$note || $note['user_id'] != session()->get('user_id')) {
            return redirect()->to('/dashboard')->with('error', 'Note not found');
        }

        return view('edit_note', [
            'note' => $note,
        ]);
    }

    public function update($id)
    {
        $note = $this->noteModel->find($id);

        if (!$note || $note['user_id'] != session()->get('user_id')) {
            return redirect()->to('/dashboard')->with('error', 'Note not found');
        }

        $rules = [
            'title' => 'required|min_length[1]',
            'content' => 'required|min_length[1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->noteModel->update($id, [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
        ]);

        return redirect()->to('/dashboard')->with('success', 'Note updated successfully');
    }

    public function togglePin($id)
    {
        $note = $this->noteModel->find($id);

        if (!$note || $note['user_id'] != session()->get('user_id')) {
            return redirect()->to('/dashboard')->with('error', 'Note not found');
        }

        // Convert PostgreSQL boolean string to proper boolean before toggling
        $currentPinnedStatus = $note['pinned'] === 't' || $note['pinned'] === true;
        $newPinnedStatus = !$currentPinnedStatus;
        
        $this->noteModel->update($id, [
            'pinned' => $newPinnedStatus,
        ]);

        // Show the NEW status after update
        $status = $newPinnedStatus ? 'pinned' : 'unpinned';
        
        // Prevent browser caching
        $this->response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $this->response->setHeader('Pragma', 'no-cache');
        $this->response->setHeader('Expires', '0');
        
        return redirect()->to('/dashboard')->with('success', "Note {$status} successfully");
    }

    public function delete($id)
    {
        $note = $this->noteModel->find($id);

        if (!$note || $note['user_id'] != session()->get('user_id')) {
            return redirect()->to('/dashboard')->with('error', 'Note not found');
        }

        $this->noteModel->delete($id);

        return redirect()->to('/dashboard')->with('success', 'Note deleted successfully');
    }
}