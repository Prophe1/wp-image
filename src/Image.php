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
     * @var array
     */
    private $data;

    /**
     * Allowed image attributes
     *
     * @since 0.0.5
     *
     * @var array
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
        $this->data = [
            'id' => $id,
            'src' => ImageUtils::getImageUrlByID($this->getID(), $size),
            'size' => $size,
            'type' => ImageUtils::getFiletypeByLink($this->getUrl()),
            'alt' => ImageUtils::getImageAltByID($this->getID()),
            'title' => ImageUtils::getTitleByID($this->getID()),
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
        return $this->data['url'];
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
     * @return array
     */
    public function getFiletype(): array
    {
        return $this->data['type'];
    }

    /**
     * Get attributes
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return array_intersect($this->data, $this->allowedAttr);
    }
}
