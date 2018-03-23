<?php

namespace App\Scopes;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TranslationsScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $fullClassName = get_class($model);
        $usedTraits = class_uses($fullClassName);
        if (get_parent_class($fullClassName) == 'App\Models\BasicTranslatable' || array_key_exists('Dimsav\Translatable\Translatable', $usedTraits)) {
            $builder->with('translations');
        }
    }
}