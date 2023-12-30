<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\BcRoute;

class BcRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tableName = 'bc_routes';

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

            BcRoute::create([
                'name'          => trim($row[1]),
                'display_memo1' => trim($row[2]),
                'display_memo2' => trim($row[3]),
                'display_memo3' => trim($row[4]),
                'memo'          => trim($row[5]),
            ]);
            $count++;
        }
        $this->command->info($count."件作成しました");
    }
}
