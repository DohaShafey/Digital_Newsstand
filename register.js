document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('registerForm');

    registerForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const language = document.getElementById('language').value;
        const interestsSelect = document.getElementById('interests');
        const interests = Array.from(interestsSelect.selectedOptions).map(opt => opt.value);

        if (name && email && password && language && interests.length > 0) {
            console.log('تم إنشاء حساب جديد:', {
                name,
                email,
                password,
                language,
                interests
            });

            alert('تم التسجيل بنجاح! سيتم تحويلك إلى صفحة تسجيل الدخول.');
            window.location.href = 'login.html';
        } else {
            alert('يرجى تعبئة جميع الحقول واختيار الاهتمامات.');
        }
    });

    // تأثير بصري للأزرار
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.addEventListener('mousedown', () => button.style.transform = 'scale(0.98)');
        button.addEventListener('mouseup', () => button.style.transform = 'scale(1)');
        button.addEventListener('mouseleave', () => button.style.transform = 'scale(1)');
    });
});
