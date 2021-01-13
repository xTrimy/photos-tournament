<?php
class User 
{
    // Signup method to record the user data in the database 
    public static function signup()
    {
        if ( isset( $_POST['signup'] ) )
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];

            if (!DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email)))
            {
                if (strlen($name) >= 3 && strlen($name) <= 30)
                {
                    if (strlen($password) >= 8 && strlen($password) <= 60)
                    {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL))
                        {
                            if($password == $repassword)
                            {
                                DB::query('INSERT INTO users VALUES(\'\',:name,:email,:password)',
                                array(':name'=>$name,
                                        ':email'=>$email,
                                        ':password'=>password_hash($password, PASSWORD_BCRYPT)));
                                echo '<script>alert("Account Created, You can signin now")</script>';
                                echo '<script>window.location="signin.php"</script>';
                            }
                            else
                            {
                                echo '<script>alert("Password don\'n match  !")</script>';
                            }
                        }
                        else
                        {
                            echo '<script>alert("Invalid Email !")</script>';
                        }
                    }
                    else
                    {
                        echo '<script>alert("Password is too short !")</script>';
                    }
                }
                else
                {
                    echo '<script>alert(" Name is too short !")</script>';
                }
            }
            else
            {
                echo '<script>alert("Already Registerd!")</script>';
            }
        }
    }   

    // Signin method to compare user data and log him in 
    public static function signin()
    {
        if (isset($_POST['signin']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email)))
            {
                if (password_verify($password, DB::query('SELECT password FROM users WHERE email=:email', array(':email'=>$email))[0]['password']))
                {
                    echo '<script>alert("Logged In")</script>';
                    echo '<script>window.location="index.php"</script>';
                    $cstrong = True;
                    $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                    $user_id = DB::query('SELECT id FROM users WHERE email=:email', array(':email'=>$email))[0]['id'];

                    DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));

                    setcookie("usr", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                    setcookie("usr_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                }
                else 
                {
                        echo '<script>alert("Password is wrong")</script>';
                        echo '<script>window.location="signin.php"</script>';
                }
            } 
            else 
            {
                    echo '<script>alert( Unregisterd Email !")</script>';
                    echo '<script>window.location="signin.php"</script>';
            }
        }
    }
}
?>