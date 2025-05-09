// Sample data for related articles
const relatedArticles = [
    {
        id: 1,
        title: "How is AI changing the future of work?",
        image: "https://i.pinimg.com/736x/6e/95/a5/6e95a52b938671edb13ed90d21eb4ddb.jpg",
        date: "January 14, 2025"
    },
    {
        id: 2,
        title: "AI applications in healthcare",
        image: "https://i.pinimg.com/736x/fb/37/8c/fb378c77700fffc9749192236b29b084.jpg",
        date: "January 13, 2025"
    },
    {
        id: 3,
        title: "The future of education with AI technologies",
        image: "https://i.pinimg.com/736x/ec/59/4d/ec594d5b9cd8e8cbc939a8744370d661.jpg",
        date: "January 12, 2025"
    }
];

// Function to create a related article element
function createRelatedArticle(article) {
    return `
        <div class="related-article">
            <img src="${article.image}" alt="${article.title}">
            <div class="related-article-content">
                <h4>${article.title}</h4>
                <span>${article.date}</span>
            </div>
        </div>
    `;
}

// Initialize the page
document.addEventListener('DOMContentLoaded', function() {
    // Display related articles
    const relatedGrid = document.getElementById('relatedArticles');
    relatedGrid.innerHTML = relatedArticles.map(article => createRelatedArticle(article)).join('');

    // Handle share button
    const shareBtn = document.querySelector('.share-btn');
    shareBtn.addEventListener('click', function() {
        if (navigator.share) {
            navigator.share({
                title: document.querySelector('.article-title').textContent,
                text: document.querySelector('.article-summary').textContent,
                url: window.location.href
            })
            .catch(console.error);
        } else {
            // Copy link to clipboard as fallback
            const dummy = document.createElement('input');
            document.body.appendChild(dummy);
            dummy.value = window.location.href;
            dummy.select();
            document.execCommand('copy');
            document.body.removeChild(dummy);
            alert('Link copied!');
        }
    });

    // Handle save button
    const saveBtn = document.querySelector('.save-btn');
    saveBtn.addEventListener('click', function() {
        this.classList.toggle('saved');
        if (this.classList.contains('saved')) {
            this.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24">
                    <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z"/>
                </svg>
                Saved
            `;
        } else {
            this.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                </svg>
                Save Article
            `;
        }
    });
});

// Update view count
function updateViewCount() {
    // Logic to update view count can be added here
}

// Load comments
function loadComments() {
    // Logic to load comments can be added here
}

// Handle print button
document.getElementById("print-btn").addEventListener("click", function () {
    window.print();
});
