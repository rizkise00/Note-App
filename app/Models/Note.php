<?php

namespace App\Models;

use CodeIgniter\Model;

class Note extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['user_id', 'title', 'content', 'pinned'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getNotesByUser($userId)
    {
        $notes = $this->where('user_id', $userId)->orderBy('pinned', 'DESC')->orderBy('created_at', 'DESC')->findAll();
        // Ensure proper boolean conversion for PostgreSQL ('t' -> true, 'f' -> false)
        foreach ($notes as &$note) {
            $note['pinned'] = $note['pinned'] === 't' || $note['pinned'] === true;
        }
        return $notes;
    }

    public function getPinnedNotesByUser($userId)
    {
        $notes = $this->where('user_id', $userId)->where('pinned', true)->orderBy('created_at', 'DESC')->findAll();
        // Ensure proper boolean conversion for PostgreSQL ('t' -> true, 'f' -> false)
        foreach ($notes as &$note) {
            $note['pinned'] = $note['pinned'] === 't' || $note['pinned'] === true;
        }
        return $notes;
    }

    public function getUnpinnedNotesByUser($userId)
    {
        $notes = $this->where('user_id', $userId)->where('pinned', false)->orderBy('created_at', 'DESC')->findAll();
        // Ensure proper boolean conversion for PostgreSQL ('t' -> true, 'f' -> false)
        foreach ($notes as &$note) {
            $note['pinned'] = $note['pinned'] === 't' || $note['pinned'] === true;
        }
        return $notes;
    }
}