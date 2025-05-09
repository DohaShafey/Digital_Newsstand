document.addEventListener('DOMContentLoaded', function() {
    // تحديث عدد المقالات في كل قسم
    updateArticleCounts();

    // إضافة تأثيرات حركية للبطاقات
    animateSectionCards();

    // تحديث المواضيع الرائجة
    updateTrendingTopics();
});

function updateArticleCounts() {
    // يمكن استبدال هذا بطلب API للحصول على الأعداد الفعلية
    const counts = document.querySelectorAll('.article-count');
    counts.forEach(count => {
        const number = parseInt(count.textContent);
        count.innerHTML = `<strong>${number}</strong> مقال`;
    });
}

function animateSectionCards() {
    const cards = document.querySelectorAll('.section-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

function updateTrendingTopics() {
    // يمكن استبدال هذا بطلب API للحصول على المواضيع الرائجة الفعلية
    const topics = [
        { name: "الذكاء الاصطناعي", count: 156 },
        { name: "كأس العالم", count: 89 },
        { name: "الاقتصاد الرقمي", count: 67 },
        { name: "الطاقة المتجددة", count: 45 },
        { name: "الصحة النفسية", count: 34 },
        { name: "التعليم عن بعد", count: 23 }
    ];

    const topicsGrid = document.querySelector('.topics-grid');
    topics.forEach(topic => {
        const tag = document.createElement('a');
        tag.href = '#';
        tag.className = 'topic-tag';
        tag.textContent = `${topic.name} (${topic.count})`;
        tag.addEventListener('click', (e) => {
            e.preventDefault();
            navigateToTopic(topic.name);
        });
        topicsGrid.appendChild(tag);
    });
}

function navigateToTopic(topicName) {
    // يمكن تنفيذ التنقل إلى صفحة الموضوع هنا
    console.log(`Navigating to topic: ${topicName}`);
}

// تتبع المستخدمين للأقسام المفضلة
let favoriteSections = JSON.parse(localStorage.getItem('favoriteSections')) || [];

function toggleFavoriteSection(sectionId) {
    const index = favoriteSections.indexOf(sectionId);
    if (index === -1) {
        favoriteSections.push(sectionId);
    } else {
        favoriteSections.splice(index, 1);
    }
    localStorage.setItem('favoriteSections', JSON.stringify(favoriteSections));
    updateFavoriteUI(sectionId);
}

function updateFavoriteUI(sectionId) {
    const button = document.querySelector(`[data-section-id="${sectionId}"]`);
    if (button) {
        button.classList.toggle('favorited');
    }
}
