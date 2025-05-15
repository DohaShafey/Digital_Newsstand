<?php

require_once '../assets/include/header.php';


if (!isset($_SESSION['user']['userId'])) {

    echo "<main class='news-container'><p>Please <a href='../Auth/index.php'>log in</a> to see your personalized news feed.</p></main>";
    require_once '../assets/include/footer.php';
    exit();

    $userId = $_SESSION['user']['userId'];
    $articles = [];
}

global $db;
$userId = $_SESSION['user']['userId'];
$articles = [];
if (!isset($db) || !$db instanceof DBController) {

    require_once __DIR__ . '/../../Controllers/DBController.php';
    $db = new DBController();
    if (!$db->openConnection()) {
        echo "<main class='news-container'><p>Database connection failed. Cannot load news.</p></main>";
        require_once '../assets/include/footer.php';
        exit();
    }
}

$preferredCategoryIds = [];
if ($db && $db->conn) {
    $escapedUserId = $db->escape($userId);
    $preferredCategoriesQuery = "SELECT categoryId FROM user_category WHERE userId = '{$escapedUserId}'";
    $preferredCategoriesResult = $db->select($preferredCategoriesQuery);

    if (is_array($preferredCategoriesResult) && !empty($preferredCategoriesResult)) {
        foreach ($preferredCategoriesResult as $row) {
            $preferredCategoryIds[] = $db->escape($row['categoryId']);
        }
    }

    if (!empty($preferredCategoryIds)) {
        $categoryIdsString = "'" . implode("','", $preferredCategoryIds) . "'";
        $articlesQuery = "SELECT a.articleId, a.articleTitle, a.articleAuthor, a.articleContent,
                                 a.articleImg, a.articlePublicationDate,
                                 c.categoryName, u.userName AS authorName
                          FROM article a
                          LEFT JOIN category c ON a.categoryId = c.categoryId
                          LEFT JOIN user u ON a.userId = u.userId
                          WHERE a.categoryId IN ({$categoryIdsString}) and a.categoryId = 
                          ORDER BY a.articlePublicationDate DESC
                          LIMIT 50";
        $articlesResult = $db->select($articlesQuery);
        if (is_array($articlesResult)) {
            $articles = $articlesResult;
        } else {
            error_log("Error fetching preferred articles for user ID: {$userId}");
        }
    } else {

        $genericArticlesQuery = "SELECT a.articleId, a.articleTitle, a.articleAuthor, a.articleContent,
                                      a.articleImg, a.articlePublicationDate,
                                      c.categoryName, u.userName AS authorName
                               FROM article a
                               LEFT JOIN category c ON a.categoryId = c.categoryId
                               LEFT JOIN user u ON a.userId = u.userId
                               ORDER BY a.articlePublicationDate DESC
                               LIMIT 21";
        $articlesResult = $db->select($genericArticlesQuery);
        if (is_array($articlesResult)) {
            $articles = $articlesResult;
        }
    }



} else if (!isset($db)) {
    echo "<main class='news-container'><p>Database controller not available.</p></main>";
} else if (!$db->conn) {
    echo "<main class='news-container'><p>Database connection error.</p></main>";
}

?>

<main class="news-container for-you-layout">
    <aside class="games-sidebar">
        <h3><pre>           Followed</pre></h3>    
    </aside>     


    <section class="news-content-foryou">
        <div class="news-header">
            <h1><pre>                                                 Articles For You</pre></h1>
        </div>

        <div class="news-grid-foryou" id="newsGrid">
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $article): ?>
                    <?php
                    $articleId = htmlspecialchars($article['articleId'] ?? '');
                    $title = htmlspecialchars($article['articleTitle'] ?? 'No Title');
                    $summary = htmlspecialchars(substr(strip_tags($article['articleContent'] ?? ''), 0, 100)) . '...';

                    $image_url = $article['articleImg'] ?? '../assets/images/default-placeholder.png';
                    if (!preg_match("~^(?:f|ht)tps?://~i", $image_url) && $image_url !== '../assets/images/default-placeholder.png') {

                    }
                    $image = htmlspecialchars($image_url);

                    $category = htmlspecialchars($article['categoryName'] ?? 'General');
                    $author = htmlspecialchars($article['authorName'] ?? $article['articleAuthor'] ?? 'Unknown Author');
                    $date = isset($article['articlePublicationDate']) ? htmlspecialchars(date('M d, Y', strtotime($article['articlePublicationDate']))) : 'N/A';
                    $articleUrl = "article.php?id=" . urlencode($articleId);
                    ?>
                    <article class="news-card">
                        <a href="<?= $articleUrl ?>" class="news-card-link">
                            <img src="<?= $image ?>" alt="<?= $title ?>">
                            <div class="news-card-content">
                                <span class="category"><?= $category ?></span>
                                <h3><?= $title ?></h3>
                                <p><?= $summary ?></p>
                                <div class="news-meta">
                                    <span>By: <?= $author ?></span>
                                    <span><?= $date ?></span>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-articles-msg">No articles found matching your preferred categories yet. Explore sections to add
                    preferences, or check out the latest articles!</p>
                <?php if (empty($preferredCategoryIds)): ?>
                    <p class="no-articles-msg">You haven't set any preferred categories. Visit the sections page to select your
                        interests!</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php require_once '../assets/include/footer.php'; ?>