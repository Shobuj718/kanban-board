<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            [
                'id'    => 1,
                'title' => 'New task 1',
                'status_id' => 1,
            ],
            [
                'id'    => 2,
                'title' => 'New task 2',
                'status_id' => 1,
            ],
            [
                'id'    => 3,
                'title' => 'New task 3',
                'status_id' => 1,
            ],
            [
                'id'    => 4,
                'title' => 'New task 4',
                'status_id' => 1,
            ],


            [
                'id'    => 5,
                'title' => 'Task ongoing 1',
                'status_id' => 2,
            ],

            [
                'id'    => 6,
                'title' => 'Task ongoing 2',
                'status_id' => 2,
            ],
            [
                'id'    => 7,
                'title' => 'Task done',
                'status_id' => 3,
            ],
        ];

        Task::insert($tasks);
    }
}
