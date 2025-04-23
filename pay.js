// الكود بايظ وبيعدي الصفحه من غير ما يتاكد انها اتملت ولا اي حاجه

$(document).ready(function() {
    // تفعيل الكلاس الأزرق عند الضغط على .method
    $('.method').on('click', function() {
      $('.method').removeClass('blue-border');
      $(this).addClass('blue-border');
    });
  
    // تحديد الحقول اللي بنحتاج نتأكد منها
    var $cardInput = $('.input-fields input');
  
    // عند الضغط على زر "Next"
    $('.next-btn').on('click', function(e) {
      // إزالة التحذير السابق
      $cardInput.removeClass('warning');
  
      // متغير لحفظ حالة التحقق
      var isValid = true;
  
      // التحقق من كل حقل إذا كان فارغ أو مش صحيح
      $cardInput.each(function() {
        var $this = $(this);
  
        // التحقق إذا كان الحقل فارغ
        if (!$this.val()) {
          $this.addClass('warning');  // إضافة كلاس التحذير
          isValid = false;
        }
      });
  
      // التحقق من صحة البيانات المدخلة باستخدام regular expressions
      var cardholderName = $('#cardholder').val().trim();
      var cardNumber = $('#cardnumber').val().trim();
      var validDate = $('#date').val().trim();
      var cvv = $('#verification').val().trim();
  
      // التعبيرات المنتظمة للتحقق من البيانات المدخلة
      const nameRegex = /^[A-Za-z\s]+$/; // الاسم فقط حروف ومسافات
      const cardNumberRegex = /^[0-9]{16}$/; // الرقم 16 رقم
      const dateRegex = /^(0[1-9]|1[0-2])\/\d{2}$/; // التاريخ يكون MM/YY
      const cvvRegex = /^[0-9]{3,4}$/; // CVV يكون 3 أو 4 أرقام
  
      // التحقق من الاسم
      if (!nameRegex.test(cardholderName)) {
        $('#cardholder').addClass('warning');
        isValid = false;
      }
  
      // التحقق من الرقم
      if (!cardNumberRegex.test(cardNumber)) {
        $('#cardnumber').addClass('warning');
        isValid = false;
      }
  
      // التحقق من التاريخ
      if (!dateRegex.test(validDate)) {
        $('#date').addClass('warning');
        isValid = false;
      }
  
      // التحقق من CVV
      if (!cvvRegex.test(cvv)) {
        $('#verification').addClass('warning');
        isValid = false;
      }
  
      // إذا الحقول مش صحيحة، منع الانتقال للصفحة التالية
      if (!isValid) {
        e.preventDefault(); // منع الزر من متابعة (الانتقال للصفحة التانية)
        alert('يرجى تعبئة جميع الحقول بشكل صحيح.');
      } else {
        // لو كل شيء تمام، اكمل
        alert('تم التحقق من البيانات، الانتقال للخطوة التالية.');
      }
    });
  });
  