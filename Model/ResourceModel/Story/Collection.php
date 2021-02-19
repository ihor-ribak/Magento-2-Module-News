<?php
/**
 * Ihor News
 */
namespace Ihor\News\Model\ResourceModel\Story;

use Ihor\News\Model\Story;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 *
 * Ihor News Story Model Collection.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Model\ResourceModel\Story
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = Story::ID_FIELD_NAME;

    /**
     * @var string
     */
    protected $_eventPrefix = 'ihor_news_story';

    /**
     * _construct
     */
    public function _construct()
    {
        $this->_init(
            'Ihor\News\Model\Story',
            'Ihor\News\Model\ResourceModel\Story'
        );
    }
}
