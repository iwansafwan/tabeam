<?php

namespace Database\Seeders;

use App\Models\GeneralFund;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralFundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert a new General Fund record
        $generalFundId = DB::table('general_funds')->insertGetId([
            'name' => 'General Fund',
            'collected_amount' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
