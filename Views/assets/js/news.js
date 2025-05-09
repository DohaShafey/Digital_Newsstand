// بيانات تجريبية للأخبار
const newsData = [
    {
        id: 1,
        title: "New Developments in Artificial Intelligence",
        summary: "Revolutionary discoveries in AI open new horizons",
        image: "https://i.pinimg.com/736x/6e/0e/39/6e0e395e204ac6e28b8f437a1123c947.jpg",
        category: "Technology",
        source: "Source One",
        date: "2025-01-15",
        views: 1500
    },
    {
        id: 2,
        title: "Sporting Achievements in the World Championship",
        summary: "Impressive results by athletes in the recent world championship",
        image: "https://i.pinimg.com/736x/33/ba/13/33ba1393b35d31f2a1c3f8b9306e39e6.jpg",
        category: "Sports",
        source: "Source Two",
        date: "2025-01-14",
        views: 2000
    },
    // إضافة المزيد من الأخبار التجريبية هنا
];

const breakingNews = [
    {
        id: 1,
        title: "Breaking News: New Scientific Discovery",
        image: "https://i.pinimg.com/736x/6f/8f/a2/6f8fa2302f24279788ce7520002eaecb.jpg",
        time: "5 minutes ago"
    },
    {
        id: 2,
        title: "Major Developments in Global Events",
        image: "https://i.pinimg.com/736x/78/ec/f8/78ecf88e15e9baace016b08db9e14bca.jpg",
        time: "15 minutes ago"
    },
    // إضافة المزيد من الأخبار العاجلة
];

// دالة لإنشاء بطاقة خبر
function createNewsCard(news) {
    return `
        <article class="news-card">
            <img src="${news.image}" alt="${news.title}">
            <div class="news-card-content">
                <span class="category">${news.category}</span>
                <h3>${news.title}</h3>
                <p>${news.summary}</p>
                <div class="news-meta">
                    <span>${news.source}</span>
                    <span>${new Date(news.date).toLocaleDateString('ar-EG')}</span>
                </div>
            </div>
        </article>
    `;
}

// دالة لإنشاء عنصر خبر عاجل
function createBreakingNewsItem(news) {
    return `
        <div class="trending-item">
            <img src="${news.image}" alt="${news.title}">
            <div class="trending-item-content">
                <h4>${news.title}</h4>
                <span>${news.time}</span>
            </div>
        </div>
    `;
}

// تهيئة الصفحة
document.addEventListener('DOMContentLoaded', function() {
    // عرض الأخبار الرئيسية
    const newsGrid = document.getElementById('newsGrid');
    newsGrid.innerHTML = newsData.map(news => createNewsCard(news)).join('');

    // عرض الأخبار العاجلة
    const breakingNewsContainer = document.getElementById('breakingNews');
    breakingNewsContainer.innerHTML = breakingNews.map(news => createBreakingNewsItem(news)).join('');

    // معالجة البحث
    const searchBtn = document.querySelector('.search-btn');
    const searchInput = document.querySelector('.search-box input');

    searchBtn.addEventListener('click', function() {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredNews = newsData.filter(news => 
            news.title.toLowerCase().includes(searchTerm) ||
            news.summary.toLowerCase().includes(searchTerm) ||
            news.category.toLowerCase().includes(searchTerm)
        );
        newsGrid.innerHTML = filteredNews.map(news => createNewsCard(news)).join('');
    });

    // معالجة الترتيب
    const sortSelect = document.querySelector('.sort-select');
    sortSelect.addEventListener('change', function() {
        let sortedNews = [...newsData];
        switch(this.value) {
            case 'newest':
                sortedNews.sort((a, b) => new Date(b.date) - new Date(a.date));
                break;
            case 'oldest':
                sortedNews.sort((a, b) => new Date(a.date) - new Date(b.date));
                break;
            case 'popular':
                sortedNews.sort((a, b) => b.views - a.views);
                break;
        }
        newsGrid.innerHTML = sortedNews.map(news => createNewsCard(news)).join('');
    });

    // معالجة التصفية
    const filterCheckboxes = document.querySelectorAll('.filter-option input');
    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const selectedCategories = Array.from(filterCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            if (selectedCategories.length === 0) {
                newsGrid.innerHTML = newsData.map(news => createNewsCard(news)).join('');
            } else {
                const filteredNews = newsData.filter(news => 
                    selectedCategories.includes(news.category.toLowerCase())
                );
                newsGrid.innerHTML = filteredNews.map(news => createNewsCard(news)).join('');
            }
        });
    });

    // معالجة الترقيم
    const pageNumbers = document.querySelectorAll('.page-numbers span');
    pageNumbers.forEach(page => {
        page.addEventListener('click', function() {
            pageNumbers.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            // هنا يمكن إضافة منطق تحميل الصفحة المناسبة
        });
    });
});
