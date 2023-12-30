<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tableName = 'accounts';

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

            $data = [
                'status'            => trim($row[1]),
                'employee_number'   => trim($row[2]),
                'name'              => trim($row[3]),
                'name_kana'         => trim($row[4]),
                'position'          => trim($row[5]),
                'email'             => trim($row[6]),
                'windows_username'  => trim($row[8]),
                'chatwork_aid'      => trim($row[9]),
                'role'              => trim($row[10]),
                'password'          => Hash::make(trim($row[11])),
                'joining_date'      => trim($row[12]),
                'memo'              => trim($row[14]),
            ];

            if(!empty($row[7])){$data['bc_route_id'] = trim($row[7]);}
            if(!empty($row[13])){$data['leaving_date'] = trim($row[13]);}

            Account::create($data);
            $count++;
        }

        $this->command->info($count."件作成しました");
    }
}
