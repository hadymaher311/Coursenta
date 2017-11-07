
<link rel="stylesheet" href="{{ asset('/css/sidebar.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/sidebar.css') }}">

<div class="ui sidebar inverted vertical menu right uncover bg-purple" style=" color: #fff;">

  <h2 class="brand"><strong>Coursenta</strong></h2>

  <div id="accordion" role="tablist">


      <div class="card bg-purple">
          <div class="card-header" role="tab" id="headingThree" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <h5 class="mb-0">
                  <span>Projects</span>
                  <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
              </h5>
          </div>
          <div id="collapseThree" class="collapse<?php if(isset($project)) {echo 'show';} ?>" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                  <div class="list-group">
                      <a href="../projects/Magazine.php" class="list-group-item list-group-item-purple <?php if(isset($project)) { if($project == 'magazine') {echo 'active';} } ?>">Magazine</a>
                      <a href="../projects/Events.php" class="list-group-item list-group-item-action list-group-item-purple <?php if(isset($project)) { if($project == 'events') {echo 'active';} } ?>">Events</a>
                      <a href="../projects/Academic.php" class="list-group-item list-group-item-action list-group-item-purple <?php if(isset($project)) { if($project == 'academic') {echo 'active';} } ?>">Academic</a>
                      <a href="../projects/Juniors.php" class="list-group-item list-group-item-action list-group-item-purple <?php if(isset($project)) { if($project == 'juniors') {echo 'active';} } ?>">Juniors</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="card bg-purple">
          <div class="card-header collapsed" role="tab" id="headingTwo" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <h5 class="mb-0">
                  <span>
                      Magazine
                  </span>
                  <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
              </h5>
          </div>
          <div id="collapseTwo" class="collapse<?php if(isset($magazine)) {echo 'show';} ?>" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                  <div class="list-group">
                      <a href="../magazine/sept_maga.php" class="list-group-item list-group-item-purple <?php if(isset($magazine)) { if($magazine == 'sept') {echo 'active';} } ?>">September</a>

                      <a href="../oct_magazine/oct_maga.php" class="list-group-item list-group-item-purple <?php if(isset($magazine)) { if($magazine == 'oct') {echo 'active';} } ?>">October</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="card bg-purple">
          <div class="card-header collapsed" role="tab" id="headingFour">
              <h5 class="mb-0">
                  <span>
                      <a href="../events/events.php" style="color: inherit; text-decoration: none;">Events</a>
                  </span>
              </h5>
          </div>
      </div>

      <div class="card bg-purple">
          <div class="card-header collapsed" role="tab" id="headingOne">
              <h5 class="mb-0">
                  <span>
                      <a href="../about/about.php" style="color: inherit; text-decoration: none;">About Us</a>
                  </span>
              </h5>
          </div>
      </div>

      <div class="card bg-purple">
          <div class="card-header collapsed" role="tab" id="headingFive">
              <h5 class="mb-0">
                  <span>
                      <a href="../PuzzleGame/puzzlee.php" style="color: inherit; text-decoration: none;">Puzzle Game</a>
                  </span>
              </h5>
          </div>
      </div>

  </div>
</div>
{{-- </div> --}}
