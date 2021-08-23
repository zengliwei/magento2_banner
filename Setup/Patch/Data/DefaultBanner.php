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

namespace CrazyCat\Banner\Setup\Patch\Data;

use CrazyCat\Banner\Model\Group\Item;
use CrazyCat\Banner\Model\Group\ItemFactory;
use CrazyCat\Banner\Model\GroupFactory;
use CrazyCat\Banner\Model\ResourceModel\Group as ResourceGroup;
use CrazyCat\Banner\Model\ResourceModel\Group\Item as ResourceItem;
use Magento\Framework\App\Area;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\State;
use Magento\Framework\Filesystem;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\View\Asset\Repository as AssetRepository;
use Magento\Widget\Model\ResourceModel\Widget\Instance as ResourceWidget;
use Magento\Widget\Model\Widget\InstanceFactory as WidgetFactory;

/**
 * @package CrazyCat\Banner
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
     * @var WidgetFactory
     */
    private $widgetFactory;

    /**
     * @var ResourceGroup
     */
    private $resourceGroup;

    /**
     * @var ResourceItem
     */
    private $resourceItem;

    /**
     * @var ResourceWidget
     */
    private $resourceWidget;

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
     * @param WidgetFactory   $widgetFactory
     * @param ResourceGroup   $resourceGroup
     * @param ResourceItem    $resourceItem
     * @param ResourceWidget  $resourceWidget
     */
    public function __construct(
        State $state,
        AssetRepository $assetRepository,
        Filesystem $filesystem,
        GroupFactory $groupFactory,
        ItemFactory $itemFactory,
        WidgetFactory $widgetFactory,
        ResourceGroup $resourceGroup,
        ResourceItem $resourceItem,
        ResourceWidget $resourceWidget
    ) {
        $this->assetRepository = $assetRepository;
        $this->filesystem = $filesystem;
        $this->groupFactory = $groupFactory;
        $this->itemFactory = $itemFactory;
        $this->widgetFactory = $widgetFactory;
        $this->resourceGroup = $resourceGroup;
        $this->resourceItem = $resourceItem;
        $this->resourceWidget = $resourceWidget;
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
                'data'   => ['identifier' => 'home', 'name' => 'Home Banner'],
                'items'  => [
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
                    ],
                    [
                        'title' => 'Home Banner 04',
                        'type'  => 'video',
                        'media' => 'home-banner-04.mp4',
                        'order' => 4
                    ]
                ],
                'widget' => [
                    'instance_type'     => 'CrazyCat\Banner\Block\Widget\Carousel',
                    'theme_id'          => 3, // todo :: change
                    'title'             => 'Home Banner',
                    'store_ids'         => [0],
                    'widget_parameters' => '{"group_id":"1","adaptive_height":"true","arrows":"true","autoplay":"true","autoplay_speed":"3000","center_mode":"false","center_padding":"50px","dots":"true","draggable":"true","fade":"false","focus_on_change":"false","focus_on_select":"false","infinite":"true","initial_slide":"0","lazy_load":"ondemand","pause_on_dots_hover":"false","pause_on_focus":"true","pause_on_hover":"true","accessibility":"true","rows":"1","rtl":"false","slides_per_row":"1","slides_to_scroll":"1","slides_to_show":"1","speed":"300","swipe":"true","swipe_to_slide":"false","touch_move":"true","touch_threshold":"5","variable_width":"false","vertical":"false","vertical_swiping":"false","wait_for_animate":"true"}',
                    'page_groups'       => [
                        [
                            'page_group' => 'pages',
                            'pages'      => [
                                'page_id'       => null,
                                'group'         => 'pages',
                                'layout_handle' => 'cms_index_index',
                                'block'         => 'content',
                                'for'           => 'all',
                                'template'      => 'group/widget/carousel.phtml'
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $mediaDir = $this->filesystem->getDirectoryWrite(DirectoryList::MEDIA)->getAbsolutePath() . Item::MEDIA_FOLDER;
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
                    $asset = $this->assetRepository->createAsset('CrazyCat_Banner::images/' . $itemData['media']);
                    copy($asset->getSourceFile(), $mediaDir . '/' . $itemData['media']);
                }
            }
            $this->state->emulateAreaCode(
                Area::AREA_FRONTEND,
                function () use ($groupData) {
                    $widget = $this->widgetFactory->create();
                    $this->resourceWidget->save($widget->setData($groupData['widget']));
                }
            );
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
