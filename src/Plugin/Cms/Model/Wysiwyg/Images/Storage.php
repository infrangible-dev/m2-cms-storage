<?php

declare(strict_types=1);

namespace Infrangible\CmsStorage\Plugin\Cms\Model\Wysiwyg\Images;

use Exception;
use Infrangible\CmsStorage\Helper\Data;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\ValidatorException;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\Write;
use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\Image\AdapterFactory;

/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Storage
{
    /** @var Data */
    protected $cmsStorageHelper;

    /** @var AdapterFactory */
    protected $imageFactory;

    /** @var File */
    protected $ioFile;

    /** @var Write */
    protected $directory;

    /**
     * @throws FileSystemException
     */
    public function __construct(
        Data $cmsStorageHelper,
        AdapterFactory $imageFactory,
        File $ioFile,
        Filesystem $filesystem
    ) {
        $this->cmsStorageHelper = $cmsStorageHelper;

        $this->imageFactory = $imageFactory;
        $this->ioFile = $ioFile;
        $this->directory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
    }

    /**
     * @noinspection PhpUnusedParameterInspection
     */
    public function beforeUploadFile(
        \Magento\Cms\Model\Wysiwyg\Images\Storage $subject,
        string $targetPath,
        ?string $type = null
    ): array {
        if (is_null($type)) {
            $type = 'image';
        }

        return [$targetPath, $type];
    }

    /**
     * @return bool|string
     * @throws FileSystemException
     * @throws ValidatorException
     * @throws Exception
     */
    public function aroundResizeFile(
        \Magento\Cms\Model\Wysiwyg\Images\Storage $subject,
        callable $proceed,
        string $source,
        bool $keepRatio = true
    ) {
        if (! $this->cmsStorageHelper->isAddedFileType($source)) {
            return $proceed(
                $source,
                $keepRatio
            );
        }

        $currentPath = __DIR__;

        $pathInfo = pathinfo($source);

        $source = sprintf(
            '%s/../../../../../view/adminhtml/web/images/%s.png',
            $currentPath,
            $pathInfo[ 'extension' ]
        );

        $targetDir = $subject->getThumbsPath($source);

        $image = $this->imageFactory->create();

        $image->open($source);
        $image->keepAspectRatio($keepRatio);
        $image->resize(
            100,
            75
        );

        $dest = $targetDir . '/' . $this->ioFile->getPathInfo($source)[ 'basename' ];

        $image->save($dest);

        if ($this->directory->isFile($this->directory->getRelativePath($dest))) {
            return $dest;
        }

        return false;
    }
}
