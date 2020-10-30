<?php

namespace Common\Banner\Setup\Patch\Data;

use Common\Banner\Model\GroupFactory;
use Common\Banner\Model\Group\ItemFactory;
use Common\Banner\Model\ResourceModel\Group as ResourceGroup;
use Common\Banner\Model\ResourceModel\Group\Item as ResourceItem;
use Magento\Framework\Setup\Patch\DataPatchInterface;

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
    public function apply()
    {
        $menuSource = [
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
        foreach ($menuSource as $menuData) {
            $menu = $this->groupFactory->create();
            $this->resourceGroup->save($menu->setData($menuData['data']));
            foreach ($menuData['items'] as $itemData) {
                $itemData['group_id'] = $menu->getId();
                $item = $this->itemFactory->create();
                $this->resourceItem->save($item->setData($itemData));
            }
        }
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
    public function getAliases()
    {
        return [];
    }
}
