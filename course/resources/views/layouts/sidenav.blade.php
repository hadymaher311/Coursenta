
<link rel="stylesheet" href="{{ asset('/css/sidebar.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/sidebar.css') }}">

<div class="ui sidebar inverted vertical menu right uncover bg-purple" style=" color: #fff;">

  <h2 class="brand"><strong>Coursenta</strong></h2>

  <div id="accordion" role="tablist">

      <div class="card bg-purple">
          <div class="card-header" role="tab" id="headingTen" data-toggle="collapse" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
              <h5 class="mb-0">
                  <span>Profile</span>
                  <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
              </h5>
          </div>
          <div id="collapseTen" class="collapse<?php if(isset($project)) {echo 'show';} ?>" role="tabpanel" aria-labelledby="headingTen" data-parent="#accordion">
              <div class="card-body">
                  <div class="list-group">
                      <a href="{{ url('home') }}" class="list-group-item list-group-item-action list-group-item-purple">My Profile</a>
                      <a href="#" class="list-group-item list-group-item-action list-group-item-purple">Edit Profile</a>
                      <a href="{{ route('logout') }}"  class="list-group-item list-group-item-action list-group-item-purple"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          Logout
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </div>
              </div>
          </div>
      </div>


      <div class="card bg-purple">
          <div class="card-header" role="tab" id="headingThree" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <h5 class="mb-0">
                  <span>Courses</span>
                  <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
              </h5>
          </div>
          <div id="collapseThree" class="collapse<?php if(isset($project)) {echo 'show';} ?>" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                  <div class="list-group">
                      <a href="#" class="list-group-item list-group-item-action list-group-item-purple">Course 1</a>
                      <a href="#" class="list-group-item list-group-item-action list-group-item-purple">Course 2</a>
                      <a href="#" class="list-group-item list-group-item-action list-group-item-purple">Course 3</a>
                      <a href="#" class="list-group-item list-group-item-action list-group-item-purple">Course 4</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="card bg-purple">
          <div class="card-header collapsed" role="tab" id="headingTwo" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <h5 class="mb-0">
                  <span>Professors</span>
                  <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
              </h5>
          </div>
          <div id="collapseTwo" class="collapse<?php if(isset($magazine)) {echo 'show';} ?>" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                  <div class="list-group">
                      <a href="#" class="list-group-item list-group-item-action list-group-item-purple">John Deo</a>

                      <a href="#" class="list-group-item list-group-item-action list-group-item-purple">Will Smith</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="card bg-purple">
          <div class="card-header collapsed" role="tab" id="headingFour">
              <h5 class="mb-0">
                  <span>
                      <a href="#" style="color: inherit; text-decoration: none;">Events</a>
                  </span>
              </h5>
          </div>
      </div>

      <div class="card bg-purple">
          <div class="card-header collapsed" role="tab" id="headingOne">
              <h5 class="mb-0">
                  <span>
                      <a href="#" style="color: inherit; text-decoration: none;">About Us</a>
                  </span>
              </h5>
          </div>
      </div>

  </div>
</div>
{{-- </div> --}}
