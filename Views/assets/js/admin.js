// بيانات المقالات المخزنة محليًا للمحاكاة
let articles = JSON.parse(localStorage.getItem('articles')) || [
    { id: 1, title: 'أحدث التطورات التكنولوجية في 2024', category: 'تكنولوجيا', Language: 'عربي'},
    { id: 2, title: 'نصائح للحفاظ على الصحة النفسية', category: 'صحة', Language: 'انجليزي' }
];

document.addEventListener('DOMContentLoaded', function() {
    // عناصر النماذج والأزرار
    const addArticleForm = document.getElementById('addArticleForm');
    const removeArticleForm = document.getElementById('removeArticleForm');
    const updateArticleForm = document.getElementById('updateArticleForm');
    const addCategoryForm = document.getElementById('addCategoryForm');
    const removeCategoryForm = document.getElementById('removeCategoryForm');

    const addArticleBtn = document.getElementById('addArticleBtn');
    const removeArticleBtn = document.getElementById('removeArticleBtn');
    const updateArticleBtn = document.getElementById('updateArticleBtn');
    const addCategoryBtn = document.getElementById('addCategoryBtn');
    const removeCategoryBtn = document.getElementById('removeCategoryBtn');

    // التبديل بين النماذج
    addArticleBtn.addEventListener('click', function() {
        addArticleForm.style.display = 'block';
        removeArticleForm.style.display = 'none';
        updateArticleForm.style.display = 'none';
        addCategoryForm.style.display = 'none';
        removeCategoryForm.style.display = 'none';
    });
    
    removeArticleBtn.addEventListener('click', function() {
        removeArticleForm.style.display = 'block';
        addArticleForm.style.display = 'none';
        updateArticleForm.style.display = 'none';
        addCategoryForm.style.display = 'none';
        removeCategoryForm.style.display = 'none';
    });
    
    updateArticleBtn.addEventListener('click', function() {
        updateArticleForm.style.display = 'block';
        addArticleForm.style.display = 'none';
        removeArticleForm.style.display = 'none';
        addCategoryForm.style.display = 'none';
        removeCategoryForm.style.display = 'none';
    });
    
    addCategoryBtn.addEventListener('click', function() {
        addCategoryForm.style.display = 'block';
        updateArticleForm.style.display = 'none';
        addArticleForm.style.display = 'none';
        removeArticleForm.style.display = 'none';
        removeCategoryForm.style.display = 'none';
    });

    removeCategoryBtn.addEventListener('click', function() {
        removeCategoryForm.style.display = 'block';
        updateArticleForm.style.display = 'none';
        addArticleForm.style.display = 'none';
        removeArticleForm.style.display = 'none';
        addCategoryForm.style.display = 'none';
    });

    // إضافة مقال
    addArticleForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const newArticle = {
            id: Date.now(),
            title: document.getElementById('articleTitle').value,
            summary: document.getElementById('articleSummary').value,
            image: document.getElementById('articleImage').value,
            category: document.getElementById('articleCategory').value,
            Language: document.getElementById('articleLanguage').value,
            date: document.getElementById('articleDate').value,
            link: 'article.html'
        };

        articles.push(newArticle);
        localStorage.setItem('articles', JSON.stringify(articles));
        addArticleForm.reset();
        alert('تم إضافة المقال بنجاح');
    });

    // حذف مقال
    removeArticleForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const articleId = document.getElementById('articleIdToRemove').value;

        articles = articles.filter(article => article.id != articleId);
        localStorage.setItem('articles', JSON.stringify(articles));
        removeArticleForm.reset();
        alert('تم حذف المقال بنجاح');
    });
    
    // تحديث مقال
    updateArticleForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const idToUpdate = Number(document.getElementById('articleIdToUpdate').value);
        const updatedTitle = document.getElementById('updatedTitle').value;
        const updatedSummary = document.getElementById('updatedSummary').value;
        const updatedImage = document.getElementById('updatedImage').value;
        const updatedCategory = document.getElementById('updatedCategory').value;
        const updatedLanguage = document.getElementById('updatedLanguage').value;
        const updatedDate = document.getElementById('updatedDate').value;
        
        const index = articles.findIndex(article => article.id === idToUpdate);
        
        if (index !== -1) {
            articles[index] = {
                ...articles[index],
                title: updatedTitle,
                summary: updatedSummary,
                image: updatedImage,
                category: updatedCategory,
                date: updatedDate
            };
            
            localStorage.setItem('articles', JSON.stringify(articles));
            updateArticleForm.reset();
            alert('تم تحديث المقال بنجاح');
        } else {
            alert('لم يتم العثور على مقال بهذا المعرف');
        }
    });

    // إضافة قسم
    addCategoryForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // const articleId = document.getElementById('addCategoryForm').value;
    
        // articles = articles.filter(article => article.id != articleId);
        // localStorage.setItem('articles', JSON.stringify(articles));
        addCategoryForm.reset();
        alert('تم اضافة القسم بنجاح');
    });

    removeCategoryForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // const articleId = document.getElementById('addCategoryForm').value;
    
        // articles = articles.filter(article => article.id != articleId);
        // localStorage.setItem('articles', JSON.stringify(articles));
        addCategoryForm.reset();
        alert('تم اضافة القسم بنجاح');
    });
});
