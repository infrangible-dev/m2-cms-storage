<?php

declare(strict_types=1);

namespace Infrangible\CmsStorage\Block\Adminhtml\Storage;

use Magento\Backend\Block\Template;

/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Files extends Template
{
    /** @var string[] */
    private $titles = [];

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();

        $this->setTemplate('Infrangible_CmsStorage::storage/files.phtml');
    }

    /**
     * @return string[]
     */
    public function getTitles(): array
    {
        return $this->titles;
    }

    /**
     * @param string[] $titles
     */
    public function setTitles(array $titles): void
    {
        $this->titles = $titles;
    }

    public function addTitle(string $id, string $title)
    {
        $this->titles[ $id ] = $title;
    }
}
