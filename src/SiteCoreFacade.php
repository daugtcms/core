<?php

namespace Felixbeer\SiteCore;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Felixbeer\SiteCore\Skeleton\SkeletonClass
 */
class SiteCoreFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'site-core';
    }
}
