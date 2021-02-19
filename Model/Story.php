<?php
/**
 * Ihor News
 */
namespace Ihor\News\Model;

use Ihor\News\Api\Data\StoryInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;


/**
 * Class Story
 *
 * Ihor News Story Model.
 *
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Model
 */
class Story extends AbstractModel implements IdentityInterface, StoryInterface
{
    /**
     * News Story cache tag
     */
    const CACHE_TAG = 'news_story';

    /**
     * ID_FIELD_NAME
     */
    const ID_FIELD_NAME = 'story_id';

    /**#@+
     * Story statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * @var string
     */
    protected $_idFieldName = self::ID_FIELD_NAME;

    /**
     * @var string
     */
    protected $_eventPrefix = 'ihor_news_story';

    /**
     * @var string
     */
    protected $_eventObject = 'story';

    /**
     * @var StoryRepository
     */
    protected $storyRepository;

    /**
     * Story constructor.
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param StoryRepository $storyRepository
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        StoryRepository $storyRepository,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->storyRepository = $storyRepository;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * _construct
     */
    public function _construct()
    {
        $this->_init('Ihor\News\Model\ResourceModel\Story');
    }

    /**
     * getIdentities
     * @return array
     */
    public function getIdentities()
    {
        return [
            self::CACHE_TAG . '_' . $this->getId()
        ];
    }

    /**
     * getAvailableStatuses
     *
     * Provides a list of available status for this entity.
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [
            self::STATUS_ENABLED => __('Enabled'),
            self::STATUS_DISABLED => __('Disabled')
        ];
    }

    /**
     * getTitle
     * @return mixed|string
     */
    public function getTitle()
    {
        return $this->getData('title');
    }

    /**
     * setTitle
     * @param string $title
     * @return $this|mixed
     */
    public function setTitle($title)
    {
        return $this->setData('title', $title);
    }

    /**
     * getThumbnailPath
     * @return mixed|string
     */
    public function getThumbnailPath()
    {
        return $this->getData('thumbnail_path');
    }

    /**
     * setThumbnailPath
     * @param string $thumbnailPath
     * @return $this|mixed
     */
    public function setThumbnailPath($thumbnailPath)
    {
        return $this->setData('thumbnail_path', $thumbnailPath);
    }

    /**
     * getContent
     * @return mixed|string
     */
    public function getContent()
    {
        return $this->getData('content');
    }

    /**
     * setContent
     * @param string $content
     * @return $this|mixed
     */
    public function setContent($content)
    {
        return $this->setData('content', $content);
    }

    /**
     * getStatus
     * @return mixed|string
     */
    public function getStatus()
    {
        return $this->getData('status');
    }

    /**
     * setStatus
     * @param string $status
     * @return $this|mixed
     */
    public function setStatus($status)
    {
        return $this->setData('status', $status);
    }

    /**
     * getCreatedAt
     * @return mixed|string
     */
    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }

    /**
     * setCreatedAt
     * @param string $createdAt
     * @return $this|mixed
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData('created_at', $createdAt);
    }

    /**
     * getUpdatedAt
     * @return mixed|string
     */
    public function getUpdatedAt()
    {
        return $this->getData('updated_at');
    }

    /**
     * setUpdatedAt
     * @param string $updatedAt
     * @return $this|mixed
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData('updated_at', $updatedAt);
    }
}
