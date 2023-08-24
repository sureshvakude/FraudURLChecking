<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fraud Detection</title>
  <!-- Materialize CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <style>
    body {
      background-color: #f7f7f7;
      color: #333;
      font-family: Arial, sans-serif;
    }
    header {
      background-color: #37474f;
      color: #fff;
      padding: 10px;
    }
    h1 {
      font-size: 36px;
      margin: 0;
    }
    h2 {
      font-size: 28px;
      margin: 20px 0 10px 0;
    }
    p {
      font-size: 16px;
      margin: 10px 0;
    }
    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
    }
    img {
      max-width: 100%;
      margin: 20px 0;
    }
    .card {
      padding: 20px;
      margin: 20px 0;
    }
  </style>
</head>
<body>
  <header>
    <nav>
      <div class="nav-wrapper">
        <a href="#" class="brand-logo">Fraud URL Detection</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="mega.html">Home</a></li>
          <li><a href="sample.html">Check url</a></li>
          <li><a href="urls_checked.php">URLs list</a></li>
          <li><a href="#">About</a></li>
        </ul>
      </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
      <li><a href="home.php">Home</a></li>
      <li class="active"><a href="urls_checked.php">Checked URLs</a></li>
      <li><a href="#">About</a></li>
    </ul>
  </header>
  
  <main>
    <div class="container">
      <h1>Checked URLs</h1>
      <table>
        <thead>
          <tr>
            <th>URL</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Connect to the database
          $conn = mysqli_connect('localhost', 'root', '', 'fraud_url_db');

          // Check connection
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }

          // Select all URLs from the fraud_urls1 table
          $sql = "SELECT url FROM fraud_urls1";
          $result = mysqli_query($conn, $sql);

          // Check if any URLs were returned
          if (mysqli_num_rows($result) > 0) {
            // Output each URL as a table row
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr><td>" . $row['url'] . "</td></tr>";
            }
          } else {
            echo "<tr><td>No URLs found</td></tr>";
          }

          // Close the database connection
          mysqli_close($conn);
          ?>
        </tbody>
      </table>
    </div>
  </main>
  
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Materialize JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  
  <script>
    $(document).ready(function(){
      $('.sidenav').sidenav();
    });
  </script>
</body>
</html>