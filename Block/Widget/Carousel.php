<?php

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
     * @param $mediaFile
     * @return string
     * @throws NoSuchEntityException
     */
    public function getMediaUrl($mediaFile)
    {
        return $mediaFile
            ? ($this->_storeManager->getStore()->getBaseUrl(DirectoryList::MEDIA)
                . Item::MEDIA_FOLDER . '/' . $mediaFile)
            : $this->getViewFileUrl('Common_Banner::images/default.png');
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
            ->addFieldToFilter('group_id', ['eq' => $this->getData('group_id')]);
        return $collection;
    }
}
