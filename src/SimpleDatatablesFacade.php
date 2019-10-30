<?php

namespace Nowendwell\SimpleDatatables;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nowendwell\SimpleDatatables\Skeleton\SkeletonClass
 */
class SimpleDatatablesFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'simple-datatables';
    }
}
