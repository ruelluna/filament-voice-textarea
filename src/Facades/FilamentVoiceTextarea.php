<?php

namespace Ruelluna\FilamentVoiceTextarea\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ruelluna\FilamentVoiceTextarea\FilamentVoiceTextarea
 */
class FilamentVoiceTextarea extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ruelluna\FilamentVoiceTextarea\FilamentVoiceTextarea::class;
    }
}
