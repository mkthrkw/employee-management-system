<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\LaptopPc;

class LaptopPcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tableName = 'laptop_pcs';

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
                'status'        => trim($row[2]),
                'name'          => trim($row[3]),
                'device_name'   => trim($row[4]),
                'cpu'           => trim($row[5]),
                'memory'        => trim($row[6]),
                'branch'        => trim($row[7]),
                'arrival_date'  => trim($row[8]),
                'memo'          => trim($row[10]),
            ];

            if(!empty($row[1])){$data['account_id'] = trim($row[1]);}
            if(!empty($row[9])){$data['disposal_date'] = trim($row[9]);}

            LaptopPc::create($data);
            $count++;
        }
        $this->command->info($count."件作成しました");
    }
}
