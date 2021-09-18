<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Setup\Patch\Data;

use CrazyCat\Banner\Block\Widget\Carousel;
use CrazyCat\Banner\Model\Group\Item;
use CrazyCat\Banner\Model\Group\ItemFactory;
use CrazyCat\Banner\Model\GroupFactory;
use CrazyCat\Banner\Model\ResourceModel\Group as ResourceGroup;
use CrazyCat\Banner\Model\ResourceModel\Group\Item as ResourceItem;
use Magento\Framework\App\Area;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\State;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\View\Asset\Repository as AssetRepository;
use Magento\Widget\Model\ResourceModel\Widget\Instance as ResourceWidget;
use Magento\Widget\Model\Widget\InstanceFactory as WidgetFactory;

/**
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
     * @var DriverInterface
     */
    private $driver;

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
     * @param DriverInterface $driver
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
        DriverInterface $driver,
        Filesystem $filesystem,
        GroupFactory $groupFactory,
        ItemFactory $itemFactory,
        WidgetFactory $widgetFactory,
        ResourceGroup $resourceGroup,
        ResourceItem $resourceItem,
        ResourceWidget $resourceWidget
    ) {
        $this->assetRepository = $assetRepository;
        $this->driver = $driver;
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
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function apply()
    {
        $content = <<<HTML
<div class="content bg-white">
    <span class="info">New Luma Yoga Collection</span>
        <strong class="title">Get fit and look fab in new seasonal styles</strong>
        <span class="action more button">Shop New Yoga</span>
    </span>
</div>
HTML;

        $groupSource = [
            [
                'data'   => ['identifier' => 'home', 'name' => 'Home Banner'],
                'items'  => [
                    [
                        'title'   => 'Home Banner 01',
                        'type'    => 'image',
                        'media'   => 'home-banner-01.jpg',
                        'url'     => 'collections/yoga-new.html',
                        'content' => $content,
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
                    'instance_type'     => Carousel::class,
                    'theme_id'          => 3, // todo :: change
                    'title'             => 'Home Banner',
                    'store_ids'         => [0],
                    'widget_parameters' => json_encode(
                        [
                            'group_id'            => '1',
                            'adaptive_height'     => 'true',
                            'arrows'              => 'true',
                            'autoplay'            => 'true',
                            'autoplay_speed'      => '3000',
                            'center_mode'         => 'false',
                            'center_padding'      => '50px',
                            'dots'                => 'true',
                            'draggable'           => 'true',
                            'fade'                => 'false',
                            'focus_on_change'     => 'false',
                            'focus_on_select'     => 'false',
                            'infinite'            => 'true',
                            'initial_slide'       => '0',
                            'lazy_load'           => 'ondemand',
                            'pause_on_dots_hover' => 'false',
                            'pause_on_focus'      => 'true',
                            'pause_on_hover'      => 'true',
                            'accessibility'       => 'true',
                            'rows'                => '1',
                            'rtl'                 => 'false',
                            'slides_per_row'      => '1',
                            'slides_to_scroll'    => '1',
                            'slides_to_show'      => '1',
                            'speed'               => '300',
                            'swipe'               => 'true',
                            'swipe_to_slide'      => 'false',
                            'touch_move'          => 'true',
                            'touch_threshold'     => '5',
                            'variable_width'      => 'false',
                            'vertical'            => 'false',
                            'vertical_swiping'    => 'false',
                            'wait_for_animate'    => 'true'
                        ]
                    ),
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
        if (!$this->driver->isDirectory($mediaDir)) {
            $this->driver->createDirectory($mediaDir, 0775);
        }
        foreach ($groupSource as $groupData) {
            $group = $this->groupFactory->create();
            $this->resourceGroup->save($group->setData($groupData['data']));
            foreach ($groupData['items'] as $itemData) {
                $itemData['group_id'] = $group->getId();
                $item = $this->itemFactory->create();
                $this->resourceItem->save($item->setData($itemData));
                if (!$this->driver->isFile($mediaDir . '/' . $itemData['media'])) {
                    $asset = $this->assetRepository->createAsset('CrazyCat_Banner::images/' . $itemData['media']);
                    $this->driver->copy($asset->getSourceFile(), $mediaDir . '/' . $itemData['media']);
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
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }
}
