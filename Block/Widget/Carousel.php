<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Block\Widget;

use CrazyCat\Banner\Model\Group\Item;
use CrazyCat\Banner\Model\ResourceModel\Group\Item\Collection;
use CrazyCat\Banner\Model\ResourceModel\Group\Item\CollectionFactory;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Text;
use Magento\Widget\Block\BlockInterface;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class Carousel extends Template implements BlockInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var DriverInterface
     */
    private $driver;

    /**
     * @var FilterProvider
     */
    protected $filterProvider;

    /**
     * @param CollectionFactory $collectionFactory
     * @param DriverInterface   $driver
     * @param FilterProvider    $filterProvider
     * @param Template\Context  $context
     * @param array             $data
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        DriverInterface $driver,
        FilterProvider $filterProvider,
        Template\Context $context,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->driver = $driver;
        $this->filterProvider = $filterProvider;
        parent::__construct($context, $data);
    }

    /**
     * @inheritDoc
     */
    protected function _toHtml()
    {
        /** @var $blockDesc Text */
        $blockDesc = $this->addChild('description', Text::class);
        $blockDesc->setText($this->filterProvider->getBlockFilter()->filter($this->getDataByKey('description')));

        return parent::_toHtml();
    }

    /**
     * Get link URL
     *
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
     * Get media URL
     *
     * @param string $mediaFile
     * @return string
     * @throws NoSuchEntityException
     */
    public function getMediaUrl($mediaFile)
    {
        if ($mediaFile) {
            $mediaDirectory = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA);
            if ($this->driver->isFile($mediaDirectory->getAbsolutePath(Item::MEDIA_FOLDER . '/' . $mediaFile))) {
                return $this->_storeManager->getStore()->getBaseUrl(DirectoryList::MEDIA) .
                    Item::MEDIA_FOLDER . '/' . $mediaFile;
            }
        }
        return $this->getViewFileUrl('CrazyCat_Banner::images/default.jpg');
    }

    /**
     * Get items
     *
     * @return Collection
     * @throws NoSuchEntityException
     */
    public function getItems()
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->addStoreFilter($this->_storeManager->getStore())
            ->addFieldToFilter('group_id', ['eq' => $this->getData('group_id')])
            ->addFieldToFilter('is_active', ['eq' => 1]);
        return $collection;
    }
}
