<?php

declare(strict_types=1);

namespace Prophe1\Image;

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
            $url = Image::getImageUrlByID($image->getID(), $size);

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
     * Outputs image html with sources
     *
     * @since 0.0.1
     *
     * @param int $id
     * @param string|null $default
     * @param array $sizes
     *
     * @return string
     */
    public static function html(
        int $id,
        ?string $default = null,
        array $sizes = [] ): string
    {
        $image = new Image( $id, $default );

        if ($image->isSvg())
        {
            return $image->svg();
        }

        return sprintf('
            <picture>
                %2$s
                <img srcset="%1$s" alt="%3$s" title="%4$s">
            </picture>',
            $image->getUrl(),
            self::sources($image, $sizes),
            $image->getAttributes()
        );
    }
}
