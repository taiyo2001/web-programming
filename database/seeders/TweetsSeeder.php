<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tweet;

class TweetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("TweetsSeederからDBにデータを挿入中...");

        $path_csv = "./database/CSVfiles/tweets.csv";
        $lines =file($path_csv);

        $count = 0;

        foreach($lines as $key => $line) {
            if($key === 0) {
                continue;
            }

            $arr_row = explode(',', $line);

            Tweet::create([
                'user_id' => $arr_row[0] === "" ? null : trim($arr_row[0]),
                'content' => $arr_row[1] === "" ? null : trim($arr_row[1])
                // 'note'    => $arr_row[2] === "\n" ? null : trim($arr_row[2])
            ]);
            $count++;
        }

        $this->command->info("{$count}件のデータを挿入しました。");
    }
}
