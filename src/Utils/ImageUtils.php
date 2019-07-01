<?php

declare(strict_types=1);

namespace Prophe1\Image\Utils;

/**
 * Class ImageUtils
 *
 * @package Prophe1\Image\Utils
 */
final class ImageUtils
{
    /**
     * Fix image url
     *
     * @param string|bool $url
     *
     * @return string|null
     */
    public static function fixSsl($url = null): ?string
    {
        if (! $url) {
            return $url;
        }

        return is_ssl() ? str_replace( "http:", "https:", $url ) : $url;
    }

    /**
     * Get sanitized Title by ID
     *
     * @param int $id
     *
     * @return string
     */
    public static function getTitleByID( int $id ): string
    {
        return trim(strip_tags(get_the_title($id)));
    }

    /**
     * Get sanitized Image alt text by ID
     *
     * @param int $id
     *
     * @return string
     */
    public static function getImageAltByID( int $id ): string
    {
        $alt = get_post_meta($id, '_wp_attachment_image_alt', true);

        return trim(strip_tags($alt));
    }


    /**
     * Get image url by ID and size
     *
     * @param int $id
     * @param string $size
     *
     * @return string
     */
    public static function getImageUrlByID( int $id, string $size ): string
    {
        return self::fixSsl(wp_get_attachment_image_url( $id, $size ));
    }

    /**
     * Get filetype array by URL
     *
     * @param string $link
     *
     * @return array
     */
    public static function getFiletypeByLink( string $link ): array
    {
        return wp_check_filetype($link);
    }
}
