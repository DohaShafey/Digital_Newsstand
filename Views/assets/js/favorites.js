document.addEventListener('DOMContentLoaded', function() {
    // تهيئة التبويبات
    initializeTabs();

    // تهيئة أزرار الإزالة
    initializeRemoveButtons();

    // تهيئة أزرار إلغاء المتابعة
    initializeUnfollowButtons();
});

function initializeTabs() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // إزالة الحالة النشطة من جميع الأزرار
            tabButtons.forEach(btn => btn.classList.remove('active'));
            // إضافة الحالة النشطة للزر المحدد
            button.classList.add('active');

            // إخفاء جميع المحتويات
            tabContents.forEach(content => content.classList.remove('active'));
            // إظهار المحتوى المطلوب
            const targetTab = button.dataset.tab;
            document.getElementById(targetTab).classList.add('active');
        });
    });
}

function initializeRemoveButtons() {
    const removeButtons = document.querySelectorAll('.remove-btn');
    removeButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const articleCard = this.closest('.article-card');
            
            // إضافة تأثير حركي قبل الإزالة
            articleCard.style.opacity = '0';
            articleCard.style.transform = 'scale(0.8)';
            
            setTimeout(() => {
                articleCard.remove();
                updateEmptyState();
            }, 300);
        });
    });
}

function initializeUnfollowButtons() {
    const unfollowButtons = document.querySelectorAll('.unfollow-btn');
    unfollowButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const card = this.closest('.section-card, .topic-card');
            
            // إضافة تأثير حركي قبل الإزالة
            card.style.opacity = '0';
            card.style.transform = 'scale(0.8)';
            
            setTimeout(() => {
                card.remove();
                updateEmptyState();
            }, 300);
        });
    });
}

function updateEmptyState() {
    // التحقق من وجود عناصر في كل تبويب
    const tabs = ['articles', 'sections', 'topics'];
    
    tabs.forEach(tabId => {
        const container = document.getElementById(tabId);
        const items = container.querySelectorAll('.article-card, .section-card, .topic-card');
        
        if (items.length === 0) {
            const emptyMessage = document.createElement('div');
            emptyMessage.className = 'empty-state';
            emptyMessage.innerHTML = `
                <div class="empty-icon">📭</div>
                <h3>لا يوجد محتوى</h3>
                <p>لم تقم بحفظ أي عناصر في هذا القسم بعد</p>
            `;
            container.appendChild(emptyMessage);
        }
    });
}

// حفظ التفضيلات في التخزين المحلي
function savePreferences() {
    const savedArticles = Array.from(document.querySelectorAll('.article-card')).map(card => {
        return {
            id: card.dataset.id,
            title: card.querySelector('h3').textContent,
            category: card.querySelector('.category').textContent
        };
    });

    localStorage.setItem('savedArticles', JSON.stringify(savedArticles));
}

// استرجاع التفضيلات من التخزين المحلي
function loadPreferences() {
    const savedArticles = JSON.parse(localStorage.getItem('savedArticles')) || [];
    // تنفيذ استرجاع المقالات المحفوظة
}
