<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("UsersSeederからDBにデータを挿入中...");

        $path_csv = "./database/CSVfiles/users.csv";
        $lines =file($path_csv);

        $count = 0;

        foreach($lines as $key => $line) {
            if($key === 0) {
                continue;
            }

            $arr_row = explode(',', $line);

            User::create([
                'name'              => $arr_row[0] === "" ? null : trim($arr_row[0]),
                'email'             => $arr_row[1] === "" ? null : trim($arr_row[1]),
                'authority'         => $arr_row[2] === "" ? null : trim($arr_row[2]),
                'password'          => $arr_row[3] === "" ? null : Hash::make(trim($arr_row[3])),
                'remember_token'    => $arr_row[4] === "\n" ? null : trim($arr_row[4])
                // 'note'    => $arr_row[2] === "\n" ? null : trim($arr_row[2])
            ]);
            $count++;
        }


        $this->command->info("{$count}件のデータを挿入しました。");
    }
}
