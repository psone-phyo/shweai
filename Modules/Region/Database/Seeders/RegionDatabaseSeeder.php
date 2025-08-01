<?php

namespace Modules\Region\Database\Seeders;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;

// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use Modules\Region\Entities\Region;
use App\Domains\Auth\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class RegionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        //test
        // Grouped permissions
        // Users category
        $lower_module = strtolower('Region');
        $name = 'admin.access.'.$lower_module;

        $users = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => $name,
            'description' => 'All '.$lower_module.' Permissions',
        ]);

        $users->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.'.$lower_module.'.manage',
                'description' => 'manage '.$lower_module,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.'.$lower_module.'.view',
                'description' => 'view '.$lower_module,
                'sort' => 2,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.'.$lower_module.'.create',
                'description' => 'create '.$lower_module,
                'sort' => 3,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.'.$lower_module.'.edit',
                'description' => 'edit '.$lower_module,
                'sort' => 4,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.'.$lower_module.'.delete',
                'description' => 'delete '.$lower_module,
                'sort' => 5,
            ]),
        ]);
        //end test

        $region = [
            ['id' => '1', 'name' => 'Yangon', 'mm_name' => 'ရန်ကုန်', 'active' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => '2', 'name' => 'Mandalay', 'mm_name' => 'မန္တလေး', 'active' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => '3', 'name' => 'Nay Pyi Taw', 'mm_name' => 'နေပြည်တော်', 'active' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ];

        Region::insert($region);

    }
}
