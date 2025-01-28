<?php

declare(strict_types=1);

namespace Infrangible\CmsStorage\Helper;

/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Data
{
    public function isAddedFileType(string $fileName): bool
    {
        $addedFileTypes = ['mp4', 'pdf', 'svg', 'webp', 'zip'];

        foreach ($addedFileTypes as $ignoreFileType) {
            if (strpos(
                    $fileName,
                    sprintf(
                        '.%s',
                        $ignoreFileType
                    )
                ) !== false) {
                return true;
            }
        }

        return false;
    }
}
