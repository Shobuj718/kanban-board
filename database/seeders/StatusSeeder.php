<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'id'    => 1,
                'title' => 'To do',
                'slug' => 'to-do',
            ],
            [
                'id'    => 2,
                'title' => 'In Progress',
                'slug' => 'in-progress',
            ],
            [
                'id'    => 3,
                'title' => 'Done',
                'slug' => 'done',
            ],
        ];

        Status::insert($status);
    }
}
