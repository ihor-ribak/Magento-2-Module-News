<?php
/**
 * Ihor News
 */
namespace Ihor\News\Block\Story;

use Ihor\News\Api\StoryRepositoryInterface;
use Ihor\News\Helper\Data;
use Ihor\News\Model\ResourceModel\Story as StoryResource;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template;

/**
 * Class View
 *
 * Ihor News Story View Block.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Block\Story
 */
class View extends Template
{
    /**
     * @var StoryResource
     */
    protected $storyResource;

    /**
     * @var StoryRepositoryInterface
     */
    protected $storyRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * View constructor.
     * @param Template\Context $context
     * @param StoryResource $storyResource
     * @param StoryRepositoryInterface $storyRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        StoryResource $storyResource,
        StoryRepositoryInterface $storyRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Data $helper,
        array $data = []
    ) {
        $this->storyResource = $storyResource;
        $this->storyRepository = $storyRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * getStory
     * @return \Ihor\News\Api\Data\StoryInterface|null
     */
    public function getStory()
    {
        $id = $this->_request->getParam('id');

        // prepare search criteria
        try {
            return $this->storyRepository->getById($id);
        } catch (\Exception $e) {
            $this->_logger->critical($e);
            return null;
        }
    }

    /**
     * getThumbnailSrc
     * @param string $thumbnailPath
     * @return string
     */
    public function getThumbnailSrc($thumbnailPath)
    {
        $path = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) .
            $this->helper->getConfigData('images_uploader/folder');
        return $path . $thumbnailPath;
    }

    /**
     * getStoryUrl
     * @param int $storyId
     * @return string
     */
    public function getStoryUrl($storyId)
    {
        $path = $this->_storeManager->getStore()->getBaseUrl();
        return $path . "ihornews/story/view/id/{$storyId}";
    }

    /**
     * getBackLink
     * @param int|null $storyId
     * @return string
     */
    public function getBackLink($storyId = null)
    {
        
        $path = $this->_storeManager->getStore()->getBaseUrl();
        return $path . "ihornews/story";
    }
}
