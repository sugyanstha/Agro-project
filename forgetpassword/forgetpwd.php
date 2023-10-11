<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>    
    <div class="log"> 
        <div class="container">
            <h1>Forgot Password</h1>        
            <form id="forgotPasswordForm" action="send_resetpwd.php" method="post">
                <div class="group-login" >
                    <label for="email">Email:</label>
                    <input type="email" placeholder="Enter your email" name="email" id="email" required>
                </div>    
                <div class="user-selects">
                    <div class="farmer-part">
                        <input type="radio" id="farmer" name="userselects" value="farmer" checked>
                        <label for="farmer">Farmer</label>
                    </div>
                    <div class="counsellor-part">
                        <input type="radio" id="counsellor" name="userselects" value="counsellor">
                        <label for="counsellor">Counsellor</label>
                    </div>
                </div>
                <div class="button-group">
                    <button type="submit" name="submit" value="submit">Submit</button>
                    <a href="../login.php" class="back-button">Back to Login</a>
                </div>
            </form>
        </div>
    </div>    
</body>
</html>

    