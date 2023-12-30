<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tableName = 'account_department';

        $this->command->info($tableName."の作成を開始します...");

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table($tableName)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $file = new \SplFileObject(__DIR__ . '/data/'.$tableName.'.csv');
        $file->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        $count = 0;
        foreach($file as $key => $row){
            if($key === 0){continue;}

            DB::table($tableName)->insert([
                'account_id'    => trim($row[1]),
                'department_id'   => trim($row[2]),
            ]);
            $count++;
        }
        $this->command->info($count."件作成しました");
    }
}
