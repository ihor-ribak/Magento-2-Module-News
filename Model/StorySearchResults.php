<?php
/**
 * Ihor News
 */
namespace Ihor\News\Model;

use Ihor\News\Api\Data\StorySearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Class StorySearchResults
 *
 * Ihor News Story Search Results.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Model
 */
class StorySearchResults extends SearchResults implements StorySearchResultsInterface
{
}
