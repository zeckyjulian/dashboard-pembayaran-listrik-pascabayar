<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
     <link href="/Assets/css/bootstrap.min.css" rel="stylesheet">
     <link href="/Assets/css/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-form {
            padding: 2.5rem;
            border-radius: 0.75rem;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="col-md-6 col-lg-6">
            <div class="login-form">
                <h2 class="text-center mb-2">Silahkan Login</h2>
                <h3 class="text-center mb-4">Pembayaran Listrik Pascabayar</h3>
                <form role="form" action="<?= base_url('admin/autentikasi-admin'); ?>" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">**Username**</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">**Kata Sandi**</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi Anda" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Masuk</button>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#">Lupa kata sandi?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/Assets/js/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <?php if (session()->getFlashdata('success')) : ?>
	<script type="text/javascript">
		$(document).ready(function() {
			swal("Success!", "<?php echo $_SESSION['success'] ?>", "success");
		});
	</script>
	<?php endif; ?>
	<?php if (session()->getFlashdata('error')) : ?>
		<script type="text/javascript">
			$(document).ready(function() {
				swal("Sorry!", "<?php echo $_SESSION['error'] ?>", "error");
			});
		</script>
	<?php endif; ?>
	<?php if (session()->getFlashdata('warning')) : ?>
		<script type="text/javascript">
			$(document).ready(function() {
				swal("Warning!", "<?php echo $_SESSION['warning'] ?>", "warning");
			});
		</script>
	<?php endif; ?>
	<?php if (session()->getFlashdata('info')) : ?>
		<script type="text/javascript">
			$(document).ready(function() {
				swal("Info!", "<?php echo $_SESSION['info'] ?>", "info");
			});
		</script>
	<?php endif; ?>
</body>
</html>