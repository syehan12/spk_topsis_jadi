<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Montserrat:wght@500&family=PT+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style1.css" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
    .navbar-nav .nav-item .nav-link {
      font-size: 14px;
    }
    .navbar-nav .nav-item .dropdown-menu {
      background-color: #ffffff;
      color: #ffffff
    }
    .navbar-nav .nav-item .dropdown-menu .dropdown-item {
      color: #000000
    }
    .navbar-nav .nav-item .dropdown-menu .dropdown-item:hover {
      background-color: #d4d4d4
    }
  </style>
  
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- <a class="navbar-brand" href="#">Navbar</a> -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="kriteria.php">Kriteria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="alternatif.php">Alternatif</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="bobot_kriteria.php">Perbandingan Kriteria</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Perbandingan Alternatif
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <?php
              if (getJumlahKriteria() > 0) {
                for ($i = 0; $i <= (getJumlahKriteria() - 1); $i++) {
                  echo "<a class='dropdown-item' href='bobot.php?c=" . ($i + 1) . "'>" . getKriteriaNama($i) . "</a>";
                }
              }
            ?>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="hasil.php">Ranking</a>
        </li>
      </ul>
    </div>
  </nav>
</body>
</html>
