document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('.select-button');

  buttons.forEach(button => {
    button.addEventListener('click', function () {
      const planName = this.parentElement.querySelector('h3').textContent;
      alert(`You selected the ${planName} plan!`);
      // ممكن هون يتم تحويل المستخدم لصفحة الدفع أو تفعيل الخطة
      // window.location.href = 'checkout.html';
    });

    button.addEventListener('mousedown', function () {
      this.style.transform = 'scale(0.98)';
    });

    button.addEventListener('mouseup', function () {
      this.style.transform = 'scale(1)';
    });

    button.addEventListener('mouseleave', function () {
      this.style.transform = 'scale(1)';
    });
  });
});

  const selectButtons = document.querySelectorAll('.select-button');

  selectButtons.forEach(button => {
    button.addEventListener('click', () => {
      const plan = button.getAttribute('data-plan');
      const price = button.getAttribute('data-price');

      // نخزنهم في localStorage
      localStorage.setItem('selectedPlan', plan);
      localStorage.setItem('selectedPrice', price);

      // نروح لصفحة الدفع
      window.location.href = 'confirmation.html'; // بدلي الاسم حسب صفحتك
    });
  });


