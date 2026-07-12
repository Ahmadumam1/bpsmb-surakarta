<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Support\PasswordPolicy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $superadminRole = Role::query()
            ->where('type', 'superadmin')
            ->where('is_active', true)
            ->firstOrFail();

        User::updateOrCreate(
            ['email' => 'ahmadumam246@gmail.com'],
            [
                'name' => 'Superadmin BPSMB',
                'password' => Hash::make('Umamniboz1!!'),
                'role_id' => $superadminRole->id,
                'password_changed_at' => now(),
                'password_expires_at' => PasswordPolicy::expiresAt(),
                'password_must_be_changed' => true,
            ],
        );

        $this->call([
            SettingSeeder::class,
            HomepageSeeder::class,
            ProfilePageSeeder::class,
            TestingDurationSeeder::class,
            AccreditationScopeSeeder::class,
            ProductCertificationInfoSeeder::class,
            SampleCollectionFeeSeeder::class,
            CalibrationScopeSeeder::class,
            CostDocumentSeeder::class,
            ServiceFeeSeeder::class,
            LphSectionSeeder::class,
        ]);
    }
}
