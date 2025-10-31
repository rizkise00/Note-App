<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPinnedToNotesTable extends Migration
{
    public function up()
    {
        $fields = [
            'pinned' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
        ];
        $this->forge->addColumn('notes', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('notes', 'pinned');
    }
}