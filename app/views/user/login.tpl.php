<!-- <section class="vh-100" style="background-color: #9A616D;"> -->
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://benoclock.github.io/S06-images/produits/25-100dales.jpg"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6  d-flex align-items-center">
              <div class="card-body ">

                <form action="<?= $router->generate("user-login-post") ?>" method="POST" class="mt-1 ms-5">

                  <div class="d-flex align-items-center pb-1">
                    <span class="h1 fw-bold mb-0">oShop</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-outline mb-4">
                      <!-- <label class="form-label" for="form2Example17">Email address</label> -->
                    <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control" 
                    placeholder="Email address" />
                  </div>

                  <div class="form-outline mb-4">
                    <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control" 
                    placeholder="Password"/>
                    <!-- <label class="form-label" for="form2Example27">Password</label> -->
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-primary btn-block px-5" type="submit">Login</button>
                  </div>

                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-0 mt-3 text-muted">Don't have an account? <a href="<?= $router->generate("user-add")?>" class="text-muted">Register here</a></p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>