<?php

namespace CubeSystems\Leaf\Html;

use CubeSystems\Leaf\Html\Elements\Attributes;

/**
 * Class Tag
 * @package CubeSystems\Leaf\Html
 */
class Tag
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Attributes
     */
    protected $attributes;

    /**
     * @var mixed
     */
    protected $content;

    /**
     * Tag constructor.
     * @param $name
     */
    public function __construct( $name )
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $attributes = $this->getAttributes();

        if( $this->isSelfClosing( $this->name ) )
        {
            return '<' . $this->name . ' ' . $attributes . '>';
        }

        $content = is_array( $this->content )
            ? implode( PHP_EOL, array_map( 'strval', $this->content ) )
            : $this->content;

        return '<' . $this->name . ' ' . $attributes . '>' . $content . '</' . $this->name . '>';
    }

    /**
     * @return Attributes|null
     */
    public function getAttributes()
    {
        if( $this->attributes !== null )
        {
            return $this->attributes->reject( function ( $name )
            {
                return empty( $name );
            } );
        }

        return $this->attributes;
    }

    /**
     * @param Attributes $attributes
     * @return $this
     */
    public function setAttributes( Attributes $attributes )
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @param $content
     * @return $this
     */
    public function setContent( $content )
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @param $tag
     * @return bool
     */
    protected function isSelfClosing( $tag )
    {
        return in_array( $tag, [
            'input', 'area', 'base', 'br', 'col', 'command', 'embed', 'hr', 'img', 'input', 'keygen', 'link', 'meta', 'param', 'source', 'track', 'wbr'
        ] );
    }

    /**
     * @param $value
     * @return string
     */
    public function entities( $value )
    {
        return htmlentities( $value, ENT_QUOTES, 'UTF-8', false );
    }

    /**
     * @param $value
     * @return string
     */
    public function decode( $value )
    {
        return html_entity_decode( $value, ENT_QUOTES, 'UTF-8' );
    }
}
