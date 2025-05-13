<?php require_once '../assets/include/header.php'; ?>

<main>
    <section class="admin-section">
        <div class="tab-titles">
            <h2 id="articlesTab" class="activeBtn disableBtn">Manage Articles</h2>
            <h2 id="categoriesTab" class="disableBtn">Manage Categories</h2>
        </div>

        <!-- === Start: Articles Section === -->
        <div id="articlesSection">
            <div class="action-buttons">
                <button id="addArticleBtn">Add Article</button>
                <button id="removeArticleBtn">Remove Article</button>
                <button id="updateArticleBtn">Update Article</button>
            </div>

            <!-- Add Article Form -->
            <form id="addArticleForm" class="content-form">
                <h3>Add New Article</h3>
                <input type="text" id="articleTitle" placeholder="Article Title" required>
                <textarea id="articleSummary" placeholder="Article Content" required></textarea>
                <input type="url" id="articleImage" placeholder="Image URL" required>
                <input type="text" id="articleCategory" placeholder="Category" required>
                <input type="text" id="articleLanguage" placeholder="Language" required>
                <input type="date" id="articleDate" required>
                <button type="submit">Add Article</button>
            </form>

            <!-- Remove Article Form -->
            <form id="removeArticleForm" class="content-form" style="display:none;">
                <h3>Remove Article</h3>
                <input type="number" id="articleIdToRemove" placeholder="Article ID to Remove" required>
                <button type="submit">Remove Article</button>
            </form>

            <!-- Update Article Form -->
            <form id="updateArticleForm" class="content-form" style="display:none;">
                <h3>Update Article</h3>
                <input type="number" id="articleIdToUpdate" placeholder="Article ID to Update" required>
                <input type="text" id="updatedTitle" placeholder="New Title" required>
                <textarea id="updatedSummary" placeholder="New Content" required></textarea>
                <input type="url" id="updatedImage" placeholder="New Image URL" required>
                <input type="text" id="updatedCategory" placeholder="New Category" required>
                <input type="text" id="updatedLanguage" placeholder="New Language" required>
                <input type="date" id="updatedDate" required>
                <button type="submit">Update Article</button>
            </form>
        </div>
        <!-- === End: Articles Section === -->

        <!-- === Start: Categories Section === -->
        <div id="categoriesSection" style="display: none;">
            <div class="action-buttons">
                <button id="addCategoryBtn">Add Category</button>
                <button id="removeCategoryBtn">Remove Category</button>
            </div>

            <!-- Add Category Form -->
            <form id="addCategoryForm" class="content-form">
                <h3>Add Category</h3>
                <input type="text" id="categoryIdToAdd" placeholder="Category Name to Add" required>
                <button type="submit">Add Category</button>
            </form>

            <!-- Remove Category Form -->
            <form id="removeCategoryForm" class="content-form">
                <h3>Remove Category</h3>
                <input type="text" id="categoryIdToremove" placeholder="Category Name to Remove" required>
                <button type="submit">Remove Category</button>
            </form>
        </div>
        <!-- === End: Categories Section === -->

    </section>
</main>

<script>const articlesTab = document.getElementById('articlesTab');
const categoriesTab = document.getElementById('categoriesTab');

const articlesSection = document.querySelector('.action-buttons').parentElement; // admin-section
const categoriesSection = document.getElementById('categoriesSection');

// عند الضغط على "Manage Articles"
articlesTab.addEventListener('click', () => {
    articlesTab.classList.add('activeBtn');
    categoriesTab.classList.remove('activeBtn');

    articlesSection.style.display = 'block';
    categoriesSection.style.display = 'none';
});

// عند الضغط على "Manage Categories"
categoriesTab.addEventListener('click', () => {
    categoriesTab.classList.add('activeBtn');
    articlesTab.classList.remove('activeBtn');

    articlesSection.style.display = 'none';
    categoriesSection.style.display = 'block';
});

</script>

<?php require_once '../assets/include/footer.php'; ?>
