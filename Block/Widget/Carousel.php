<?php

namespace Common\Banner\Block\Widget;

use Common\Banner\Model\ResourceModel\Group\Item\Collection;
use Common\Banner\Model\ResourceModel\Group\Item\CollectionFactory;
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
     * @return Collection
     * @throws \Magento\Framework\Exception\NoSuchEntityException
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
