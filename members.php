<?php 

    require_once './includes/db_inc.php';

    function formatBirthDate($bday) {
        $bDate = new DateTime($bday);
        return $bDate->format('F j, Y');
    }

    if(isset($_GET["id"])) {
        $member_id = (int) $_GET["id"];

        $sql = "SELECT fName, lName, bday, quote, image_path, FLOOR(DATEDIFF(CURDATE(), bday) / 365) AS age FROM tblmember WHERE id = $member_id;";
        $result = $conn->query($sql);

        $memberInfos = [];

        if($result->num_rows > 0) {
            $memberInfos = $result->fetch_assoc();
            $formattedbDate = formatBirthDate($memberInfos["bday"]);
            $memberInfos["bday"] = $formattedbDate;
        }

        $sqlhobbies = "SELECT h.hobby AS hobby FROM tblmember AS m INNER JOIN tblhobbies AS h ON m.id = h.member_id WHERE m.id = $member_id;";
        $resultHobbies = $conn->query($sqlhobbies);

        $hobbiesRow = [];

        if($resultHobbies->num_rows > 0) {
            while($rowhobby = $resultHobbies->fetch_assoc()) {
                $hobbiesRow[] = $rowhobby;
            }
        } else {
            echo "No data recieved";
        }

        $conn->close();
    } else {
        echo "No Data Receieved";
    }
    // VISUALISATION
    // const arrAssoc= [
    //     [
    //         ["id", "3"],
    //         ["member_id", "1112"],
    //         ["hobby", "Watching Manga"],
    //     ],
    //     [
    //         so on...
    //     ]
    // ]
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./src/styles/reset.css">
    <link rel="stylesheet" href="./src/styles/style.css">
    <link rel="stylesheet" href="./src/styles/member.css">
</head>
<body>
    <main>
        <section class="member-info">
            <h1 class="member-info__h1">Member Information.</h1>
            <div class="member-info__container">
                <?php $imagePath = "./images/" . $memberInfos["image_path"]?>
                <?php $fullname =  $memberInfos['fName'] . " " . $memberInfos['lName']?>
                    <img class="member-info__img" src="<?php echo $imagePath?>" alt="Selfie Image of <?php echo $fullname?>" />
                    <div class="member-info__container--info-div">
                            <label>Name:</label>
                            <p><?php echo $fullname ?></p>
                            <label>Birthday: </label>
                            <p><?php echo $memberInfos["bday"] ?></p>
                            <label>Age:</label>
                            <p><?php echo $memberInfos["age"] ?></p>
                            <label>Hobbies:</label>
                            <ul class="member-info__ul">
                                <?php foreach($hobbiesRow as $hobby):?>
                                    <li class="member-info__li"><?php echo $hobby["hobby"]?></li>
                                <?php endforeach; ?>
                            </ul>
                            <label>Quote: </label>
                            <p class="member-info--quote"><?php echo "\"" . $memberInfos["quote"] . "\"" ?></p>
                    </div>
            </div>
        </section>
    </main>
</body>
</html>