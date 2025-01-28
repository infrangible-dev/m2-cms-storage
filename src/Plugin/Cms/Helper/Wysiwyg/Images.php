<?php

declare(strict_types=1);

namespace Infrangible\CmsStorage\Plugin\Cms\Helper\Wysiwyg;

use Infrangible\CmsStorage\Helper\Data;

/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Images
{
    /** @var Data */
    protected $cmsStorageHelper;

    public function __construct(Data $cmsStorageHelper)
    {
        $this->cmsStorageHelper = $cmsStorageHelper;
    }

    /**
     * Prepare Image insertion declaration for Wysiwyg or textarea(as_is mode)
     */
    public function aroundGetImageHtmlDeclaration(
        \Magento\Cms\Helper\Wysiwyg\Images $subject,
        callable $proceed,
        string $filename,
        bool $renderAsTag = false
    ): string {
        if ($this->cmsStorageHelper->isAddedFileType($filename)) {
            $fileUrl = $subject->getCurrentUrl() . $filename;

            $mediaUrl = $subject->getBaseUrl();

            $mediaPath = str_replace(
                $mediaUrl,
                '',
                $fileUrl
            );

            return sprintf(
                '{{media url="%s"}}',
                $mediaPath
            );
        }

        return $proceed(
            $filename,
            $renderAsTag
        );
    }
}
