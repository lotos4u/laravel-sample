<?php

namespace App\Traits;

use App\Scopes\TranslationsScope;

trait WithTranslations
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TranslationsScope());
    }
}