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
        ]);

        return redirect()->to('/dashboard')->with('success', 'Note created successfully');
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
