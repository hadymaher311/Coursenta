  @extends('layouts.layout')
  @section('title')
    Coursenta
  @endsection

  @section('head')
    <link rel="stylesheet" href="{{ asset('/user/css/home.css') }}">
  @endsection

  @section('body')

      <!-- Intro Section -->
      <div class="view hm-purple-slight" style="background-image: url('{{ asset('/images/gradient2.png') }}'); background-size: cover; background-position: 50% 50%;">
        <div class="full-bg-img">
          <div class="container flex-center">
            <div class="row pt-5 mt-3">
              <div class="col-md-12 mb-3">
                <div class="text-center">
                    <ul>
                      <li>
                        <h1 class="display-4 font-bold mb-5 wow fadeInUp">Our New Course is Ready</h1></li>
                      <li>
                        <h5 class="mb-5">It comes with a lot of new features, easy to follow videos and images. Check it out now!</h5>
                      </li>
                      <li>
                        <a class="btn btn-purple btn-rounded" href="{{ route('register') }}"><i class="fa fa-user left"></i> Sign up!</a>
                        <a class="btn btn-outline-purple btn-rounded" href="{{ route('login') }}"><i class="fa fa-book left"></i> Login</a>
                      </li>
                    </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </header>
    <!--Main Navigation-->



    <!--Section: Features v.1-->
    <section class="container text-center">

        <!--Section heading-->
        <h1 class="section-heading pt-4">Why is it so great?</h1>
        <!--Section description-->
        <p class="section-description lead grey-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>

        <!--Grid row-->
        <div class="row features-big">

            <!--Grid column-->
            <div class="col-md-4 mb-r">
                <i class="fa fa-building-o fa-5x red-text"></i>
                <h5 class="feature-title">1000</h5>
                <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda deleniti hic.</p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-4 mb-r">
                <i class="fa fa-book fa-5x cyan-text"></i>
                <h5 class="feature-title">1000</h5>
                <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda deleniti hic.</p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-4 mb-r">
                <i class="fa fa-user fa-5x orange-text"></i>
                <h5 class="feature-title">1000</h5>
                <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda deleniti hic.</p>
            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

    </section>
    <!--Section: Features v.1-->


    <!--Projects section v.4-->
    <section class="section pb-3 container text-center">

      <!--Section heading-->
      <h2 class="section-heading h1 pt-4"><strong>Our best projects</strong></h2>
      <!--Section description-->
      <p class="section-description lead grey-text">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
          sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

      <!--Grid row-->
      <div class="row">

          <!--Grid column-->
          <div class="col-md-12 mb-r">
              <div class="card card-image" style="background-image: url({{ asset('/images/img3.jpg') }});">
                  <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
                      <div>
                          <h6 class="purple-text"><i class="fa fa-plane"></i><strong> Travel</strong></h6>
                          <h3 class="card-title py-3 font-bold"><strong>This is card title</strong></h3>
                          <p class="pb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat fugiat, laboriosam, voluptatem,
                              optio vero odio nam sit officia accusamus minus error nisi architecto nulla ipsum dignissimos.
                              Odit sed qui, dolorum!</p>
                          <a class="btn btn-secondary btn-rounded"><i class="fa fa-clone left"></i> View project</a>
                      </div>
                  </div>
              </div>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-6 mb-r">
              <div class="card card-image" style="background-image: url({{ asset('/images/img.jpg') }});">
                  <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
                      <div>
                          <h6 class="pink-text"><i class="fa fa-pie-chart"></i><strong> Marketing</strong></h6>
                          <h3 class="card-title py-3 font-bold"><strong>This is card title</strong></h3>
                          <p class="pb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat fugiat, laboriosam, voluptatem,
                              optio vero odio nam sit officia accusamus minus error nisi architecto nulla ipsum dignissimos.
                              Odit sed qui, dolorum!</p>
                          <a class="btn btn-pink btn-rounded"><i class="fa fa-clone left"></i> View project</a>
                      </div>
                  </div>
              </div>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-6 mb-r">
              <div class="card card-image" style="background-image: url({{ asset('/images/img3.jpg') }});">
                  <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
                      <div>
                          <h6 class="green-text"><i class="fa fa-eye"></i><strong> Entertainment</strong></h6>
                          <h3 class="card-title py-3 font-bold"><strong>This is card title</strong></h3>
                          <p class="pb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat fugiat, laboriosam, voluptatem,
                              optio vero odio nam sit officia accusamus minus error nisi architecto nulla ipsum dignissimos.
                              Odit sed qui, dolorum!</p>
                          <a class="btn btn-success btn-rounded"><i class="fa fa-clone left"></i> View project</a>
                      </div>
                  </div>
              </div>
          </div>
        </div>
          <!--Grid column-->

      <!--Grid row-->

    </section>
    <!--Projects section v.4-->


    <!--Section: Team v.1-->
    <section class="section team-section pb-5 container text-center">

        <!--Section heading-->
        <h2 class="section-heading h1 pt-4">Our amazing team</h2>
        <!--Section description-->
        <p class="section-description grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam eum porro a pariatur accusamus veniam.</p>

        <!--Grid row-->
        <div class="row text-center">

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-r">

                <div class="avatar">
                    <img src="{{ asset('/images/team1.jpg') }}" class="rounded-circle z-depth-1 img-fluid" alt="First sample avatar image">
                </div>
                <h4>Anna Deynah</h4>
                <h6 class="font-bold purple-text">Web Designer</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur.</p>

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-r">

                <div class="avatar">
                    <img src="{{ asset('/images/team2.jpg') }}" class="rounded-circle z-depth-1 img-fluid" alt="Second sample avatar image">
                </div>
                <h4>John Doe</h4>
                <h6 class="font-bold purple-text">Web Developer</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur.</p>

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-r">

                <div class="avatar">
                    <img src="{{ asset('/images/team3.jpg') }}" class="rounded-circle z-depth-1 img-fluid" alt="Third sample avatar image">
                </div>
                <h4>Maria Kate</h4>
                <h6 class="font-bold purple-text">Photographer</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur.</p>

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-r">

                <div class="avatar">
                    <img src="{{ asset('/images/team4.jpg') }}" class="rounded-circle z-depth-1 img-fluid" alt="Fourth sample avatar image">
                </div>
                <h4>Tom Williams</h4>
                <h6 class="font-bold purple-text">Front-end Developer</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur.</p>

              </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

    </section>
    <!--Section: Team v.1-->
    @endsection

    @section('footer')
      <script src="{{ asset('/user/js/home.js') }}"></script>
    @endsection
