<?php

namespace Prophe1\Image;

/**
 * Interface RenderInterface
 *
 * @package Prophe1\Image
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