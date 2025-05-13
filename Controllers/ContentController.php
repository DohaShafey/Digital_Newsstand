<?php
require_once 'DBController.php';
require_once 'ContentEngagement.php';

class ContentController extends DBController {
    private $contentEngagement;

    public function __construct() {
        parent::openConnection();
        $this->contentEngagement = new ContentEngagement($this->conn);
    }

    /**
     * Save an article for a user
     */
    public function saveArticle($userId, $articleId) {
        try {
            $success = $this->contentEngagement->SaveArticle($userId, $articleId);
            return [
                'success' => $success,
                'message' => $success ? 'Article saved successfully' : 'Article already saved or error occurred'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Add article to favorites for a user
     */
    public function addToFavorites($userId, $articleId) {
        try {
            $success = $this->contentEngagement->AddToFavorite($userId, $articleId);
            return [
                'success' => $success,
                'message' => $success ? 'Added to favorites successfully' : 'Article already in favorites or error occurred'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Remove saved article for a user
     */
    public function removeSavedArticle($userId, $articleId) {
        try {
            $success = $this->contentEngagement->removeSavedArticle($userId, $articleId);
            return [
                'success' => $success,
                'message' => $success ? 'Article removed successfully' : 'Article not found or already removed'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Get user engagement data
     */
    public function getUserEngagementData($userId) {
        try {
            $data = $this->contentEngagement->getUserEngagement($userId);
            return [
                'success' => true,
                'data' => $data,
                'message' => 'User engagement data retrieved'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'data' => [],
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Get article by ID
     */
    public function getArticleById($articleId) {
        $query = "SELECT a.*, c.categoryName 
                 FROM article a
                 JOIN category c ON a.categoryId = c.categoryId
                 WHERE a.articleId = ?";
        
        $result = $this->select($query, [$articleId]);
        
        if ($result && count($result) > 0) {
            return [
                'success' => true,
                'data' => $result[0],
                'message' => 'Article found'
            ];
        }
        
        return [
            'success' => false,
            'data' => [],
            'message' => 'Article not found'
        ];
    }

    public function __destruct() {
        parent::closeConnection();
    }
}