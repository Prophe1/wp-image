<?php

declare(strict_types=1);

namespace Prophe1\Image;

use Prophe1\Image\Utils\ImageUtils;

/**
 * Class Render
 *
 * @package Prophe1\Image
 */
class Render
{
    /**
     * Outputs image html with sources
     *
     * @since 0.0.1
     *
     * @param int|null $id
     * @param string|null $default
     * @param array|null $sizes
     * @param RenderAbstract $formatter
     *
     * @return string|null
     */
    public static function output(
        int $id = null,
        ?string $default = null,
        ?array $sizes = null,
        RenderAbstract $formatter = null): ?string
    {
        if ( ! $id)
        {
            return null;
        }

        $image_src = ImageUtils::getImageUrl($id, $default);

        if ( ! $image_src)
        {
            return null;
        }

        $image = new Image($id, $image_src, $sizes, $default);

        $formatter->setImage($image);

        if ($image->isSvg())
        {
            $formatter = SvgTagOutput::class;

            return $formatter->output();
        }

        // Default Output to be HTML
        if ( ! $formatter)
        {
            $formatter = PictureTagOutput::class;
        }

        return $formatter->output();
    }
}
