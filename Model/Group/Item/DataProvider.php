<?php

namespace Common\Banner\Model\Group\Item;

use Common\Banner\Model\Group\Item;
use Common\Banner\Model\ResourceModel\Group\Item\Collection;
use Common\Base\Model\AbstractDataProvider;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

class DataProvider extends AbstractDataProvider
{
    protected $persistKey = 'banner_item';

    /**
     * @var Filesystem\Directory\WriteInterface
     */
    protected $mediaDirectory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param string                 $name
     * @param                        $primaryFieldName
     * @param                        $requestFieldName
     * @param Filesystem             $filesystem
     * @param StoreManagerInterface  $storeManager
     * @param DataPersistorInterface $dataPersistor
     * @param array                  $meta
     * @param array                  $data
     * @param PoolInterface|null     $pool
     * @throws FileSystemException
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Filesystem $filesystem,
        StoreManagerInterface $storeManager,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $dataPersistor, $meta, $data, $pool);

        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->storeManager = $storeManager;
    }

    /**
     * @inheritDoc
     */
    protected function init()
    {
        $this->initCollection(Collection::class);
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        parent::getData();
        $baseMediaUrl = $this->storeManager->getStore()->getBaseUrl(DirectoryList::MEDIA);
        foreach ($this->loadedData as &$data) {
            if ($data['data']['type'] == 'image') {
                $filePath = $this->mediaDirectory->getAbsolutePath(Item::MEDIA_FOLDER . '/' . $data['data']['media']);
                $imageInfo = getImageSize($filePath);
                $data['data']['image'] = [
                    [
                        'name' => $data['data']['media'],
                        'file' => $data['data']['media'],
                        'url'  => $baseMediaUrl . Item::MEDIA_FOLDER . '/' . $data['data']['media'],
                        'type' => $imageInfo['mime'],
                        'size' => filesize($filePath)
                    ]
                ];
            }
        }
        return $this->loadedData;
    }
}
