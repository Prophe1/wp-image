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
     * @param Image $image
     */
    public function setImage(Image $image)
    {
        $this->image = $image;
    }

    abstract public function output();
}