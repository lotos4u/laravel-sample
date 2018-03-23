<?php

namespace App\Models;

use App\Helpers\EntityHelper;
use App\Scopes\TranslationsScope;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class BasicTranslatable extends BasicModel
{
    use Translatable
    {
        save as saveBasicTranslatable;
    }

    public $translatedAttributes = ['display_name', 'description'];
    protected $fillable = ['name'];

    public function save(array $options = [])
    {
        $saved = $this->saveBasicTranslatable($options);
        if ($saved) {
            if (! $this->usesTimestamps()) {
                return $saved;
            }
            $this->updateTimestamps();

            $this->saveBasicTranslatable();
        }
        return $saved;
    }

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TranslationsScope());
    }

    public function scopeInternalApi(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $single = $entity_key;
        $plural = $config['plural'];
        return $query
            ->leftJoin("{$single}_translations", "{$plural}.id", "=", "{$single}_translations.{$single}_id")
            ->select("{$plural}.*", "{$single}_translations.{$single}_id", "{$single}_translations.locale")
            ->where("{$single}_translations.locale", "=", App::getLocale())
            ;
    }
}
