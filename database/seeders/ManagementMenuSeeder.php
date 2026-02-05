<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class ManagementMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'name' => 'Users',
                'url' => 'admin/users',
                'icon' => 'iconoir-group',
                'urutan' => 1,
                'code' => 'users',
                'parent_id' => null,
            ],
            [
                'name' => 'Roles',
                'url' => 'admin/roles',
                'icon' => 'iconoir-lock-square',
                'urutan' => 2,
                'code' => 'roles',
                'parent_id' => null,
            ],
            [
                'name' => 'Languages',
                'url' => 'admin/languages',
                'icon' => 'iconoir-globe', // Assuming generic globe/language icon
                'urutan' => 3,
                'code' => 'languages',
                'parent_id' => null,
            ],
            [
                'name' => 'Questions',
                'url' => 'admin/questions',
                'icon' => 'iconoir-chat-bubble-question', // Assuming question icon
                'urutan' => 4,
                'code' => 'questions',
                'parent_id' => null,
            ],
            [
                'name' => 'Inbox',
                'url' => 'admin/submissions',
                'icon' => 'iconoir-send-mail',
                'urutan' => 5,
                'code' => 'inbox',
                'parent_id' => null,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate(
                ['code' => $menu['code']],
                $menu
            );
        }
    }
}
