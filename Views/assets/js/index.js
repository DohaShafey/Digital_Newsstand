document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        
        // هنا يمكنك إضافة التحقق من صحة البيانات
        if (email && password) {
            // في النسخة النهائية، هنا سيتم إرسال البيانات إلى الخادم
            console.log('تم إرسال بيانات تسجيل الدخول:', { email, password });
            
            // تحويل المستخدم إلى الصفحة الرئيسية
            // window.location.href = 'index.html';
        }
    });

    // إضافة تأثيرات بصرية للأزرار
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.addEventListener('mousedown', function() {
            this.style.transform = 'scale(0.98)';
        });
        
        button.addEventListener('mouseup', function() {
            this.style.transform = 'scale(1)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});
