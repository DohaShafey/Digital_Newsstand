<?php
class ContentEngagement {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function SaveArticle($userId, $articleId) {
        $stmt = $this->db->prepare("INSERT INTO content_engagement (userId, articleId, engagementType) VALUES (?, ?, 'save')");
        $stmt->bind_param("ii", $userId, $articleId);
        return $stmt->execute();
    }

    public function AddToFavorite($userId, $articleId) {
        $stmt = $this->db->prepare("INSERT INTO content_engagement (userId, articleId, engagementType) VALUES (?, ?, 'favorite')");
        $stmt->bind_param("ii", $userId, $articleId);
        return $stmt->execute();
    }

    public function WriteComment($userId, $comment) {
        $stmt = $this->db->prepare("INSERT INTO feedback (userId, feedbackStatus, feedbackComment) VALUES (?, 'pending', ?)");
        $stmt->bind_param("is", $userId, $comment);
        return $stmt->execute();
    }

    public function FollowTopics($userId, $categoryId) {
        $stmt = $this->db->prepare("INSERT INTO user_category (userId, categoryId) VALUES (?, ?)");
        $stmt->bind_param("ii", $userId, $categoryId);
        return $stmt->execute();
    }

    public function getUserEngagement($userId) {
        $engagements = $this->db->query("SELECT * FROM content_engagement WHERE userId = $userId")->fetch_all(MYSQLI_ASSOC);
        $followedTopics = $this->db->query("SELECT c.* FROM category c JOIN user_category uc ON c.categoryId = uc.categoryId WHERE uc.userId = $userId")->fetch_all(MYSQLI_ASSOC);
        $comments = $this->db->query("SELECT * FROM feedback WHERE userId = $userId")->fetch_all(MYSQLI_ASSOC);

        return [
            'engagements' => $engagements ?: [],
            'followedTopics' => $followedTopics ?: [],
            'comments' => $comments ?: []
        ];
    }

    public function generateRecommendation($userId) {
        $result = $this->db->query("SELECT a.* FROM article a JOIN user_category uc ON a.categoryId = uc.categoryId WHERE uc.userId = $userId ORDER BY a.articlePublicationDate DESC LIMIT 5");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
}
?>
