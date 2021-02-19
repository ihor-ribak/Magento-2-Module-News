<?php
/**
 * Ihor News
 */
namespace Ihor\News\Model\ResourceModel;

use Ihor\News\Model\Story as StoryModel;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Stdlib\DateTime\DateTime;

/**
 * Class Story
 *
 * Ihor News Story Resource Model.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Model\ResourceModel
 */
class Story extends AbstractDb
{
    /**
     * @var DateTime
     */
    protected $dateTime;

    /**
     * @var string
     */
    protected $_idFieldName = StoryModel::ID_FIELD_NAME;

    /**
     * Story constructor.
     * @param Context $context
     * @param DateTime $dateTime
     * @param null $connectionName
     */
    public function __construct(
        Context $context,
        DateTime $dateTime,
        $connectionName = null)
    {
        $this->dateTime = $dateTime;
        parent::__construct($context, $connectionName);
    }

    /**
     * _construct
     */
    public function _construct()
    {
        $this->_init('ihor_news_story', 'story_id');
    }

    /**
     * Set date of last update for story
     *
     * @param \Ihor\News\Model\Story|AbstractModel $object
     * @return \Ihor\News\Model\Story $object
     */
    protected function _beforeSave(AbstractModel $object)
    {
        parent::_beforeSave($object);
        $object->setUpdatedAt($this->dateTime->gmtDate());
        return $object;
    }
}
