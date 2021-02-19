<?php
/**
 * Ihor News
 */
namespace Ihor\News\Api\Data;

/**
 * Interface StoryInterface
 *
 * Ihor News Story Repository Interface.
 * @author Ihor Rybak <ihor2014.19@gmail.com.br>
 * @version 0.2.0
 * @license Public License
 * @package Ihor\News\Api
 * @api
 */
interface StoryInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const STORY_ID = 'story_id';
    const TITLE = 'title';
    const THUMBNAIL_PATH = 'thumbnail_path';
    const CONTENT = 'content';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**#@- */

    /**
     * Get ID
     * @return int
     */
    function getId();

    /**
     * getTitle
     * @return mixed
     */
    function getTitle();

    /**
     * setTitle
     * @param string $title
     * @return $this|mixed
     */
    function setTitle($title);

    /**
     * getThumbnailPath
     * @return mixed|string
     */
    function getThumbnailPath();

    /**
     * setThumbnailPath
     * @param string $thumbnailPath
     * @return $this|mixed
     */
    function setThumbnailPath($thumbnailPath);

    /**
     * getContent
     * @return mixed|string
     */
    function getContent();

    /**
     * setContent
     * @param string $content
     * @return $this|mixed
     */
    function setContent($content);

    /**
     * getStatus
     * @return mixed|string
     */
    function getStatus();

    /**
     * setStatus
     * @param string $status
     * @return $this|mixed
     */
    function setStatus($status);

    /**
     * Get created_at
     * @return string
     */
    function getCreatedAt();

    /**
     * Get updated_at
     * @return string
     */
    function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return mixed
     */
    function setUpdatedAt($updatedAt);
    
}
