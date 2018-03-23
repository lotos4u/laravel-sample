<?php

namespace App\Models;

use App\Helpers\EntityHelper;
use App\Scopes\PermsScope;
use App\Scopes\TranslationsScope;
use App\Traits\EntityModel;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Laravel\Scout\Searchable;
use Zizaco\Entrust\EntrustRole;
use App\Traits\PreConfigurable;

class Role extends EntrustRole
{
    use Translatable
    {
        save as saveBasicTranslatable;
    }
    use PreConfigurable;
    use EntityModel;

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
        static::addGlobalScope(new PermsScope());
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

    public function scopeInternalApiUserRoles(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $single = $entity_key;
        $plural = $config['plural'];
        if (!$relationData || empty($relationData['user_id'])) {
            throw new \Exception(__('errors.exception_no_related_user_data'));
        }
        $user_id = $relationData['user_id'];
        return $query
            ->leftJoin("{$single}_translations", "{$plural}.id", "=", "{$single}_translations.{$single}_id")
            ->leftJoin("role_user", "{$plural}.id", "=", "role_user.role_id")
            ->select("{$plural}.*", "{$single}_translations.{$single}_id", "{$single}_translations.locale", "role_user.*")
            ->where("role_user.user_id", "=", $user_id)
            ->where("{$single}_translations.locale", "=", App::getLocale())
            ;
    }

    public function scopeInternalApiPermissionRoles(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $single = $entity_key;
        $plural = $config['plural'];
        if (!$relationData || empty($relationData['permission_id'])) {
            throw new \Exception(__('errors.exception_no_related_user_data'));
        }
        $permission_id = $relationData['permission_id'];
        return $query
            ->leftJoin("{$single}_translations", "{$plural}.id", "=", "{$single}_translations.{$single}_id")
            ->leftJoin("permission_role", "{$plural}.id", "=", "permission_role.role_id")
            ->select("{$plural}.*", "{$single}_translations.{$single}_id", "{$single}_translations.locale", "permission_role.*")
            ->where("permission_role.permission_id", "=", $permission_id)
            ->where("{$single}_translations.locale", "=", App::getLocale())
            ;
    }

    public function setRolePermissions(array $relationData)
    {
        $this->perms()->sync($relationData);
    }
}