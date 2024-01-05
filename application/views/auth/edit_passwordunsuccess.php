<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign up / Successfully - Workshop For Beginners</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <script>
        alert('Your old password is the same as your new password');
    </script>

    <div class="container">
        <div class="row text-center mt-2">
            <div class="col">
                <div class="p-5">
                    <i class="bi-check-circle" style="font-size: 6rem; color: #0d6efd"></i>
                </div>
                <h2 class="" style="color: red;">Edit Password Unsuccessfully!</h2>
                <p>
                    Please click to return to the main page.
                </p>
                <div class="text-center m-5">
                    <a href="<?php echo base_url('edit_password') ?>" class="btn btn-danger btn-lg">Back to Edit</a>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>