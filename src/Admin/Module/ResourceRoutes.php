<?php

namespace CubeSystems\Leaf\Admin\Module;

use CubeSystems\Leaf\Admin\Module;

/**
 * Class ResourceRoutes
 * @package CubeSystems\Leaf\Admin\Module
 */
class ResourceRoutes
{
    /**
     * @var Module
     */
    protected $module;

    /**
     * ResourceRoutes constructor.
     * @param Module $module
     */
    public function __construct( Module $module )
    {
        $this->module = $module;
    }

    /**
     * @param $name
     * @param array $parameters
     * @return string
     */
    public function getUrl( $name, $parameters = [] )
    {
        return route( config( 'leaf.uri' ) . '.' . $this->module->name() . '.' . $name, $parameters );
    }
}
