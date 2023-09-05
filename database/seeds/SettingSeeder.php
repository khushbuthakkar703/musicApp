<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $setting = new App\Setting();
        $setting->field = "per_day_charge";
        $setting->value = 50;
        $setting->save();
    }
}
