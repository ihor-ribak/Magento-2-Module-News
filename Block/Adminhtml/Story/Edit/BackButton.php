<?php
/**
 * Ihor News
 */
namespace Ihor\News\Block\Adminhtml\Story\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class BackButton
 *
 * Ihor News Backend Buttons.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Block\Adminhtml\Story\Edit\BackButton
 */
class BackButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * getButtonData
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * getBackUrl
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }
}
