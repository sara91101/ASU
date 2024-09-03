<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EngineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('engines')->insert([
            ['db_table' => 'advertisements','ar_table'=>'الأخبار & الإعلانات','en_table'=>'News & Advertisements'],
            ['db_table' => 'coalitions','ar_table'=>'إئتلاف المكتبات','en_table'=>'Libraries Coalition'],
            ['db_table' => 'committees','ar_table'=>'اللجان','en_table'=>'Committes'],
            ['db_table' => 'simulations','ar_table'=>'الحوسبة والمحاكاة','en_table'=>'Computing and Simulation'],
            ['db_table' => 'dspace_links','ar_table'=>'المستودع الرقمي','en_table'=>'D-Space'],
            ['db_table' => 'dspace_link_contents','ar_table'=>'المستودع الرقمي','en_table'=>'D-Space'],
            ['db_table' => 'f_a_q_s','ar_table'=>'الأسئلة الشائعة','en_table'=>'FAQ'],
            ['db_table' => 'teams','ar_table'=>'فريق العمل','en_table'=>'Team'],
            ['db_table' => 'universities','ar_table'=>'الأعضاء','en_table'=>'Members'],
            ['db_table' => 'teams','ar_table'=>'عن الإتحاد','en_table'=>'About Us']
        ]);

    }
}
