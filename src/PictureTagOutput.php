<?php
/**
 * Date: 14/08/2019
 * Time: 15:32
 */

namespace Prophe1\ResponsiveImage;

use Prophe1\ResponsiveImage\Utils\ImageUtils;

/**
 * Class HtmlOutput
 *
 * @package Prophe1\Image
 */
class PictureTagOutput extends RenderAbstract
{
    /**
     * Get Image sourcing
     *
     * @since 0.0.1
     *
     * @return string
     */
    protected function sources(): string
    {
        $sources = '';

        foreach ($this->image->getSizes() as $size => $media) {
            $url = ImageUtils::getImageUrl($this->image->getID(), $size);

            if ($this->image->getSize() === $size) {
                $url = $this->image->getUrl();
            }

            $sources .= sprintf('<source srcset="%s" media="%s">',
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
     * @return string
     */
    protected function attrs(): string
    {
        $content = "";

        foreach ($this->image->getAttrs() as $attribute => $value) {
            $content .= sprintf(' %s="%s"', $attribute, $value);
        }

        return $content;
    }

    /**
     * @return string
     */
    public function output()
    {
        return sprintf('
            <picture>
                %2$s
                <img src="%1$s"%3$s>
            </picture>',
            $this->image->getUrl(),
            $this->sources(),
            $this->attrs()
        );
    }
}