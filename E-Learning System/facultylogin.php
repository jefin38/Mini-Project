<?php include('allhead.php'); ?> 
 </nav>
<div class="container"><br><br>
	<div class="row">
		<div class="col-md-5">
			<fieldset>
				<!-- Faculty login page -->
				<legend>
					<h3 style="padding-top: 25px;"><span class="glyphicon glyphicon-lock"></span>&nbsp;  Faculty Login</h3>
				</legend>
				<form name="facultylogin" action="loginlinkfaculty" method="POST">
					<div class="control-group form-group">
						<div class="controls">
							<label>Faculty ID:</label>
							<input type="text" class="form-control" name="fid" required data-validation-required-message="Please enter your Faculty Id.">
							<p class="help-block"></p>
						</div>
					</div>
					<div class="control-group form-group">
						<div class="controls">
							<label>Passsword:</label>
							<input type="password" class="form-control" name="pass" required data-validation-required-message="Please enter your password.">
							<p class="help-block"></p>
						</div>
					</div>
					<center>
						<button type="submit" class="btn btn-primary">Login</button>
						<button type="reset" class="btn btn-primary" style="
    background-color: #E52727;
    border-color: #D21B1B;">Reset</button>
					</center>
			</fieldset>
			</form>
		</div>
	</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>