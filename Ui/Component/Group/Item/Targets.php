<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Ui\Component\Group\Item;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class Targets implements OptionSourceInterface
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        if ($this->options === null) {
            $this->options = [
                ['label' => '_self', 'value' => '_self'],
                ['label' => '_blank', 'value' => '_blank'],
                ['label' => '_parent', 'value' => '_parent']
            ];
        }
        return $this->options;
    }
}
