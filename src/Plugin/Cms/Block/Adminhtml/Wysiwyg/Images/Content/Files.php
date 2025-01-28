<?php /** @noinspection PhpDeprecationInspection */
declare(strict_types=1);

namespace Infrangible\CmsStorage\Plugin\Cms\Block\Adminhtml\Wysiwyg\Images\Content;

use Magento\Framework\Exception\LocalizedException;

/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Files
{
    /**
     * @throws LocalizedException
     */
    public function afterToHtml(
        \Magento\Cms\Block\Adminhtml\Wysiwyg\Images\Content\Files $subject,
        string $result
    ): string {
        /** @var \Infrangible\CmsStorage\Block\Adminhtml\Storage\Files $filesBlock */
        $filesBlock = $subject->getLayout()->createBlock(\Infrangible\CmsStorage\Block\Adminhtml\Storage\Files::class);

        foreach ($subject->getFiles() as $file) {
            $fileId = $subject->escapeHtmlAttr($subject->getFileId($file));
            $fileName = $subject->escapeHtmlAttr($subject->getFileName($file));

            $filesBlock->addTitle(
                $fileId,
                $fileName
            );
        }

        return $result . $filesBlock->toHtml();
    }
}
