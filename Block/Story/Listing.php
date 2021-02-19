<?php
/**
 * Ihor News
 */
namespace Ihor\News\Block\Story;

use Ihor\News\Api\StoryRepositoryInterface;
use Ihor\News\Model\ResourceModel\Story as StoryResource;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template;

/**
 * Class Listing
 *
 * Ihor News Story List Block.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Block\Story
 */
class Listing extends Template
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
     * Listing constructor.
     * @param Template\Context $context
     * @param StoryResource $storyResource
     * @param StoryRepositoryInterface $storyRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        StoryResource $storyResource,
        StoryRepositoryInterface $storyRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        $this->storyResource = $storyResource;
        $this->storyRepository = $storyRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    /**
     * getStories
     * @param bool $onlyEnabled
     * @return \Ihor\News\Api\Data\StoryInterface[]|null
     */
    public function getStories($onlyEnabled = true)
    {
        try {
            if ($onlyEnabled) {
                $searchCriteria = $this->searchCriteriaBuilder->addFilter('status', 1, 'eq');
            }

            $searchCriteria = $this->searchCriteriaBuilder->create();
            $stories = $this->storyRepository->getList($searchCriteria);
            return $stories->getItems();
        } catch (\Exception $e) {
            $this->_logger->critical($e);
            return null;
        }
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
}
