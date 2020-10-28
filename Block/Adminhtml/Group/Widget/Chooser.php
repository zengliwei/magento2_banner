<?php

namespace Common\Banner\Block\Adminhtml\Group\Widget;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Exception\LocalizedException;

class Chooser extends \Magento\Backend\Block\Template
{
    /**
     * @param AbstractElement $element
     * @return AbstractElement
     * @throws LocalizedException
     * @see \Magento\Widget\Block\Adminhtml\Widget\Options::_addField
     */
    public function prepareElementHtml(AbstractElement $element)
    {
        /* @var \Magento\Widget\Block\Adminhtml\Widget\Chooser $block */
        $block = $this->getLayout()->createBlock(\Magento\Widget\Block\Adminhtml\Widget\Chooser::class);
        $uid = $this->mathRandom->getUniqueHash($element->getId());
        $block->addData(
            [
                'element' => $element,
                'uniq_id' => $uid,
                'config' => $this->getData('config'),
                'fieldset_id' => $this->getData('fieldset_id'),
                'source_url'  => $this->getUrl('banner/group_widget/chooser', ['uid' => $uid])
                /*'source_url' => $this->getUrl(
                    'mui/index/render',
                    ['uid' => $uid, 'namespace' => 'banner_group_listing']
                )*/
            ]
        );
        return $element->setData('after_element_html', $block->toHtml());
    }
}
