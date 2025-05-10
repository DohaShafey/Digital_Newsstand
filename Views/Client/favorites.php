<?php require_once '../assets/include/header.php'; ?>

    
    <main class="favorites-container">
        <h1 class="page-title">Favorites</h1>

        <div class="favorites-tabs">
            <button class="tab-btn active" data-tab="articles">Saved Articles</button>
            <button class="tab-btn" data-tab="sections">Favorite Sections</button>
            <button class="tab-btn" data-tab="topics">Followed Topics</button>
        </div>

        <div class="tab-content active" id="articles">
            <div class="saved-articles-grid">
                <!-- Saved Articles -->
                <div class="article-card">
                    <img src="https://i.pinimg.com/736x/6e/0e/39/6e0e395e204ac6e28b8f437a1123c947.jpg" alt="Article 1">
                    <div class="article-content">
                        <span class="category">Technology</span>
                        <h3>Latest Developments in Artificial Intelligence</h3>
                        <p>New developments in artificial intelligence are changing the future of technology...</p>
                        <div class="article-meta">
                            <span class="date">January 15, 2024</span>
                            <button class="remove-btn">Remove</button>
                        </div>
                    </div>
                </div>

                <div class="article-card">
                    <img src="https://i.pinimg.com/736x/33/ba/13/33ba1393b35d31f2a1c3f8b9306e39e6.jpg" alt="Article 2">
                    <div class="article-content">
                        <span class="category">Sports</span>
                        <h3>World Cup Results</h3>
                        <p>Key events and results from the World Cup competitions...</p>
                        <div class="article-meta">
                            <span class="date">January 14, 2024</span>
                            <button class="remove-btn">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content" id="sections">
            <div class="favorite-sections-grid">
                <!-- Favorite Sections -->
                <div class="section-card">
                    <div class="section-icon">📱</div>
                    <h3>Technology</h3>
                    <p>Latest technology news and innovations</p>
                    <button class="unfollow-btn">Unfollow</button>
                </div>

                <div class="section-card">
                    <div class="section-icon">🎮</div>
                    <h3>Games</h3>
                    <p>Latest news on games and entertainment</p>
                    <button class="unfollow-btn">Unfollow</button>
                </div>
            </div>
        </div>

        <div class="tab-content" id="topics">
            <div class="followed-topics">
                <!-- Followed Topics -->
                <div class="topic-card">
                    <h3># Artificial_Intelligence</h3>
                    <span class="articles-count">25 Articles</span>
                    <button class="unfollow-btn">Unfollow</button>
                </div>

                <div class="topic-card">
                    <h3># World_Cup</h3>
                    <span class="articles-count">18 Articles</span>
                    <button class="unfollow-btn">Unfollow</button>
                </div>
            </div>
        </div>
    </main>

<?php require_once '../assets/include/footer.php'; ?>
