<?php require_once '../assets/include/header.php'; ?>


    <main class="news-container">
        <!-- Filter and Search Section -->
        <aside class="filters-sidebar">
            <div class="filter-section">
                <h3>Categories</h3>
                <div class="filter-options">
                    <label class="filter-option">
                        <input type="checkbox" value="politics"> Politics
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" value="technology"> Technology
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" value="sports"> Sports
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" value="economy"> Economy
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" value="health"> Health
                    </label>
                </div>
            </div>

            <div class="filter-section">
                <h3>Sources</h3>
                <div class="filter-options">
                    <label class="filter-option">
                        <input type="checkbox" value="source1"> Source 1
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" value="source2"> Source 2
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" value="source3"> Source 3
                    </label>
                </div>
            </div>

            <div class="filter-section">
                <h3>Date</h3>
                <select class="date-filter">
                    <option value="today">Today</option>
                    <option value="week">Last Week</option>
                    <option value="month">Last Month</option>
                    <option value="year">Last Year</option>
                </select>
            </div>
        </aside>

        <!-- Main News Section -->
        <section class="news-content">
            <div class="news-header">
                <h1>Latest News</h1>
                <div class="news-controls">
                    <div class="search-box">
                        <input type="text" placeholder="Search in news...">
                        <button class="search-btn">Search</button>
                    </div>
                    <select class="sort-select">
                        <option value="newest">Newest</option>
                        <option value="oldest">Oldest</option>
                        <option value="popular">Most Read</option>
                    </select>
                </div>
            </div>

            <div class="news-grid" id="newsGrid">
                <!-- Will be filled by JavaScript -->
            </div>

            <div class="pagination">
                <button class="pagination-btn" disabled>Previous</button>
                <div class="page-numbers">
                    <span class="active">1</span>
                    <span>2</span>
                    <span>3</span>
                    <span>...</span>
                    <span>10</span>
                </div>
                <button class="pagination-btn">Next</button>
            </div>
        </section>

        <!-- Trending News Sidebar -->
        <aside class="trending-sidebar">
            <div class="trending-section">
                <h3>Breaking News</h3>
                <div class="trending-news" id="breakingNews">
                    <!-- Will be filled by JavaScript -->
                </div>
            </div>

            <div class="trending-section">
                <h3>Most Read</h3>
                <div class="trending-news" id="popularNews">
                    <!-- Will be filled by JavaScript -->
                </div>
            </div>
        </aside>
    </main>

<?php require_once '../assets/include/footer.php'; ?>
