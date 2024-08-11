<?php

namespace Daugt;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Daugt\Skeleton\SkeletonClass
 */
class DaugtFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'daugt';
    }
}
