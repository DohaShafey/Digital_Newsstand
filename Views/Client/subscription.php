<?php require_once '../assets/include/header.php'; ?>


  <main class="plans-container">
    <h2 class="plans-title">Choose Your Subscription Plan</h2>
    <div class="plans">
      <div class="plan-card basic">
        <h3>Basic</h3>
        <p class="price">$9<span>/mo</span></p>
        <ul class="features">
          <li>✔ Access to basic content</li>
          <li>✔ 5GB Storage</li>
          <li>✔ Email Support</li>
        </ul>
        <button class="select-button" data-plan="Basic" data-price="$9/mo">Choose Basic</button>
      </div>
      <div class="plan-card standard">
        <h3>Standard</h3>
        <p class="price">$19<span>/mo</span></p>
        <ul class="features">
          <li>✔ Everything in Basic</li>
          <li>✔ 50GB Storage</li>
          <li>✔ Priority Support</li>
        </ul>
        <button class="select-button" data-plan="Standard" data-price="$19/mo">Choose Standard</button>
      </div>
      <div class="plan-card premium">
        <h3>Premium</h3>
        <p class="price">$29<span>/mo</span></p>
        <ul class="features">
          <li>✔ Everything in Standard</li>
          <li>✔ 200GB Storage</li>
          <li>✔ 1-on-1 Coaching</li>
        </ul>
        <button class="select-button" data-plan="Premium" data-price="$29/mo">Choose Premium</button>
      </div>
    </div>
  </main>

<?php require_once '../assets/include/footer.php'; ?>

