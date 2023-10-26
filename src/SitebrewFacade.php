<?php

namespace Sitebrew;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sitebrew\Skeleton\SkeletonClass
 */
class SitebrewFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sitebrew';
    }
}
