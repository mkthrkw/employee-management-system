<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DesktopPc;

class DesktopPcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tableName = 'desktop_pcs';

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
                'status'            => trim($row[2]),
                'name'              => trim($row[3]),
                'cpu'               => trim($row[4]),
                'memory'            => trim($row[5]),
                'hdd'               => trim($row[6]),
                'vpn_connection_id' => trim($row[7]),
                'vpn_unique_id'     => trim($row[8]),
                'casting_navi'      => trim($row[9]),
                'branch'            => trim($row[10]),
                'arrival_date'      => trim($row[11]),
                'memo'              => trim($row[13]),
            ];

            if(!empty($row[1])){$data['account_id'] = trim($row[1]);}
            if(!empty($row[12])){$data['disposal_date'] = trim($row[12]);}

            DesktopPc::create($data);
            $count++;
        }
        $this->command->info($count."件作成しました");
    }
}
