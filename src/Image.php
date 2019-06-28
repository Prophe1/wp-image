<?php

namespace App\Prophe1;

final class Image
{
    /**
     * Attachment ID
     *
     * @since 0.0.1
     *
     * @var int
     */
    private $id;

    /**
     * Attachment Link
     *
     * @since 0.0.1
     *
     * @var false|string
     */
    private $link;

    /**
     * Attachment size
     *
     * @since 0.0.1
     *
     * @var string|null
     */
    private $size;

    /**
     * Attachment type
     *
     * @since 0.0.1
     *
     * @var array
     */
    private $type;

    /**
     * Attachment ALT
     *
     * @since 0.0.1
     *
     * @var string
     */
    private $alt;

    /**
     * Attachment Title
     *
     * @since 0.0.1
     *
     * @var string
     */
    private $title;

    /**
     * Attachment media rules
     *
     * @since 0.0.1
     *
     * @var array
     */
    private $media;

    /**
     * Image constructor.
     *
     * @since 0.0.1
     *
     * @param $attachment_id
     * @param $size
     * @param $sizes
     */
    private function __construct( $id, $size, $sizes )
    {
        $this->id   = $id;
        $this->link = self::getImageUrlByID($this->id, $size);
        $this->size = $size;
        $this->media = $sizes;
        $this->type = self::getFiletypeByLink($this->link);

        if ( ! $this->isSvg())
        {
            $this->alt = self::getImageAltByID($this->id);
            $this->title = self::getTitleByID($this->id);
        }
    }

    /**
     * Get sanitized Title by ID
     *
     * @param $id
     *
     * @return string
     */
    public static function getTitleByID( $id )
    {
        return trim(strip_tags(get_the_title($id)));
    }

    /**
     * Get sanitized Image alt text by ID
     *
     * @param $id
     *
     * @return string
     */
    public static function getImageAltByID( $id )
    {
        $alt = get_post_meta($id, '_wp_attachment_image_alt', true);

        return trim(strip_tags($alt));
    }

    /**
     * Get image url by ID and size
     *
     * @param $id
     * @param $size
     *
     * @return false|string
     */
    public static function getImageUrlByID( $id, $size )
    {
        return self::fixSsl(wp_get_attachment_image_url( $id, $size ));
    }

    /**
     * Fix image url
     *
     * @param null $url
     *
     * @return bool|null
     */
    public static function fixSsl($url = null)
    {
        if (is_null($url))
        {
            return false;
        }

        return is_ssl() ? str_replace( "http:", "https:", $url ) : $url;
    }

    /**
     * Get filetype array by URL
     *
     * @param $link
     *
     * @return array
     */
    public static function getFiletypeByLink( $link )
    {
        return wp_check_filetype($link);
    }

    /**
     * Checks if image is SVG
     *
     * @since 0.0.1
     *
     * @return bool
     */
    private function isSvg()
    {
        if (isset($this->type['ext']) && $this->type['ext'] === 'svg')
        {
            return true;
        }

        return false;
    }

    /**
     * Svg content
     *
     * @since 0.0.1
     *
     * @return string
     */
    private function svg()
    {
        return trim(file_get_contents(get_attached_file( $this->id )));
    }

    /**
     * Get Image sourcing
     *
     * @since 0.0.1
     *
     * @return bool|string
     */
    private function sources()
    {
        $sources = '';

        foreach ($this->media as $size => $media) {
            $url = self::getImageUrlByID($this->id, $size);

            if ($this->size === $size) {
                $url = $this->link;
            }

            $sources .= sprintf('<source srcset="%1$s" media="%2$s">',
                $url,
                $media
            );
        }

        return $sources;
    }

    /**
     * Outputs image
     *
     * @since 0.0.1
     *
     * @param int $id
     * @param string|null $default
     * @param array $sizes
     *
     * @return string
     */
    public static function output( $id, $default = null, $sizes = [] )
    {
        $image = new self( $id, $default, $sizes );

        if ($image->isSvg())
        {
            return $image->svg();
        }

        return sprintf('<picture>%2$s<img srcset="%1$s"%3$s%4$s></picture>',
            $image->link,
            $image->sources(),
            $image->alt ? ' alt="' . $image->alt . '"' : '',
            $image->title ? ' title="' . $image->title . '"' : ''
        );
    }
}
