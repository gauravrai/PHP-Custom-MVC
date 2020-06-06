<?php include(__DIR__ . '/../partials/header.php');?>



    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Welcome {{input.username}} </h1>
            <div class="account-wall">

<table class="table table-bordered">
	<tr>
		<td>USER ID</td>
		<td>{{input.id}}</td>
	</tr>
	<tr>
		<td>Username</td>
		<td>{{input.username}}</td>
	</tr>
	<tr>
		<td>Email</td>
		<td>{{input.email}}</td>
	</tr>
	<tr>
		<td>Password</td>
		<td>{{input.password}}</td>
	</tr>
	<tr>
		<td>Contact</td>
		<td>{{input.contact}}</td>
	</tr>
	<tr>
		<td colspan="2" class="text-center">
			<a href="/user/logout" class="btn btn-danger">Logout</a>
			<input type="hidden" value="<?php echo $_SESSION['userLoggedIn'];?>" id="userId" >
		</td>
	</tr>
</table>


</div>
        </div>
    </div>
</div>
<?php include(__DIR__ . '/../partials/footer.php');?>

<script type="text/javascript">
	
</script>
</body>
</html>
