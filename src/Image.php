<?php

declare(strict_types=1);

namespace Prophe1\Image;

use Prophe1\Image\Utils\ImageUtils;

/**
 * Class Image
 *
 * @package Prophe1\Image
 */
final class Image
{
    /**
     * Image data
     *
     * @since 0.0.5
     *
     * @var \Traversable
     */
    private $data;

    /**
     * Allowed image attributes
     *
     * @since 0.0.5
     *
     * @var \Traversable
     */
    private $allowedAttr = [
        'alt',
        'title',
    ];

    /**
     * Image constructor.
     *
     * @since 0.0.1
     *
     * @param int $id
     * @param string $size
     */
    public function __construct( int $id, string $size )
    {
        $image_src = ImageUtils::getImageUrlByID($id, $size);

        $this->data = [
            'id' => $id,
            'src' => $image_src,
            'size' => $size,
            'type' => ImageUtils::getFiletypeByLink($image_src),
            'alt' => ImageUtils::getImageAltByID($id),
            'title' => ImageUtils::getTitleByID($id),
        ];
    }

    /**
     * Checks if image is SVG
     *
     * @since 0.0.1
     *
     * @return bool
     */
    public function isSvg(): bool
    {
        $filetype = $this->getFiletype();

        if (isset($filetype['ext']) && $filetype['ext'] === 'svg') {
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
    public function svg(): string
    {
        return trim(file_get_contents(get_attached_file( $this->getID() )));
    }

    /**
     * ID Getter
     *
     * @return int
     */
    public function getID(): int
    {
        return $this->data['id'];
    }

    /**
     * Link Getter
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->data['src'];
    }

    /**
     * Alt Getter
     *
     * @return string
     */
    public function getAlt(): string
    {
        return $this->data['alt'];
    }

    /**
     * Default size getter
     *
     * @return string|null
     */
    public function getSize(): string
    {
        return $this->data['size'];
    }

    /**
     * Title getter
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->data['title'];
    }

    /**
     * Get filetype
     *
     * @return \Traversable
     */
    public function getFiletype(): \Traversable
    {
        return $this->data['type'];
    }

    /**
     * Get attributes
     *
     * @return \Traversable
     */
    public function getAttrs(): \Traversable
    {
        return array_intersect_key($this->data, array_flip($this->allowedAttr));
    }
}
