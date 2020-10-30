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
namespace Common\Banner\Block\Widget;

use Common\Banner\Model\Group\Item;
use Common\Banner\Model\ResourceModel\Group\Item\Collection;
use Common\Banner\Model\ResourceModel\Group\Item\CollectionFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;

class Carousel extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     * @param Template\Context  $context
     * @param array             $data
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        Template\Context $context,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @param string $url
     * @return string
     */
    public function getLinkUrl($url)
    {
        return preg_match('/^https?:\/\//', $url)
            ? $url
            : $this->getBaseUrl() . trim($url, '/');
    }

    /**
     * @param string $mediaFile
     * @return string
     * @throws NoSuchEntityException
     */
    public function getMediaUrl($mediaFile)
    {
        return $mediaFile
            ? ($this->_storeManager->getStore()->getBaseUrl(DirectoryList::MEDIA)
                . Item::MEDIA_FOLDER . '/' . $mediaFile)
            : $this->getViewFileUrl('Common_Banner::images/default.jpg');
    }

    /**
     * @return Collection
     * @throws NoSuchEntityException
     */
    public function getItems()
    {
        /* @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->addStoreFilter($this->_storeManager->getStore())
            ->addFieldToFilter('group_id', ['eq' => $this->getData('group_id')])
            ->addFieldToFilter('is_active', ['eq' => 1]);
        return $collection;
    }
}
