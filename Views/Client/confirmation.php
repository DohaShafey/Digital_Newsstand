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
            <div class="step"></div>
            <div class="step"></div>
            <div class="step"></div>
          </div>
       
          <div class="info">
            <div class="column-2">
                <label for="firs-name">Name</label>
                <input type="text" id="firs-name" />
            </div>
            <div class="column-2">
                <label for="last-name">Promocode</label>
                <input type="text" id="last-name"/>
            </div>
            <div class="column-2">
                <label for="email">Email</label>
                <input type="email" id="email"/>
            </div>
            <div class="column-2">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" />
            </div>
          </div>

          <div class="price">
            <div class="section">
                <h3>Basic subscription</h3>
                <!-- المروض كل كلمة من هنا تتشال والي يتحط يبقى الداتا بتاعت اليوزر -->
                <div class="row"><span>Price</span><span class="action">4$</span></div>
                <div class="row"><span>Duration</span><span class="action">1 week</span></div>
                <!-- <div class="row"><span>Password</span><span class="action">Update</span></div> -->
              </div>
          </div>
       
          
        </div>
       
        <div class="panel-footer">
          <a href="subscription.html"> <button class="btn back-btn">Back</button> </a>
          <a href="pay.php"> <button class="btn next-btn">Next Step</button> </a>
        </div>
      </div>
      
      


<?php require_once '../assets/include/footer.php'; ?>
