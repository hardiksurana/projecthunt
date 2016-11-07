<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once('library/header.php'); ?>
        <title>ProjectHunt | Home</title>
        <!-- My Stylesheets -->
        <link rel="stylesheet" href="css/master.css" charset="utf-8">
    </head>

    <body>
        <!-- NAVBAR -->
        <nav class="navbar navbar-light">
          <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="homepage.php">
                      <img alt="ProductHunt Logo" src="images/logo.jpg">
                    </a>
                </div>
                <button class="navbar-toggler hidden-sm-up pull-xs-right" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
                &#9776;
              </button>
              <div class="collapse navbar-toggleable-xs pull-xs-right" id="navbar-content">
                <ul class="nav navbar-nav pull-sm-right">
                  <li class="nav-item">
                    <a class="nav-link" href="homepage.php">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="login.php">Dashboard</a>
                  </li>
                  <li class="nav-item">
                      <a href="login.php">
                        <button type="button" name="button" class="btn btn-info">Register/Log-In</button>
                      </a>
                  </li>
                </ul>
              </div>
          </div>
        </nav>
        <!-- NAVBAR ENDS HERE -->

        <!-- Section 1 -->
        <div class="section section1">
            <section class="container">
                <div class="section-content">
                    <h1>
                        Welcome to ProjectHunt!
                    </h1>
                    <hr class="customHR"/>
                    <p class="lead">
                        ProjectHunt is a platform where anyone can showcase their side-projects and get real-time feedback from other equally enthusiastic users.
                    </p>
                    <a href="login.php">
                        <button type="button" name="button" class="btn btn-lg btn-primary-outline">Get Started</button>
                    </a>
                </div>
            </section>
        </div>
        <!-- Section 1 ends here -->

        <!-- Section 2 -->
        <div class="section section2">
            <section class="container">
                <div class="section-content">
                    <h2>About</h2>
                    <hr class="customHR"/>
                    <p class="lead">
                      ProjectHunt is a platform where anyone can showcase their side-projects and get real-time feedback from other equally enthusiastic users. This can also be used as a virtual roadshow of the projects. Students in particular can use this as a platform for finding and sharing creative and innovative ideas and see the trending projects in their college. The projects can be anything : hardware, software or even a startup idea.
                    </p>
                </div>
            </section>
        </div>
        <!-- Section 2 ends here -->

        <!-- Section 3 -->
        <div class="section section3">
            <section class="container">
                    <h2>Features</h2>
                    <hr class="customHR"/>
                    <div class="container features">
                        <div class="row">
                            <div class="col-xs-12 col-md-4 feature-list">
                                <div class="container">
                                    <i class="fa fa-upload fa-5x" aria-hidden="true"></i>
                                    <p class="lead">Upload Project</p>
                                </div>
                            </div>
                            <div class="col-xs-12  col-md-4 feature-list">
                                <div class="container">
                                   <i class="fa fa-chevron-up fa-5x" aria-hidden="true"></i>
                                    <p class="lead">View Trending Projects</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4 feature-list">
                                <div class="container">
                                    <i class="fa fa-comment fa-5x" aria-hidden="true"></i>
                                    <p class="lead">Get Feedback</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
        <!-- Section 3 ends here -->

    </body>
</html>
