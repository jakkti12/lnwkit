<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Settings > Profile - Workshop For Beginners</title>
  <link rel="stylesheet" href="../assets/css/custom.css" />
  <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css" />
</head>

<body>
  <!-- start: navigation -->
  <main>
    <div class="container">
      <!-- start: breadcrumb -->
      <div class="page-header mt-3">
        <div class="row align-items-end">
          <div class="col-sm mb-2 mb-sm-0">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-no-gutter">
                <li class="breadcrumb-item">
                  <a class="breadcrumb-link" href="/ui/1.1.homepage.html">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Settings
                </li>
              </ol>
            </nav>
            <h1 class="page-header-title">Basic information</h1>
          </div>
          <div class="col-sm-auto">
            <a class="btn btn-primary" href="/ui/3.1.profile.html">
              <i class="bi-person-fill me-1"></i> My profile
            </a>
          </div>
        </div>
      </div>
      <!-- end: breadcrumb -->

      <div class="row">
        <!-- start: left menu -->
        <div class="col-lg-3">
          <div class="card mb-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="/ui/3.2.settings-profile.html">
                  <i class="bi-person"></i> Basic information
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/ui/3.3.settings-password.html">
                  <i class="bi-key"></i> Password
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/ui/3.4.settings-recentdevices.html">
                  <i class="bi-phone"></i> Recent devices
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!-- end: left menu -->

        <!-- start: main content -->
        <div class="col-lg-9">
          <div class="card mb-5">
            <div class="card-header">
              <h2 class="card-title h4">Basic information</h2>
            </div>

            <form action="edit_profile" method="post">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-xs-12 col-sm-6">
                    <label for="inputFirstname" class="form-label">Firstname</label>
                    <input type="text" name="firstname" class="form-control" id="inputFirstname" aria-describedby="emailHelp" value="<?php echo $row['fristname']; ?>" />
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <label for="inputLastname" class="form-label">Surename</label>
                    <input type="text" name="lastname" class="form-control" id="inputLastname" value="<?php echo $lastname ?>" />
                  </div>
                </div>
                <div class="mb-3">
                  <label for="inputEmail" class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" value="<?php echo $email ?>" />
                </div>

                <button type="submit" class="btn btn-danger w-30 mt-3 " style="margin-left: 650px;">
                  SAVE CHANG
                </button>
              </div>
            </form>

          </div>
        </div>
        <!-- end: main content -->
      </div>
    </div>
  </main>
  <script src="../assets/js/custom.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>