<?php

declare(strict_types=1);

namespace Infrangible\CmsStorage\Block\Adminhtml;

use Infrangible\Core\Helper\Url;
use Magento\Backend\Block\Widget\Button;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Context;

/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Storage extends AbstractBlock
{
    /** @var Url */
    protected $urlHelper;

    public function __construct(Context $context, Url $urlHelper, array $data = [])
    {
        parent::__construct(
            $context,
            $data
        );

        $this->urlHelper = $urlHelper;
    }

    /**
     * Override this method in descendants to produce html
     *
     * @throws LocalizedException
     */
    protected function _toHtml(): string
    {
        $button = $this->getLayout()->createBlock(
            Button::class,
            '',
            [
                'data' => [
                    'label'    => 'Open Storage',
                    'type'     => 'button',
                    'disabled' => false,
                    'class'    => 'add-image plugin',
                    'onclick'  => sprintf(
                        'MediabrowserUtility.openDialog(\'%s\')',
                        $this->urlHelper->getBackendUrl(
                            'cms/wysiwyg_images/index',
                            ['no_adding' => true]
                        )
                    )
                ]
            ]
        );

        return $button->toHtml();
    }
}
