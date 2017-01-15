
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Send mail</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../Resource/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../Resource/bootstrap/js/bootstrap.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

<div class="container">
    <h2>Send Mail</h2>
    <form name="form" action="fullmail.php" method="post" onsubmit="return validateForm()">
        <div class="form-group">


            <script type="text/javascript">

                function validateForm()
                {

                    b = document.getElementById("email").value;

                    if (b==null || b=="" )
                    {
                        alert("Please Fill Email  Field");
                        return false;
                    }
                }
            </script>



            <label>Enter Email:</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Enter email">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    </div>
</div>


</body>
</html>