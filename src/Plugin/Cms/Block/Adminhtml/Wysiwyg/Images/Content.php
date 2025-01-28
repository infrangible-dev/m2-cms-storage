<?php

declare(strict_types=1);

namespace Infrangible\CmsStorage\Plugin\Cms\Block\Adminhtml\Wysiwyg\Images;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Context;

/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Content
{
    /** @var RequestInterface */
    protected $request;

    public function __construct(Context $context)
    {
        $this->request = $context->getRequest();
    }

    /**
     * @noinspection PhpUnusedParameterInspection
     */
    public function beforeGetButtonsHtml(\Magento\Cms\Block\Adminhtml\Wysiwyg\Images\Content $subject, $region = null)
    {
        if ($this->request->getParam('no_adding')) {
            $subject->removeButton('insert_files');
        }
    }
}
