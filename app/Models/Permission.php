<?php
/**
 * Created by PhpStorm.
 * User: denys
 * Date: 2/1/17
 * Time: 11:11 AM
 */

namespace App\Models;


use App\Helpers\EntityHelper;
use App\Scopes\TranslationsScope;
use App\Traits\EntityModel;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;
use Zizaco\Entrust\EntrustPermission;
use App\Traits\PreConfigurable;

class Permission extends EntrustPermission
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
    }

    public static function getUserPermissions($user_id = false)
    {
        if (!$user_id) {
            $current_user = User::getUserFromGuard();
            $user_id = $current_user ? $current_user->id : false;
        }
        if (!$user_id) {
            throw new \Exception('No user for getting permissions!');
        }
        $permissions = Permission::withoutGlobalScopes([TranslationsScope::class])
            ->leftJoin('permission_role', 'permissions.id', '=', 'permission_role.permission_id')
            ->leftJoin('role_user', 'permission_role.role_id', '=', 'role_user.role_id')
            ->select('permissions.name')
            ->where('role_user.user_id', $user_id)
            ->pluck('name');
        return $permissions;
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


    public function scopeInternalApiRolePermissions(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $single = $entity_key;
        $plural = $config['plural'];
        if (!$relationData || empty($relationData['role_id'])) {
            throw new \Exception(__('errors.exception_no_related_role_data'));
        }
        $role_id = $relationData['role_id'];
        return $query
            ->leftJoin("permission_translations", "{$plural}.id", "=", "{$single}_translations.{$single}_id")
            ->leftJoin("permission_role", "{$plural}.id", "=", "permission_role.permission_id")
            ->select("{$plural}.*", "{$single}_translations.{$single}_id", "{$single}_translations.locale", "permission_role.*")
            ->where("permission_role.role_id", "=", $role_id)
            ->where("{$single}_translations.locale", "=", App::getLocale())
            ;
    }

}