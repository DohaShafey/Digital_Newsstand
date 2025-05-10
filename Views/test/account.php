<?php require_once '../assets/include/header.php'; ?>


  <div class="container">
    <div class="sidebar">
    </div>

    <div class="content">
      <h2>Good evening.</h2>
      <p>You’ve supported independent journalism since 2025.</p>

      <div class="section">
        <h3>Account information</h3>
        <!-- المروض كل كلمة من هنا تتشال والي يتحط يبقى الداتا بتاعت اليوزر -->
        <div class="row"><span>Username</span><span class="action"></span></div>
        <div class="row"><span>Email address</span><span class="action"></span></div>
        <div class="row"><span>Password</span><span class="action">Update</span></div>
      </div>

      <div class="section">
        <h3>Your profile</h3>
        <div class="row"><span>Language</span>
            <span class="action">
                <select id="language" name="language" required>
                    <option value="" disabled selected>Select a language</option>
                    <option>English</option>
                    <option>Arabic</option>
                    <option>French</option>
                    <option>Spanish</option>
                    <option>German</option>
                    <option>Chinese</option>
                    <option>Japanese</option>
                    <option>Korean</option>
                    <option>Russian</option>
                    <option>Portuguese</option>
                    <option>Italian</option>
                    <option>Hindi</option>
                    <option>Turkish</option>
                    <option>Persian</option>
                    <option>Urdu</option>
                    <option>Dutch</option>
                </select>
            </span>
        </div>

        <div class="row"><span>Saved Articles</span><span class="action">View all</span></div>
    </div>

      <div class="section">
        <h3>Subscription</h3>
        <!-- نخليه يطلع بالجافا زي فورم يقوله هو مشترك ولا لا ولو اه ف باقة ايه و لو حابب انه يلغي -->
        <div class="row"><span>Manage subscription</span><span class="action"><a href="#" class="text-warning" data-bs-toggle="modal" data-bs-target="#manageModal">Manage</a></span></div>
        

        <!-- المودال -->
        <div class="modal fade" id="manageModal" tabindex="-1" aria-labelledby="manageModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="manageModalLabel">Manage Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                  </div>
                  <div class="mb-3">
                    <label for="plan" class="form-label">Subscription Plan</label>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--  الزرار ده لازم ياخد الدتا بجد و يوديها الداتابيز وياخدها تاني يعرضها في البروفايل -->
      <div class="row" id="save"><span> </span><span class="action">Save</span></div>
    </div>
  </div>


<?php require_once '../assets/include/footer.php'; ?>
