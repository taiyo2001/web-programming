<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Money_management;

class Money_managementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("Money_managementSeederからDBにデータを挿入中...");

        $path_csv = "./database/CSVfiles/money_managements.csv";
        $lines =file($path_csv);

        $count = 0;

        foreach($lines as $key => $line) {
            if($key === 0) {
                continue;
            }

            $arr_row = explode(',', $line);

            Money_management::create([
                'user_id'       => $arr_row[0] === "" ? null : trim($arr_row[0]),
                'purchase'      => $arr_row[1] === "" ? null : trim($arr_row[1]),
                'date'          => $arr_row[2] === "" ? null : trim($arr_row[2]),
                'amount_money'  => $arr_row[3] === "" ? null : trim($arr_row[3]),
                'memo'          => $arr_row[4] === "\n" ? null : trim($arr_row[4])
            ]);
            $count++;
        }

        $this->command->info("{$count}件のデータを挿入しました。");
    }
}
