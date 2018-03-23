<?php

namespace App\Models;

use App\Helpers\EntityHelper;
use App\Scopes\TypeScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class SettingVariant extends BasicModel
{
    protected $fillable = [
        'type_id',
        'name',
        'value',
    ];

//    protected $with = [
//        'type'
//    ];

    protected $appends = [
        'type_name',
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\SettingType', 'type_id');
    }

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TypeScope());
    }

    public static function getSettingsVariants($settingName)
    {
        $variants_rows = SettingVariant::leftJoin('setting_types', 'setting_types.id', '=', 'setting_variants.type_id')
            ->select('setting_variants.value', 'setting_variants.name', 'setting_types.name as type_name', 'setting_variants.id', 'setting_variants.type_id', 'setting_types.id')
            ->where('setting_types.name', $settingName)
            ->get();
        return $variants_rows;
    }

    public static function getThemeColors()
    {
        return self::getSettingsVariants('theme_name');
    }

    public static function getRowsPerPages()
    {
        return self::getSettingsVariants('rows_per_page');
    }

    public function getTypeNameAttribute()
    {
        return $this->attributes['type_name'] = $this->type->display_name;
    }

    public function scopeInternalApi(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $plural = $config['plural'];
        $fixed = $query
            ->leftJoin("setting_types", "{$plural}.type_id", "=", "setting_types.id")
            ->leftJoin("setting_type_translations", "setting_types.id", "=", "setting_type_translations.setting_type_id")
//            ->select("{$plural}.*", "setting_types.id as setting_types_id", "setting_type_translations.display_name as type_name")
            ->select("{$plural}.*", "setting_types.id as setting_types_id", "setting_type_translations.display_name as type_name        ")
            ->where("setting_type_translations.locale", "=", App::getLocale());
        return $fixed;
    }

    public function scopeInternalApiSettingTypeSettingVariants(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $plural = $config['plural'];
        if (!$relationData || empty($relationData['type_id'])) {
            throw new \Exception(__('errors.exception_no_related_setting_type_data'));
        }
        $type_id = $relationData['type_id'];
        $fixed = $query
            ->leftJoin("setting_types", "{$plural}.type_id", "=", "setting_types.id")
            ->leftJoin("setting_type_translations", "setting_types.id", "=", "setting_type_translations.setting_type_id")
            ->select("{$plural}.*", "setting_types.id as setting_types_id", "setting_type_translations.display_name as type_name")
            ->where("type_id", "=", $type_id)
            ->where("setting_type_translations.locale", "=", App::getLocale());
        return $fixed;
    }
}
