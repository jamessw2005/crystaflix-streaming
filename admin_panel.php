<?php
require_once("includes/config.php");
// require_once("includes/header.php");




try {
    // Create a PDO connection
    // $con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    // $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the count of users
    $stmt_users = $con->query("SELECT COUNT(*) AS user_count FROM users");
    $user_count = $stmt_users->fetch(PDO::FETCH_ASSOC)['user_count'];

    // Get the count of movies
    $stmt_movies = $con->query("SELECT COUNT(*) AS movie_count FROM videos WHERE isMovie = 1");
    $movie_count = $stmt_movies->fetch(PDO::FETCH_ASSOC)['movie_count'];

    // Get the count of TV shows
    $stmt_tv_shows = $con->query("SELECT COUNT(*) AS tv_show_count FROM entities WHERE id IN (SELECT entityId FROM videos WHERE isMovie = 0); ");
    $tv_show_count = $stmt_tv_shows->fetch(PDO::FETCH_ASSOC)['tv_show_count'];

    // Get the count of subscriptions
    $stmt_subscriptions = $con->query("SELECT COUNT(*) AS subscription_count FROM users WHERE isSubscribed = 1");
    $subscription_count = $stmt_subscriptions->fetch(PDO::FETCH_ASSOC)['subscription_count'];

    $views = $con->query("SELECT COUNT(views) AS viewCount FROM videos ");
    $total_views = $views->fetch(PDO::FETCH_ASSOC)['viewCount'];

    $total_rev = $subscription_count *2.99;

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- <title>Responsive Sidebar Menu</title> -->
    <link rel="stylesheet" href="assets/style/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://kit.fontawesome.com/ad0bee6fca.js" crossorigin="anonymous"></script>
    <style>
      *{
        background-color: #141414;
      }
      #tb{
        background-color: #0093E9;
        background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);

      }
    </style>
  </head>
  <div class="admintopBar"> 
            <div class="logoContainer">
                <a href="index.php">
                    <img src="assets/images/logo.png" alt="Logo">
                </a>
            </div>
    </div>

    <div class="container1">
      <span id="heading">DASHBOARD</span>

      

      <div class="cards">
        <div class="card">
          <h2>Total Users</h2>
          <i class="fa-regular fa-user"></i>
          <div class="data">
            <span><?= $user_count?></span>
          </div>
        </div>
        <div class="card">
          <h2>Total Revenue</h2>
          <i class="fa-solid fa-dollar-sign"></i>
          <div class="data">
            <span><?= $total_rev?></span>
          </div>
        </div>

        <div class="card">
          <h2>Total Views</h2>
          <i class="fa-solid fa-chart-simple"></i>
          <div class="data">
            <span><?= $total_views?></span>
          </div>
        </div>

        

        <div class="card">
          <h2>Total Movies</h2>
          <i class="fa-solid fa-film"></i>  
          <div class="data">
            <span><?= $movie_count?></span>
          </div>
        </div>

        <div class="card">
          <h2>Total Shows</h2>
          <i class="fa-solid fa-tv"></i> 
          <div class="data">
            <span><?= $tv_show_count?></span>
          </div>
        </div>

        <div class="card">
          <h2> Subscriptions</h2>
          <i class="fa-solid fa-wallet"></i>
          <div class="data">
            <span><?= $subscription_count?></span>
          </div>
        </div>

        </div>
    

      <div class="usersTable">
        <section>
            <!--for demo wrap-->
            <h1 style="color: #fff;">Users</h1>
            <div class="tbl-header">
              <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Sign Up Date</th>
                    <th>Is Subscribed</th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="tbl-content">
              <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                <?php
                  $sql = "SELECT * FROM users";
                  $stmt = $con->query($sql);
                  
                  $row_count = $stmt->rowCount();
                              if ($row_count > 0) {
                                  // Output data in a table format
                                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                      echo "<tr><td>".$row["id"]."</td><td>".$row["firstName"]."</td><td>".$row["lastName"]."</td><td>".$row["signUpDate"]."</td><td>".$row["isSubscribed"]."</td></tr>";
                                  }
                          } else {
                                  echo "0 results";
                          }
                    
                ?>
                </tbody>
              </table>
            </div>
          </section>
          </div>

          <div class="entitiesTable">
        <section>
            <!--for demo wrap-->
            <h1 style="color: #fff;">Movies and TV Shows</h1>
            <div class="tbl-header">
              <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    
                  </tr>
                </thead>
              </table>
            </div>
            <div class="tbl-content">
              <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                <?php
                  $sql = "SELECT * FROM entities";
                  $stmt = $con->query($sql);
                  
                  $row_count = $stmt->rowCount();
                              if ($row_count > 0) {
                                  // Output data in a table format
                                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                      echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td></tr>";
                                  }
                          } else {
                                  echo "0 results";
                          }
                    
                ?>
                </tbody>
              </table>
            </div>
          </section>
            
          <div class="feedback">
        <section>
            <!--for demo wrap-->
            <h1 style="color: #fff;">User Messages</h1>
            <div class="tbl-header">
              <table cellpadding="0" cellspacing="0" border="0" style="background: transparent;">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="tbl-content">
              <table cellpadding="0" cellspacing="0" border="0" id="tb">
                <tbody>
                <?php
                  $sql = "SELECT * FROM feedback";
                  $stmt = $con->query($sql);
                  
                  $row_count = $stmt->rowCount();
                              if ($row_count > 0) {
                                  // Output data in a table format
                                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                      echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row['message']."</td></tr>";
                                  }
                          } else {
                                  echo "0 results";
                          }
                    
                ?>
                </tbody>
              </table>
            </div>
          </section>

    <div style="background-color: transparent; color: #fff; padding: 20px; text-align: center;">
        <p>CrystaFlix Streaming</p>
        <p>&copy; 2024 CrystaFlix. All rights reserved.</p>
    </div>

        


      
      
    </div>
</body>
</html>






<?php
// Close the PDO connection
$conn = null;
?>