<?php
/**
 * Ihor News
 */
namespace Ihor\News\Block\Adminhtml\Story\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 *
 * Ihor News Backend Buttons.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Block\Adminhtml\Story\Edit\SaveButton
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * getButtonData
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Story'),
            'class' => 'save primary',
            'data-attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save'
            ],
            'sort_order' => 90
        ];
    }
}
