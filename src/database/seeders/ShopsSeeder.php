<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile =
        new \SplFileObject(__DIR__ . '/data/shops_data.csv'); // ファイルの読み込み
        $csvFile->setFlags(
            \SplFileObject::READ_CSV |        // CSV 列として行を読み込む
                \SplFileObject::READ_AHEAD |  // 先読み/巻き戻しで読み出す
                \SplFileObject::SKIP_EMPTY |  // 空行は読み飛ばす
                \SplFileObject::DROP_NEW_LINE // 行末の改行を読み飛ばす
        );

        // 一行ずつ処理 $keyはCSVの行数 0は1行目（ヘッダー）
        foreach ($csvFile as $key => $row) {
            if ($key === 0) {
                continue;
            }

            Shop::create([
                'name' => trim($row[0]),
                'area_id' => trim(
                    $row[1]
                ),
                'category_id' => trim(
                    $row[2]
                ),
                'detail' => trim(
                    $row[3]
                ),
                'img_url' => trim(
                    $row[4]
                ),
            ]);
        }
    }
}