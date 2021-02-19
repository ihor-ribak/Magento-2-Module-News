<?php
/**
 * Ihor News
 */
namespace Ihor\News\Model\Block\Source;

use Ihor\News\Model\Story;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class StoryStatus
 *
 * Status Selector
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Model\Block\Source
 */
class StoryStatus implements OptionSourceInterface
{
    /**
     * @var \Ihor\News\Model\Story
     */
    protected $object;

    /**
     * Constructor
     *
     * @param Story $object
     */
    public function __construct(Story $object)
    {
        $this->object = $object;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->object->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
