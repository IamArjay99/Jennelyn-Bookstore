<?php
	include 'connect.php';
	$msg = $alert = '';

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	if (isset($_POST['submit'])) {

		$book_title = mysqli_real_escape_string($conn, $_POST['update_title']);
		$book_author = mysqli_real_escape_string($conn, $_POST['update_author']);
		$book_description = mysqli_real_escape_string($conn, $_POST['update_description']);
		$book_subject = mysqli_real_escape_string($conn, $_POST['update_subject']);
		$book_isbn = mysqli_real_escape_string($conn, $_POST['update_isbn']);
		$book_price = mysqli_real_escape_string($conn, $_POST['update_price']);
		$book_stocks = mysqli_real_escape_string($conn, $_POST['update_stocks']);
		$book_copyright = mysqli_real_escape_string($conn, $_POST['update_copyright']);
		$book_publisher = mysqli_real_escape_string($conn, $_POST['update_publisher']);

		$fileName = $_FILES['update_cover']['name'];
		$fileTmpName = $_FILES['update_cover']['tmp_name'];
		$fileSize = $_FILES['update_cover']['size'];
		$fileError = $_FILES['update_cover']['error'];
		$fileType = $_FILES['update_cover']['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg', 'jpeg', 'png'); 

		if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 1000000) {
					$book_image = uniqid('', true) . "." . $fileActualExt;
					$fileDestination = '../../images/' . $book_image;
					move_uploaded_file($fileTmpName, $fileDestination);

					$sql = "UPDATE book_info SET book_title='$book_title', book_isbn='$book_isbn', book_author='$book_author', book_description='$book_description', book_subject='$book_subject', book_price='$book_price', book_stocks='$book_stocks', book_cover='$book_image', book_copyright='$book_copyright', book_publisher='$book_publisher' WHERE id = '$id' AND book_copyright='$book_copyright'";
					mysqli_query($conn, $sql);
					
					$msg = "";
					$alert = "<div class='alert alert-success' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						</button>
						<strong class='text-center'>Update Successfully</strong>
					</div>";
					header("Location: view.php?id=$id&book_copyright=$book_copyright");
				}
				else {
					$msg = "Your file is too big";
					$alert = '';
				}
			}
			else {
				$msg = "There was an error uploading your file";
				$alert = '';
			}
		}
		else {
			$msg = "You can't upload files of this type";
			$alert = '';
		}
	}
	}

	if (isset($_GET['save_changes'])) {
		$sql = "UPDATE book_info SET book_title='$book_title', book_author='$book_author', book_description='$book_description', book_subject='$book_subject', book_price='$book_price', book_stocks='$book_stocks', book_cover='$book_image', book_copyright='$book_copyright', book_publisher='$book_publisher' WHERE book_isbn = '$book_isbn' AND book_copyright='$book_copyright'";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			header("Location: books.php");
		}
	}

	if (isset($_POST['add_submit'])) {
		$book_title = mysqli_real_escape_string($conn, $_POST['update_title']);
		$book_author = mysqli_real_escape_string($conn, $_POST['update_author']);
		$book_description = mysqli_real_escape_string($conn, $_POST['update_description']);
		$book_subject = mysqli_real_escape_string($conn, $_POST['update_subject']);
		$book_isbn = mysqli_real_escape_string($conn, $_POST['update_isbn']);
		$book_price = mysqli_real_escape_string($conn, $_POST['update_price']);
		$book_stocks = mysqli_real_escape_string($conn, $_POST['update_stocks']);
		$book_copyright = mysqli_real_escape_string($conn, $_POST['update_copyright']);
		$book_publisher = mysqli_real_escape_string($conn, $_POST['update_publisher']);

		$fileName = $_FILES['update_cover']['name'];
		$fileTmpName = $_FILES['update_cover']['tmp_name'];
		$fileSize = $_FILES['update_cover']['size'];
		$fileError = $_FILES['update_cover']['error'];
		$fileType = $_FILES['update_cover']['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg', 'jpeg', 'png'); 

		if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 1000000) {
					$book_image = uniqid('', true) . "." . $fileActualExt;
					$fileDestination = '../../images/' . $book_image;
					move_uploaded_file($fileTmpName, $fileDestination);

					$sql = "INSERT INTO book_info (book_title, book_author, book_description, book_subject, book_price, book_stocks, book_cover, book_copyright, book_publisher, book_isbn)
					VALUES ('$book_title','$book_author', '$book_description', '$book_subject', '$book_price', '$book_stocks', '$book_image', '$book_copyright', '$book_publisher', '$book_isbn')";
					$result = mysqli_query($conn, $sql);
					
					if ($result) {
						$sel = "SELECT * FROM book_info WHERE book_isbn = '$book_isbn'";
						$qry = mysqli_query($conn, $sel);
						if (mysqli_num_rows($qry) > 0) {
							while ($rw = mysqli_fetch_array($qry)) {
								$book_id = $rw['id'];
								$ins = "INSERT INTO stocks SET bookid = '$book_id'";
								$if = mysqli_query($conn, $ins);
								if ($if) {
									header("Location: view.php?id=$book_id&book_copyright=$book_copyright");
								}
							}
						}
						
					}

				}
				else {
					$msg = "Your file is too big";
					$alert = '';
				}
			}
			else {
				$msg = "There was an error uploading your file";
				$alert = '';
			}
		}
		else {
			$msg = "You can't upload files of this type";
			$alert = '';
		}
	}

?>