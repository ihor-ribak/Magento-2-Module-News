<?php
/**
 * Ihor News
 */
namespace Ihor\News\Api;

use Ihor\News\Api\Data\StoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface StoryRepositoryInterface
 *
 * Ihor News Story Repository Interface.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Api
 * @api
 */
interface StoryRepositoryInterface
{
    /**
     * Save story.
     *
     * @param \Ihor\News\Api\Data\StoryInterface $story
     * @return \Ihor\News\Api\Data\StoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    function save(StoryInterface $story);

    /**
     * Retrieve story.
     *
     * @param int $storyId
     * @return \Ihor\News\Api\Data\StoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    function getById($storyId);

    /**
     * Retrieve stories matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Ihor\News\Api\Data\StorySearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete story.
     *
     * @param \Ihor\News\Api\Data\StoryInterface $story
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    function delete(StoryInterface $story);

    /**
     * Delete story by ID.
     *
     * @param int $storyId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    function deleteById($storyId);
}
