<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Model\Group\Item;

use CrazyCat\Banner\Model\Group\Item;
use CrazyCat\Banner\Model\ResourceModel\Group\Item\Collection;
use CrazyCat\Base\Model\AbstractDataProvider;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class DataProvider extends AbstractDataProvider
{
    protected string $persistKey = 'banner_item';

    /**
     * @inheritDoc
     */
    public function getData()
    {
        parent::getData();
        foreach (array_keys($this->loadedData) as $id) {
            $data = &$this->loadedData[$id]['data'];
            if (!empty($data['media'])) {
                $data[$data['type']] = $this->prepareFileData(
                    $data,
                    'media',
                    Item::MEDIA_FOLDER,
                    $data['type'] == 'video' ? 'video/mp4' : null
                );
            }
        }
        return $this->loadedData;
    }

    /**
     * @inheritDoc
     */
    protected function init()
    {
        $this->initCollection(Collection::class);
    }
}
