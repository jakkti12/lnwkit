<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>edit profile</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

    <!-- Form -->

    <div class="row mt-5 justify-content-center">
        <div class="col-md-8   col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title h4">Edit profile</h2>
                </div>
                <div class="card-body">

                    <form>
                        <div class="row mb-3">
                            <div class="col-xs-12 col-sm-6">
                                <label for="inputFirstname" class="form-label">Firstname</label>
                                <input type="text" class="form-control" id="inputFirstname" aria-describedby="emailHelp" />
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <label for="inputLastname" class="form-label">Surename</label>
                                <input type="text" class="form-control" id="inputLastname" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" />
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword" />
                        </div>

                        <button type="submit" class="btn btn-danger w-30 mt-3 " style="margin-left: 650px;">
                            SAVE CHANG
                        </button>
                    </form>
                    <hr />
                    <div class="text-center">
                        <a href="/" class="link-secondary">Go back to homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>