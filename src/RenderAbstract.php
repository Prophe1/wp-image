<?php

namespace Prophe1\Wp\Image;

/**
 * Class RenderAbstract
 * @package Prophe1\Wp\Image
 */
abstract class RenderAbstract
{
    /**
     * @var Image
     */
    protected $image;

    /**
     * @var string
     */
    protected $class;

    /**
     * @param Image $image
     */
    public function setImage(Image $image)
    {
        $this->image = $image;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class)
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    abstract public function output();
}