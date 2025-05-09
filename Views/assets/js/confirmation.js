  document.querySelector('.next-btn').addEventListener('click', function (event) {
    const firstName = document.getElementById('firs-name').value.trim();
    const lastName = document.getElementById('last-name').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();

    const nameRegex = /^[A-Za-z]+$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneRegex = /^[0-9]{11}$/;

    let isValid = true;
    let errorMsg = "";

    if (!firstName || !nameRegex.test(firstName)) {
      isValid = false;
      errorMsg += "First name must contain letters only.\n";
    }

    if (!lastName || !nameRegex.test(lastName)) {
      isValid = false;
      errorMsg += "Last name must contain letters only.\n";
    }

    if (!email || !emailRegex.test(email)) {
      isValid = false;
      errorMsg += "Please enter a valid email address.\n";
    }

    if (!phone || !phoneRegex.test(phone)) {
      isValid = false;
      errorMsg += "Phone number must be exactly 11 digits.\n";
    }

    if (!isValid) {
      alert(errorMsg);
      event.preventDefault(); // تمنع الانتقال للصفحة التالية
    }
  });
