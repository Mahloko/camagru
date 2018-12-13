<?php 
    require_once 'config/config.php';
    if ( !Session::isLoggedIn() )
        Router::redirect( 'index.php' );
    require('header.php');
?>
        <div>
            <form method="post" action="<?php echo htmlspecialchars( $_SERVER[ 'PHP_SELF' ] ); ?>">
                <div>
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div>
                    <input type="text" name="fname" placeholder="FirstName" >
                </div>
                <div>
                    <input type="text" name="lname" placeholder="LastName" >
                </div>
                <div>
                    <input type="text" name="username" placeholder="Username" >
                </div>
                <div>
                <?php
                    echo '<label> notifications </label>';
                    $res =  $user->getUserNotifications( htmlentities( $_SESSION[ 'username' ] ) );
                    if ( $res ) 
                        echo '<input type="checkbox" name="Notifications" checked>';
                    else echo '<input type="checkbox" name="Notifications">';
                ?>
                </div>
                <div>
                    <input type="password" placeholder="New Password" name="new_pass" >
                </div>
                <div>
                    <input type="password" placeholder="Password" name="password"  required>
                </div>
                <div>
                    <input type="submit" name="updateProfile" value="Update Field(s)"><br />
                </div>
            </form>
        </div>
<?php
        if ( $_SERVER[ 'REQUEST_METHOD'] == 'POST' )
            if ( isset( $_POST[ 'updateProfile' ] ) )
                if ( htmlentities( $_POST[ 'updateProfile' ] ) == 'Update Field(s)' ) {
                    $notifications = 1;
                    if ( !isset( $_POST[ 'Notifications' ] ) ) $notifications = 0;
                    $user->updateProfile( $_SESSION[ 'username' ], htmlentities( $_POST[ 'password' ] ), 'notifications', $notifications );
                    if ( !empty( $_POST[ 'username' ] ) ) $user->updateProfile( $_SESSION[ 'username' ], Input::get( 'password' ), 'username', Input::get( 'username' ) );
                    if ( !empty( $_POST[ 'email' ] ) ) $user->updateProfile( $_SESSION[ 'username' ], Input::get( 'password' ), 'email', Input::get( 'email' ) );
                    if ( !empty( $_POST[ 'fname' ] ) ) $user->updateProfile( $_SESSION[ 'username' ], Input::get( 'password' ), 'fname', Input::get( 'fname' ) );
                    if ( !empty( $_POST[ 'lname' ] ) ) $user->updateProfile( $_SESSION[ 'username' ], Input::get( 'password' ), 'lname', Input::get( 'lname' ) );
                    if ( !empty( $_POST[ 'new_pass' ] ) ) $user->updateProfile( $_SESSION[ 'username' ], Input::get( 'password' ), 'password', Input::get( 'new_pass' ) );
                    if ( $user->errMsg )
                        echo '<p style="color:red;">' . $user->errMsg . '</p>';
           }
?>
<?php require('footer.php');?>
<!-- "<script>alert('somethext');window.location.href='link';</script>" -->