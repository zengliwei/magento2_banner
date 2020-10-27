<?php

namespace Common\Banner\Ui\Component\Group\Item;

use Magento\Framework\Data\OptionSourceInterface;

class Types implements OptionSourceInterface
{
    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        return [
            ['label' => 'Image', 'value' => 'image'],
            ['label' => 'Video', 'value' => 'video']
        ];
    }
}
