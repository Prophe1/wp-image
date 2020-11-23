<?php

declare(strict_types=1);

namespace Prophe1\Wp\Image\Utils;

/**
 * Class ImageUtils
 * @package Prophe1\Wp\Image\Utils
 */
class ImageUtils
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
     * Get Image width
     *
     * @param int $id
     * @param string|null $size
     * @return string|null
     */
    public static function getImageWidth( int $id, ?string $size = null ): ?int
    {
        $image_source = wp_get_attachment_image_src( $id, $size );

        if (! isset($image_source[1]) || ! $image_source[1]) {
            return null;
        }

        return $image_source[1];
    }

    /**
     * Get Image height
     *
     * @param int $id
     * @param string|null $size
     * @return string|null
     */
    public static function getImageHeight( int $id, ?string $size = null ): ?int
    {
        $image_source = wp_get_attachment_image_src( $id, $size );

        if (! isset($image_source[2]) || ! $image_source[2]) {
            return null;
        }

        return $image_source[2];
    }


    /**
     * Get image url by ID and size
     *
     * @param int $id
     * @param string $size
     *
     * @return string|null
     */
    public static function getImageUrl( int $id, ?string $size = null ): ?string
    {
        $image_source = wp_get_attachment_image_src( $id, $size );

        if (! isset($image_source[0]) || ! $image_source[0]) {
            return null;
        }

        return self::fixSsl($image_source[0]);
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
