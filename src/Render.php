<?php

declare(strict_types=1);

namespace Prophe1\Wp\Image;

use Prophe1\Wp\Image\Utils\ImageUtils;

/**
 * Class Render
 * @package Prophe1\Wp\Image
 */
class Render
{
    /**
     * Outputs image html with sources
     *
     * @since 0.0.1
     *
     * @param int|null          $id             WP Attachment ID
     * @param string|null       $default        WP Attachment add_image_size size
     * @param array             $sizes          Array of WP Attachment add_image_size sizes
     * @param array             $attrs          Image Attributes
     * @param RenderAbstract    $formatter      Image Output format
     *
     * @return string|null
     */
    public static function output(
        int $id = null,
        ?string $default = null,
        ?array $sizes = [],
        array $attrs = [],
        RenderAbstract $formatter = null): ?string
    {
        if ( ! $id)
        {
            return null;
        }

        $imageSrc = ImageUtils::getImageUrl($id, $default);

        if ( ! $imageSrc)
        {
            return null;
        }

        if ( ! $formatter) {
            $formatter = new PictureTagOutput();
        }

        $image = new Image($id, $imageSrc, $sizes, $default, $attrs);

        $formatter->setImage($image);

        if ($image->isSvg())
        {
            $formatter = new SvgTagOutput();
        }

        return $formatter->output();
    }
}
