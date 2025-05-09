// Sample article data
const articles = [
    {
        id: 1,
        title: "Latest Tech Innovations in 2025",
        summary: "Discover the top technological breakthroughs will shape our lives this year.",
        image: "https://i.pinimg.com/736x/9d/9a/6b/9d9a6b8c7dcf47c88adb535a8e7535ed.jpg",
        author: "Ahmed Mohamed",
        date: "2025-01-15",
        category: "Technology",
        link: "article.html"
    },
    {
        id: 2,
        title: "Mental Health Tips",
        summary: "Your ultimate guide to maintaining mental well-being in the digital age.",
        image: "https://i.pinimg.com/736x/b3/83/0c/b3830c08db644727f3f6fd1383e3a3c6.jpg",
        author: "Sarah Ahmed",
        date: "2025-01-14",
        category: "Health",
        link: "article2.html"
    },
    {
        id: 3,
        title: "Top Travel Destinations for 2025",
        summary: "Explore the most beautiful places to visit this year.",
        image: "https://i.pinimg.com/736x/01/57/58/01575825ecc11c7899ca0faa8ce0ebae.jpg",
        author: "Mohammad Ali",
        date: "2025-01-13",
        category: "Travel",
        link: "article3.html"
    },
    {
        id: 4,
        title: "The New World of Artificial Intelligence",
        summary: "How AI is changing our daily lives.",
        image: "https://i.pinimg.com/736x/4d/8c/55/4d8c559a20d1bc6e505d940288261648.jpg",
        author: "Laila Kareem",
        date: "2025-01-12",
        category: "Technology",
        link: "article4.html"
    },
    {
        id: 5,
        title: "Smart Investment Tips",
        summary: "A beginner's guide to investing in financial markets.",
        image: "https://i.pinimg.com/736x/0a/3f/12/0a3f12ee19c475d1f3b5ee94bc102085.jpg",
        author: "Omar Hassan",
        date: "2025-01-11",
        category: "Economy",
        link: "article5.html"
    },
    {
        id: 6,
        title: "Spring 2025 Fashion Trends",
        summary: "Check out the hottest fashion trends for the upcoming season.",
        image: "https://i.pinimg.com/736x/62/e7/44/62e7446e658ef868977d23c898417ccb.jpg",
        author: "Noor Mohamed",
        date: "2025-01-10",
        category: "Fashion",
        link: "article6.html"
    }
];

// Function to create article cards
function createArticleCard(article) {
    return `
        <a href="${article.link}"><article class="article-card">
            <img src="${article.image}" alt="${article.title}">
            <div class="article-content">
                <h3>${article.title}</h3>
                <p>${article.summary}</p>
                <div class="article-meta">
                    <span>${article.author}</span>
                    <span>${new Date(article.date).toLocaleDateString('en-US')}</span>
                </div>
            </div>
        </article>
        </a>
    `;
}

// Display all articles
function displayArticles() {
    const container = document.getElementById('articles-container');
    container.innerHTML = articles.map(article => createArticleCard(article)).join('');
}

// User interests (customizable per user, e.g., from database)
const userInterests = ["Technology", "Health", "Travel"]; // edit as needed

// Display "For You" articles
function displayForYouArticles() {
    const forYouContainer = document.getElementById('foryou-container');
    const filteredArticles = articles.filter(article => 
        userInterests.includes(article.category)
    );
    forYouContainer.innerHTML = filteredArticles.map(article => createArticleCard(article)).join('');
}

// Initialize the page
document.addEventListener('DOMContentLoaded', function() {
    displayArticles();
    displayForYouArticles(); 

    // Handle search
    const searchInput = document.querySelector('.search-bar input');
    const searchButton = document.querySelector('.search-bar button');

    function handleSearch() {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredArticles = articles.filter(article => 
            article.title.toLowerCase().includes(searchTerm) ||
            article.summary.toLowerCase().includes(searchTerm) ||
            article.category.toLowerCase().includes(searchTerm)
        );
        
        const container = document.getElementById('articles-container');
        container.innerHTML = filteredArticles.map(article => createArticleCard(article)).join('');
    }

    searchButton.addEventListener('click', handleSearch);
    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            handleSearch();
        }
    });

    // Handle category click
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach(card => {
        card.addEventListener('click', function() {
            const category = this.querySelector('h3').textContent;
            const filteredArticles = articles.filter(article => 
                article.category === category
            );
            const container = document.getElementById('articles-container');
            container.innerHTML = filteredArticles.map(article => createArticleCard(article)).join('');
        });
    });
});
