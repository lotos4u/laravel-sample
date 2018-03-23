<?php

use \App\Models\User;
use App\Models\Setting;
use App\Models\SettingVariant;

class SettingsTableSeeder extends BasicSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'theme_name',
                'variantable' => '1',
                'display_name' => [
                    'en' => 'Theme name',
                    'ru' => 'Тема оформления',
                ],
                'description' => [
                    'en' => 'Name of theme to style the site for user',
                    'ru' => 'Название темы для сайта',
                ],
                'default' => 'theme-blue',
            ],
            [
                'name' => 'locale',
                'variantable' => '1',
                'display_name' => [
                    'en' => 'User locale',
                    'ru' => 'Язык пользователя',
                ],
                'description' => [
                    'en' => 'Default user locale (set after login)',
                    'ru' => 'Язык пользователя по умолчанию (применяется после входа в систему)',
                ],
                'default' => 'en',
            ],
            [
                'name' => 'rows_per_page',
                'variantable' => '1',
                'display_name' => [
                    'en' => 'Rows per page',
                    'ru' => 'Количество записей на странице',
                ],
                'description' => [
                    'en' => 'Number of rows per single page',
                    'ru' => 'Количество записей для отображения на странице',
                ],
                'default' => '15',
            ],
            [
                'name' => 'format_date',
                'variantable' => '1',
                'display_name' => [
                    'en' => 'Date Format',
                    'ru' => 'Формат даты',
                ],
                'description' => [
                    'en' => 'Date format',
                    'ru' => 'Формат даты',
                ],
                'default' => 'Y-m-d',
            ],
            [
                'name' => 'format_time',
                'variantable' => '1',
                'display_name' => [
                    'en' => 'Time Format',
                    'ru' => 'Формат времени',
                ],
                'description' => [
                    'en' => 'Time format',
                    'ru' => 'Формат времени',
                ],
                'default' => 'H:i:s',
            ],
            [
                'name' => 'decimal_separator',
                'variantable' => '1',
                'display_name' => [
                    'en' => 'Decimal separator',
                    'ru' => 'Десятичный разделитель',
                ],
                'description' => [
                    'en' => 'Decimal separator',
                    'ru' => 'Десятичный разделитель',
                ],
                'default' => '.',
            ],
            [
                'name' => 'thousand_separator',
                'variantable' => '1',
                'display_name' => [
                    'en' => 'Thousand Separator',
                    'ru' => 'Разделитель тысяч',
                ],
                'description' => [
                    'en' => 'Thousand Separator',
                    'ru' => 'Разделитель тысяч',
                ],
                'default' => '',
            ],
        ];

        $theme_names = [];
        foreach (config('settings.theme_colors') as $color) {
            $name = 'theme-' . mb_strtolower($color);
            $theme_names[] = ['name' => $name, 'value' => $name];
        }

        $locales = [];
        foreach (config('app.locales') as $key => $locale) {
            $locales[] = ['name' => $key, 'value' => $locale];
        }

        $data_variants = [
            'locale' => $locales,
            'theme_name' => $theme_names,
            'rows_per_page' => [
                ['name' => '10', 'value' => '10'],
                ['name' => '15', 'value' => '15'],
                ['name' => '20', 'value' => '20'],
                ['name' => '50', 'value' => '50'],
                ['name' => 'All', 'value' => '0'],
            ],
            'format_date' => [
                ['name' => 'YYYY-MM-DD', 'value' => 'Y-m-d'],
                ['name' => 'DD-MM-YYYY', 'value' => 'd-m-Y'],
            ],
            'format_time' => [
                ['name' => 'HH:mm:ss', 'value' => 'H:i:s'],
                ['name' => 'HH:mm', 'value' => 'H:i'],
            ],
            'decimal_separator' => [
                ['name' => 'Point', 'value' => '.'],
                ['name' => 'Coma', 'value' => ','],
            ],
            'thousand_separator' => [
                ['name' => 'None', 'value' => ''],
                ['name' => 'Space', 'value' => ' '],
                ['name' => 'Coma', 'value' => ','],
                ['name' => 'Point', 'value' => '.'],
            ],
        ];


        $this->command->info('Creating setting types...');
        $settitg_types = $this->loadDataToTranslatableModel($data, 'App\Models\SettingType');


        $this->command->info('Creating settings for all users...');
        $users = User::all();
        foreach ($settitg_types as $settitg_type) {
            $value = $settitg_type->default;
            foreach ($users as $user) {
                $setting = new Setting();
                $setting->type_id = $settitg_type->id;
                $setting->user_id = $user->id;
                $setting->value = $value;
                $setting->created_at = date("Y-m-d H:i:s");
                $setting->save();
            }

            if (isset($data_variants[$settitg_type->name])) {
                foreach ($data_variants[$settitg_type->name] as $variant) {
                    $v = new SettingVariant();
                    $v->type_id = $settitg_type->id;
                    $v->name = $variant['name'];
                    $v->value = $variant['value'];
                    $v->created_at = date("Y-m-d H:i:s");
                    $v->save();
                }
            }
        }
    }

    protected function loadDataToTranslatableModel(array $data, $fullClassName)
    {
        $models = [];
        foreach ($data as $item) {
            $model = new $fullClassName();
            $model->name = $item['name'];
            $model->variantable = $item['variantable'];
            $model->default = $item['default'];
            $model->created_at = date("Y-m-d H:i:s");
            $model->translateOrNew('en')->display_name = $item['display_name']['en'];
            $model->translateOrNew('ru')->display_name = $item['display_name']['ru'];
            $model->translateOrNew('en')->description = $item['description']['en'];
            $model->translateOrNew('ru')->description = $item['description']['ru'];
            $model->save();
            $models[] = $model;
        }
        return $models;
    }
}
