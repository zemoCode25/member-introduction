<?php
  require_once './includes/db_inc.php';

  $sql = "SELECT id, fname, lname, image_path FROM tblmember";

  $result = $conn->query($sql);

  $fileFolder = "./images/";
  $members = [];

  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $members[] = $row;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Members</title>
    <link rel="stylesheet" href="./src/styles/reset.css">
    <link rel="stylesheet" href="./src/styles/style.css">
    <link rel="stylesheet" href="./src/styles/index.css">
  </head>
  <body>
  <main>
      <section class="member__section">
      <h1 class="member__h1">Meet the members.</h1>
        <div class="member__grid">
          <?php foreach($members as $member): ?>
            <div class="member__item" id="<?php echo htmlspecialchars($member["id"]) ?>">
                <?php $imagePath = "./images/" . $member["image_path"]?>
                <?php $fullname =  $member["lname"] . " " . $member["fname"]?>
                <img class="member__img" src="<?php echo $imagePath?>" alt="Selfie Image of <?php echo $fullname?>" />
                <h2 class="member__h2"><?php echo htmlspecialchars($member["lname"]) ?></h2>
                <p class="member__p"><?php echo htmlspecialchars($member["fname"]) ?></p>
                <button class="member__button">View</button>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="overlay">
          <li></li>
        </div>
      </section>
    </main>
    <script src="./src/src.js"></script>
  </body>
</html>