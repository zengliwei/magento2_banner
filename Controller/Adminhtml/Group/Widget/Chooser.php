<?php

namespace Common\Banner\Controller\Adminhtml\Group\Widget;

use Magento\Backend\App\Action;
use Magento\Backend\Block\Template;
use Magento\Framework\View\Result\Layout;
use Magento\Framework\View\Result\LayoutFactory;

class Chooser extends Action
{
    /**
     * @var LayoutFactory
     */
    protected $layoutFactory;

    /**
     * @param LayoutFactory  $layoutFactory
     * @param Action\Context $context
     */
    public function __construct(
        LayoutFactory $layoutFactory,
        Action\Context $context
    ) {
        $this->layoutFactory = $layoutFactory;
        parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /* @var Layout $resultLayout */
        /* @var Template $block */
        $resultLayout = $this->layoutFactory->create();
        $block = $resultLayout->getLayout()->getBlock('banner.group.widget.chooser');
        $block->setData('id', $this->getRequest()->getParam('uid'));
        return $resultLayout;
    }
}
