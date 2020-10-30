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

namespace Common\Banner\Setup\Patch\Data;

use Common\Banner\Model\Group\ItemFactory;
use Common\Banner\Model\GroupFactory;
use Common\Banner\Model\ResourceModel\Group as ResourceGroup;
use Common\Banner\Model\ResourceModel\Group\Item as ResourceItem;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * @package Common\Banner
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class DefaultBanner implements DataPatchInterface
{
    /**
     * @var GroupFactory
     */
    private $groupFactory;

    /**
     * @var ItemFactory
     */
    private $itemFactory;

    /**
     * @var ResourceGroup
     */
    private $resourceGroup;

    /**
     * @var ResourceItem
     */
    private $resourceItem;

    /**
     * @param GroupFactory  $groupFactory
     * @param ItemFactory   $itemFactory
     * @param ResourceGroup $resourceGroup
     * @param ResourceItem  $resourceItem
     */
    public function __construct(
        GroupFactory $groupFactory,
        ItemFactory $itemFactory,
        ResourceGroup $resourceGroup,
        ResourceItem $resourceItem
    ) {
        $this->groupFactory = $groupFactory;
        $this->itemFactory = $itemFactory;
        $this->resourceGroup = $resourceGroup;
        $this->resourceItem = $resourceItem;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $groupSource = [
            [
                'data'  => ['identifier' => 'home', 'name' => 'Home Banner'],
                'items' => [
                    [
                        'title'   => 'Home Banner 01',
                        'type'    => 'image',
                        'media'   => 'home-01.jpg',
                        'url'     => 'collections/yoga-new.html',
                        'content' => '<div class="content bg-white"> <span class="info">New Luma Yoga Collection</span> <strong class="title">Get fit and look fab in new seasonal styles</strong> <span class="action more button">Shop New Yoga</span> </span></div>',
                        'order'   => 1
                    ],
                    ['title' => 'Home Banner 02', 'type' => 'image', 'order' => 2],
                    ['title' => 'Home Banner 03', 'type' => 'image', 'order' => 3]
                ]
            ]
        ];
        foreach ($groupSource as $groupData) {
            $group = $this->groupFactory->create();
            $this->resourceGroup->save($group->setData($groupData['data']));
            foreach ($groupData['items'] as $itemData) {
                $itemData['group_id'] = $group->getId();
                $item = $this->itemFactory->create();
                $this->resourceItem->save($item->setData($itemData));
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
