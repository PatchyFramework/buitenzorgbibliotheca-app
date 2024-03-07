<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
         $roleadmin = Role::create(['name' => 'admin']);
         $rolepetugas = Role::create(['name' => 'petugas']);
         $rolepeminjam = Role::create(['name' => 'peminjam']);

         $dashboardrole= Permission::create(['name' => 'read_dashboard_role']);
         $readrole = Permission::create(['name' => 'read_role']);
         $showrole = Permission::create(['name' => 'show_role']);
         $createrole = Permission::create(['name' => 'create_role']);
         $updaterole = Permission::create(['name' => 'update_role']);
         $deleterole = Permission::create(['name' => 'delete_role']);
        

        $admin = User::create([
            'username' => 'ihsanpriyatnaa',
            'password' => bcrypt('ihsan1234'),
            'email' => 'patchyframework@gmail.com',
            'namalengkap' => 'Muhamad Ihsan Priyatna',
            'alamat' => 'Jl. Veteran III',
            'email_verified_at' => 1,
        ]);
        $admin->assignRole('admin');
        $roleadmin->givePermissionTo($dashboardrole);


        $petugas = User::create([
            'username' => 'librarian',
            'password' => bcrypt('library1234'),
            'email' => 'libraryframework@gmail.com',
            'namalengkap' => 'Librarian',
            'alamat' => 'Jl. Veteran II',
            'email_verified_at' => 1,
        ]);
        $petugas->assignRole('petugas');


        $peminjam = User::create([
            'username' => 'weltyang',
            'password' => bcrypt('welt1234'),
            'email' => 'weltframework@gmail.com',
            'namalengkap' => 'Welt Yang',
            'alamat' => 'Jl. Veteran IV',
            'email_verified_at' => 1,
        ]);
        $peminjam->assignRole('peminjam');





    }
}
