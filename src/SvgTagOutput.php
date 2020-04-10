<?php
/**
 * Date: 14/08/2019
 * Time: 15:32
 */

namespace Prophe1\Wp\Image;

/**
 * Class SvgTagOutput
 * @package Prophe1\Wp\Image
 */
class SvgTagOutput extends RenderAbstract
{
    /**
     * @return string
     */
    public function output()
    {
        $file_link = get_attached_file( $this->image->getID() );

        return trim(file_get_contents($file_link));
    }
}