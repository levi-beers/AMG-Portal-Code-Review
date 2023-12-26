<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadCountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lead_counts')->delete();

        $sql = "SELECT
        CAST(`l`.`created_at` AS DATE) AS `date`,
        `l`.`esp_id` AS `esp_id`,
        `l`.`datasource` AS `datasource_id`,
        `d`.`datasource_table` AS `datasource`,
        `d`.`datasource_description` AS `description`,
        `e`.`esp_name` AS `esp_name`,
        `e`.`esp_description` AS `esp_description`,
        COUNT(0) AS `lead_count`
    FROM
        (
            (
                `alchemy_portal`.`leads` `l`
            JOIN `alchemy_portal`.`esp_info` `e`
            ON
                ((`l`.`esp_id` = `e`.`id`))
            )
        JOIN `alchemy_portal`.`datasource` `d`
        ON
            ((`l`.`datasource` = `d`.`id`))
        )
    GROUP BY
        CAST(`l`.`created_at` AS DATE),
        `l`.`esp_id`,
        `l`.`datasource`,
        `d`.`datasource_table`,
        `d`.`datasource_description`,
        `e`.`esp_name`,
        `e`.`esp_description`
    ORDER BY
        `l`.`esp_id`";
        
        $results = DB::select($sql);

        foreach ($results as $result) {
            $result->created_at = now();
            $result->updated_at = now();
            
            DB::table('lead_counts')->insert((array) $result);
        }
    }
}
