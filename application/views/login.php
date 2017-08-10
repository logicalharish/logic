<!doctype html>
<html class="no-js" lang="en"> <!--<![endif]-->

    <head>
        <title>Invoice | Login</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width">
        <meta name="robots" content="NOINDEX,NOFOLLOW">

        <link rel="icon" type="image/png" href="assets/core/img/favicon.png">

        <link href="assets/invoiceplane/css/style.css" rel="stylesheet">
        <link href="assets/core/css/custom.css" rel="stylesheet">

    </head>

    <body>


        <br>

        <div class="container">

            <div id="login" class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

                <h1>Invoice Login</h1>

                <div class="row">



                </div>

                <form method="post" action="login/signup">



                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <input type="text" name="username" id="username" class="form-control"
                               placeholder="Username" required autofocus
                               value="">
                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                               placeholder="Password" required
                               value="">
                    </div>

                    <input type="hidden" name="btn_login" value="true">

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-unlock fa-margin"></i> Login            </button>


                </form>
            </div>
        </div>

    </body>
</html>
