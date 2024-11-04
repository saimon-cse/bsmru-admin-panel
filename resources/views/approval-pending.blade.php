<!-- resources/views/approval-pending.blade.php -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pending</title>
    @include('admin.partials.header')
</head>
<body>

<br><br><br>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> </div>
                    <div class="card-body">
                        <p>Your profile is currently pending approval by an administrator. Please contact the ICT cell for further assistance.
<br><br>
                            Thank you!</p>
                    </div>
                </div>
                <a href="/"> Back to home</a>
            </div>
        </div>
    </div>




    @include('admin.partials.footerFile')
</body>
</html>

