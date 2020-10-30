<?php
/*
 * Copyright (c) 2020 Zengliwei
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the
 * Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFINGEMENT. IN NO EVENT SHALL THE AUTHORS
 * OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
 * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Common\Banner\Block\Adminhtml\Group\Widget;

use Common\Banner\Model\GroupFactory;
use Common\Banner\Model\ResourceModel\Group as ResourceGroup;
use Common\Banner\Model\ResourceModel\Group\CollectionFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Helper\Data;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Exception\LocalizedException;

/**
 * @package Common\Banner
 * @author  Zengliwei <zengliwei@163.com>
 * @todo    use UI components to implement when Magento supports such initialization
 * @url https://github.com/zengliwei/magento2_banner
 */
class Chooser extends Extended
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var GroupFactory
     */
    private $groupFactory;

    /**
     * @var ResourceGroup
     */
    private $resourceGroup;

    public function __construct(
        CollectionFactory $collectionFactory,
        GroupFactory $groupFactory,
        ResourceGroup $resourceGroup,
        Context $context,
        Data $backendHelper,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->groupFactory = $groupFactory;
        $this->resourceGroup = $resourceGroup;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @inheritDoc
     */
    public function getGridUrl()
    {
        return $this->getUrl('banner/group_widget/chooser', ['_current' => true]);
    }

    /**
     * @inheritDoc
     */
    public function getRowClickCallback()
    {
        $chooserJsObject = $this->getId();
        return <<<EOF
        function (grid, event) {
            const el = $chooserJsObject;
            var trElement = Event.findElement(event, "tr");
            var blockId = trElement.down("td").innerHTML.replace(/^\s+|\s+$/g,"");
            var blockTitle = trElement.down("td").next().innerHTML;
            el.setElementValue(blockId);
            el.setElementLabel(blockTitle);
            el.close();
        }
EOF;
    }

    /**
     * @param AbstractElement $element
     * @return AbstractElement
     * @throws LocalizedException
     * @see \Magento\Widget\Block\Adminhtml\Widget\Options::_addField
     */
    public function prepareElementHtml(AbstractElement $element)
    {
        /* @var \Magento\Widget\Block\Adminhtml\Widget\Chooser $block */
        $block = $this->getLayout()->createBlock(\Magento\Widget\Block\Adminhtml\Widget\Chooser::class);
        $uid = $this->mathRandom->getUniqueHash($element->getId());
        $block->addData(
            [
                'element'     => $element,
                'uniq_id'     => $uid,
                'config'      => $this->getData('config'),
                'fieldset_id' => $this->getData('fieldset_id'),
                'source_url'  => $this->getUrl('banner/group_widget/chooser', ['uid' => $uid])
            ]
        );
        if (($id = $element->getData('value'))) {
            $group = $this->groupFactory->create();
            $this->resourceGroup->load($group, $id);
            if ($group->getId()) {
                $block->setLabel($this->escapeHtml($group->getData('name')));
            }
        }
        return $element->setData('after_element_html', $block->toHtml());
    }

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setDefaultSort('name');
        $this->setDefaultDir('ASC');
        $this->setUseAjax(true);
    }

    /**
     * @inheritDoc
     */
    protected function _prepareCollection()
    {
        $this->setCollection($this->collectionFactory->create());
        return parent::_prepareCollection();
    }

    /**
     * @inheritDoc
     */
    protected function _prepareColumns()
    {
        $this->addColumn('chooser_id', ['header' => __('ID'), 'index' => 'id']);
        $this->addColumn('chooser_title', ['header' => __('Name'), 'index' => 'name']);
        $this->addColumn('chooser_identifier', ['header' => __('Identifier'), 'index' => 'identifier']);
        return parent::_prepareColumns();
    }
}
