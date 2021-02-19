<?php
/**
 * Ihor News
 */
namespace Ihor\News\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface StorySearchResultsInterface
 *
 * Ihor News Story Repository Interface.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Api
 * @api
 */
interface StorySearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get story list.
     * @return \Ihor\News\Api\Data\StoryInterface[]
     */
    function getItems();

    /**
     * Set story list.
     * @param \Ihor\News\Api\Data\StoryInterface[] $items
     * @return $this
     */
    function setItems(array $items);
}
