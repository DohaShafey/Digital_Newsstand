<?php

require_once '../Controllers/DBController.php';
require_once 'Article.php';

class Admin {
    
    // Properties
    private $conn;
    private $article_table = "article";
    private $user_table = "user";
    private $category_table = "category";
    private $language_table = "language";

    public function __construct($db) {
        $this->conn = $db->conn;
    }

    // Method Add new article
    public function addArticle($title, $content, $categoryId, $languageId, $userId) {
        $query = "INSERT INTO " . $this->article_table . "
                 SET articleTitle = ?,
                     articleContent = ?,
                     categoryId = ?,
                     languageId = ?,
                     userId = ?,
                     articlePublicationDate = CURDATE()";

        $stmt = $this->conn->prepare($query);

        $title = $this->conn->real_escape_string(htmlspecialchars(strip_tags($title)));
        $content = $this->conn->real_escape_string(htmlspecialchars(strip_tags($content)));
        $categoryId = $this->conn->real_escape_string(htmlspecialchars(strip_tags($categoryId)));
        $languageId = $this->conn->real_escape_string(htmlspecialchars(strip_tags($languageId)));
        $userId = $this->conn->real_escape_string(htmlspecialchars(strip_tags($userId)));

        $stmt->bind_param("ssiii", $title, $content, $categoryId, $languageId, $userId);

        if($stmt->execute()) {
            return $stmt->insert_id;
        }
        return false;
    }

    // Method Edit existing article
    public function editArticle($articleId, $title, $content, $categoryId, $languageId) {
        $query = "UPDATE " . $this->article_table . "
                 SET articleTitle = ?,
                     articleContent = ?,
                     categoryId = ?,
                     languageId = ?
                 WHERE articleId = ?";

        $stmt = $this->conn->prepare($query);

        $title = $this->conn->real_escape_string(htmlspecialchars(strip_tags($title)));
        $content = $this->conn->real_escape_string(htmlspecialchars(strip_tags($content)));
        $categoryId = $this->conn->real_escape_string(htmlspecialchars(strip_tags($categoryId)));
        $languageId = $this->conn->real_escape_string(htmlspecialchars(strip_tags($languageId)));
        $articleId = $this->conn->real_escape_string(htmlspecialchars(strip_tags($articleId)));

        $stmt->bind_param("ssiii", $title, $content, $categoryId, $languageId, $articleId);

        return $stmt->execute();
    }

    // Method Remove article
    public function removeArticle($articleId) {
        $query = "DELETE FROM " . $this->article_table . " 
                 WHERE articleId = ?";

        $stmt = $this->conn->prepare($query);
        $articleId = $this->conn->real_escape_string(htmlspecialchars(strip_tags($articleId)));
        $stmt->bind_param("i", $articleId);

        return $stmt->execute();
    }
}
?>