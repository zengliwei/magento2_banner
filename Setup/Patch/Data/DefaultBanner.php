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

use Common\Banner\Model\Group\Item;
use Common\Banner\Model\Group\ItemFactory;
use Common\Banner\Model\GroupFactory;
use Common\Banner\Model\ResourceModel\Group as ResourceGroup;
use Common\Banner\Model\ResourceModel\Group\Item as ResourceItem;
use Magento\Framework\App\Area;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\State;
use Magento\Framework\Filesystem;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\View\Asset\Repository as AssetRepository;

/**
 * @package Common\Banner
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class DefaultBanner implements DataPatchInterface
{
    /**
     * @var AssetRepository
     */
    private $assetRepository;

    /**
     * @var Filesystem
     */
    private $filesystem;

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
     * @var State
     */
    private $state;

    /**
     * @param State           $state
     * @param AssetRepository $assetRepository
     * @param Filesystem      $filesystem
     * @param GroupFactory    $groupFactory
     * @param ItemFactory     $itemFactory
     * @param ResourceGroup   $resourceGroup
     * @param ResourceItem    $resourceItem
     */
    public function __construct(
        State $state,
        AssetRepository $assetRepository,
        Filesystem $filesystem,
        GroupFactory $groupFactory,
        ItemFactory $itemFactory,
        ResourceGroup $resourceGroup,
        ResourceItem $resourceItem
    ) {
        $this->assetRepository = $assetRepository;
        $this->filesystem = $filesystem;
        $this->groupFactory = $groupFactory;
        $this->itemFactory = $itemFactory;
        $this->resourceGroup = $resourceGroup;
        $this->resourceItem = $resourceItem;
        $this->state = $state;
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
                        'media'   => 'home-banner-01.jpg',
                        'url'     => 'collections/yoga-new.html',
                        'content' => '<div class="content bg-white"> <span class="info">New Luma Yoga Collection</span> <strong class="title">Get fit and look fab in new seasonal styles</strong> <span class="action more button">Shop New Yoga</span> </span></div>',
                        'order'   => 1
                    ],
                    [
                        'title' => 'Home Banner 02',
                        'type'  => 'image',
                        'media' => 'home-banner-02.jpg',
                        'order' => 2
                    ],
                    [
                        'title' => 'Home Banner 03',
                        'type'  => 'image',
                        'media' => 'home-banner-03.jpg',
                        'order' => 3
                    ]
                ]
            ]
        ];
        $this->state->emulateAreaCode(
            Area::AREA_CRONTAB,
            function () use ($groupSource) {
                $mediaDir = $this->filesystem->getDirectoryWrite(DirectoryList::MEDIA)->getAbsolutePath()
                    . Item::MEDIA_FOLDER;
                if (!is_dir($mediaDir)) {
                    mkdir($mediaDir, 0775, true);
                }
                foreach ($groupSource as $groupData) {
                    $group = $this->groupFactory->create();
                    $this->resourceGroup->save($group->setData($groupData['data']));
                    foreach ($groupData['items'] as $itemData) {
                        $itemData['group_id'] = $group->getId();
                        $item = $this->itemFactory->create();
                        $this->resourceItem->save($item->setData($itemData));
                        if (!is_file($mediaDir . '/' . $itemData['media'])) {
                            $asset = $this->assetRepository->createAsset('Common_Banner::images/' . $itemData['media']);
                            copy($asset->getSourceFile(), $mediaDir . '/' . $itemData['media']);
                        }
                    }
                }
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
