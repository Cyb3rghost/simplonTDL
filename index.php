<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ToDoList Simplon</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="icon" href="image/test.png" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="js/main.js"></script>
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
    <h2 class="text-center">ToDoList Simplon</h2>    
    <form action="" method="post">
           
        <div class="form-group">
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" id="btn_conn">Connexion</button>
        </div>
        <div id='div_message' style='text-align:center'></div>
        <div class="clearfix">
            
        </div>        
    </form>
</div>
</body>
</html> 