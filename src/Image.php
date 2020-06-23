<?php

declare(strict_types=1);

namespace Prophe1\Wp\Image;

use Prophe1\Wp\Image\Utils\ImageUtils;

/**
 * Class Image
 * @package Prophe1\Wp\Image
 */
class Image
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
     * Remove image attributes
     *
     * @since 0.0.5
     *
     * @var array
     */
	private $removeAttrs = [
		'id',
		'size',
		'sizes',
		'type'
	];

    /**
     * Image constructor.
     *
     * @since 0.0.1
     *
     * @param int           $id
     * @param string        $url
     * @param array         $sizes
     * @param string|null   $default_size
     * @param array         $attrs
     */
    public function __construct( int $id, string $url, array $sizes, ?string $default_size, array $attrs )
    {
        $this->data = [
            'id' => $id,
            'src' => $url,
            'size' => $default_size,
            'sizes' => $sizes,
            'type' => ImageUtils::getFiletypeByLink($url),
            'alt' => apply_filters('wp-image-get-alt', ImageUtils::getImageAltByID($id), $id),
            'title' => apply_filters('wp-image-get-title', ImageUtils::getTitleByID($id), $id),
        ];

        if ($attrs) {
	        $this->data = array_merge( $this->data, $attrs );
        }
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
     * @return string|null
     */
    public function getUrl(): ?string
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
     * @return array
     */
    public function getFiletype(): array
    {
        return $this->data['type'];
    }

    /**
     * Get sizes
     *
     * @return array
     */
    public function getSizes(): array
    {
        return $this->data['sizes'];
    }

	/**
	 * Get attributes
	 *
	 * @return array
	 */
	public function getAttrs(): array
	{
		return array_diff_key($this->data, array_flip($this->removeAttrs));
	}
}
