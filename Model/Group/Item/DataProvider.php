<?php
/**
 * Copyright (c) 2021 Zengliwei. All rights reserved.
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

namespace CrazyCat\Banner\Model\Group\Item;

use CrazyCat\Banner\Model\Group\Item;
use CrazyCat\Banner\Model\ResourceModel\Group\Item\Collection;
use CrazyCat\Base\Model\AbstractDataProvider;

/**
 * @package CrazyCat\Banner
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
