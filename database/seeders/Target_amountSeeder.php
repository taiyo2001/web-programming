<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Target_amount;

class Target_amountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("Target_amountSeederからDBにデータを挿入中...");

        $path_csv = "./database/CSVfiles/target_amounts.csv";
        $lines =file($path_csv);

        $count = 0;

        foreach($lines as $key => $line) {
            if($key === 0) {
                continue;
            }

            $arr_row = explode(',', $line);

            Target_amount::create([
                'user_id'       => $arr_row[0] === "" ? null : trim($arr_row[0]),
                'month'         => $arr_row[1] === "" ? null : trim($arr_row[1]),
                'target_amount' => $arr_row[2] === "" ? null : trim($arr_row[2]),
                'memo'          => $arr_row[3] === "\n" ? null : trim($arr_row[3])
            ]);
            $count++;
        }

        $this->command->info("{$count}件のデータを挿入しました。");
    }
}
