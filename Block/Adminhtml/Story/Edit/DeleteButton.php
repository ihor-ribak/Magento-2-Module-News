<?php
/**
 * Ihor News
 */
namespace Ihor\News\Block\Adminhtml\Story\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 *
 * Ihor News Backend Buttons.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Block\Adminhtml\Story\Edit\DeleteButton
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * getButtonData
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Delete Story'),
            'class' => 'delete',
            'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
            'sort_order' => 20,
        ];
    }

    /**
     * getDeleteUrl
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['story_id' => $this->getStoryId()]);
    }
}
