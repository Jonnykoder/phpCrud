<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>PHP CRUD</title>
		<!-- CSS only -->
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
			crossorigin="anonymous"
		/>
		<link rel="stylesheet" href="./src/index.css" />
	</head>
	<body>
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand mx-2" href="index.php"
				>Student Registration form</a
			>
		</nav>
		<?php require_once 'process.php' ?>
		<?php 
    if(isset($_SESSION['message'])): ?>
		<div class="alert alert-<?=$_SESSION['msg_type']?>">
			<?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
		</div>
		<?php endif ?>
		<?php 
            $servername = "localhost";
            $username = "root";
            $password = "aA09107458420";
            $dbname = "crud";

            // Create connection
            $mysqli = new mysqli($servername, $username, $password , $dbname) or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM php_crud") or die($mysqli->error);
	
        ?>

		<div class="container">
			<section class="form_content_wrapper">
				<div class="row">
					<div class="col-md-5 left_container">
						<img class="img-wrapper" src="./images/form.svg" alt="" />
					</div>

					<div class="col-md-7">
						<div class="form-container p-3 mt-4">
							<form action="process.php" method="post">
								<input type="hidden" name="id" value="<?php echo $id; ?>" />
								<div class="form-group">
									<label for="fullname">Full name:</label>
									<input
										type="text"
										name="fullname"
										class="form-control"
										required
										placeholder="eg: Juan dela cruz"
										value="<?php echo $Fullname ?>"
									/>
								</div>
								<div class="form-group">
									<label for="course">Course</label>
									<input
										type="text"
										name="course"
										class="form-control"
										required
										placeholder="eg: BSIT"
										value="<?php echo $Course ?>"
									/>
								</div>
								<div class="form-group">
									<label for="year">year</label>
									<input
										type="text"
										name="year"
										id=""
										class="form-control"
										required
										placeholder="eg: 4rth year"
										value="<?php echo $Year ?>"
									/>
								</div>
								<div class="form-group">
									<label for="email">Email:</label>
									<input
										type="email"
										name="email"
										class="form-control"
										required
										placeholder="eg: juandelacruz@gmail.com"
										value="<?php echo $Email ?>"
									/>
								</div>
								<?php 
                        if($update == true):
                        ?>
								<button type="submit" name="update" class="btn-submit">
									Update
								</button>
								<?php 
                        else: ?>
								<button type="submit" name="submit" class="btn-submit">
									Submit
								</button>
								<?php endif; ?>
							</form>
						</div>
					</div>
				</div>
			</section>
			<hr />
			<div id="results">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Full name</th>
							<th scope="col">Course</th>
							<th scope="col">Year</th>
							<th scope="col">Email</th>
							<th scope="col">Actions:</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                    while ( $row = $result->fetch_assoc()): ?>
						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['fullname']; ?></td>
							<td><?php echo $row['course']; ?></td>
							<td><?php echo $row['year']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td>
								<a
									href="index.php?edit=<?php echo $row['id']; ?>"
									class="btn btn-outline-warning"
									>Edit</a
								>
								<a
									href="process.php?delete=<?php echo $row['id']; ?>"
									class="btn btn-danger"
									>Delete</a
								>
							</td>
						</tr>
						<?php endwhile;?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- JavaScript Bundle with Popper -->
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
			crossorigin="anonymous"
		></script>
	</body>
</html>
