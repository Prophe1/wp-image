<?php

declare(strict_types=1);

namespace Prophe1\Image;

use Prophe1\Image\Utils\ImageUtils;

/**
 * Class Render
 *
 * @package Prophe1\Image
 */
final class Render
{
    /**
     * Get Image sourcing
     *
     * @since 0.0.1
     *
     * @param Image $image
     * @param array $sizes
     *
     * @return string
     */
    private static function sources(Image $image, array $sizes): string
    {
        $sources = '';

        foreach ($sizes as $size => $media) {
            $url = ImageUtils::getImageUrlByID($image->getID(), $size);

            if ($image->getSize() === $size) {
                $url = $image->getUrl();
            }

            $sources .= sprintf('<source srcset="%1$s" media="%2$s">',
                $url,
                $media
            );
        }

        return $sources;
    }

    /**
     * Generate attributes for an image tag
     *
     * @since 0.0.5
     *
     * @param array $attrs
     *
     * @return string
     */
    private static function attrs(array $attrs): string
    {
        $content = "";

        foreach ($attrs as $attribute => $value) {
            $content .= sprintf(' %s="%s"', $attribute, $value);
        }

        return $content;
    }

    /**
     * Outputs image html with sources
     *
     * @since 0.0.1
     *
     * @param int|null $id
     * @param string|null $default
     * @param array|null $sizes
     *
     * @return string|null
     */
    public static function html(
        int $id = null,
        ?string $default = null,
        ?array $sizes = null ): ?string
    {
        if (! $id) {
            return null;
        }

        $image = new Image( $id, $default );

        if (! $image->getUrl()) {
            return null;
        }

        if ($image->isSvg())
        {
            return $image->svg();
        }

        return sprintf('
            <picture>
                %2$s
                <img src="%1$s"%3$s>
            </picture>',
            $image->getUrl(),
            self::sources($image, $sizes),
            self::attrs($image->getAttrs())
        );
    }
}
