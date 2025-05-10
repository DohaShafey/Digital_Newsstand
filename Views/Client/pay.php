<?php require_once '../assets/include/header.php'; ?>


    <!-- pay card -->

    <div class="checkout-panel">


        <div class="summary">
            <!-- <h3>Selected Plan:</h3>
            <p id="selected-plan">No plan selected</p> -->
          </div>
          

        <div class="panel-body">
          <h2 class="title">Checkout here!</h2>
       
          <div class="progress-bar">
            <div class="step active"></div>
            <div class="step active"></div>
            <div class="step"></div>
            <div class="step"></div>
          </div>
       
          <div class="payment-method">
            <label for="card" class="method card">
              <div class="card-logos">
                <img src="https://designmodo.com/demo/checkout-panel/img/visa_logo.png"/>
                <img src="https://designmodo.com/demo/checkout-panel/img/mastercard_logo.png"/>
              </div>
       
              <div class="radio-input">
                <input id="card" type="radio" name="payment">
                Pay with credit card
              </div>
            </label>
       
            <label for="paypal" class="method paypal">
              <img src="https://designmodo.com/demo/checkout-panel/img/paypal_logo.png"/>
              <div class="radio-input">
                <input id="paypal" type="radio" name="payment">
                Pay with PayPal
              </div>
            </label>
          </div>
       
          <div class="input-fields">
            <div class="column-1">
              <label for="cardholder">Cardholder Name</label>
              <input type="text" id="cardholder" />
       
              <div class="small-inputs">
                <div>
                  <label for="date">Valid date</label>
                  <input type="text" id="date"/>
                </div>
       
                <div>
                  <label for="verification">CVV / CVC *</label>
                  <input type="password" id="verification"/>
                </div>
              </div>
       
            </div>
            <div class="column-2">
              <label for="cardnumber">Card Number</label>
              <input type="password" id="cardnumber"/>
       
              <span class="info">* CVV or CVC is the card security code, unique three digits number on the back of your card separate from its number.</span>
            </div>
          </div>
        </div>
       
        <div class="panel-footer">
          <a href="confirmation.css"> <button class="btn back-btn">Back</button> </a>
          <a href="finish.php" ><button class="btn next-btn">Next Step</button> </a>
        </div>
      </div>
      
      


<?php require_once '../assets/include/footer.php'; ?>
