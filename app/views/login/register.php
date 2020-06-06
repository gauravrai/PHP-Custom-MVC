<?php include(__DIR__ . '/../partials/header.php');?>



    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Register to continue</h1>
            <div class="account-wall">
                <div class="alert alert-info" v-show="html.showMessage" style="display: none" id="">{{html.message}}</div>
                <form class="form-signin" method="post">
                    <input type="text" v-model="input.username" class="form-control" placeholder="Username" required autofocus>
                    <br>
                    <input v-model="input.email" class="form-control" placeholder="Email" required type="email" >
                    <br>
                    <input type="password" v-model="input.password" class="form-control" placeholder="Password" required>
                    <br>
                    <input type="text" v-model="input.contact" class="form-control" placeholder="Contact" required>
                    <br>
                    <button v-on:click="register" class="btn btn-lg btn-primary btn-block" type="button">
                        Click to Register</button>
                </form>
            </div>
            <p class="text-center">
                or
                <br>
                <a href="/user/" class="text-center new-account">Login </a>
            </p>
        </div>
    </div>
<?php include(__DIR__ . '/../partials/footer.php');?>

<script type="text/javascript">
	
</script>
</body>
</html>
