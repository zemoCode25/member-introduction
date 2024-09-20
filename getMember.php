<?php
require_once './includes/db_inc.php';

function formatBirthDate($bday) {
    $bDate = new DateTime($bday);
    return $bDate->format('F j, Y');
}

$response = [];

if(isset($_GET["id"])) {
    $member_id = (int) $_GET["id"];

    // Fetch member info
    $sql = "SELECT fName, lName, bday, quote, image_path, FLOOR(DATEDIFF(CURDATE(), bday) / 365) AS age FROM tblmember WHERE id = $member_id;";
    $result = $conn->query($sql);

    $memberInfos = [];

    if($result->num_rows > 0) {
        $memberInfos = $result->fetch_assoc();
        $formattedbDate = formatBirthDate($memberInfos["bday"]);
        $memberInfos["bday"] = $formattedbDate;
    }
    $response['memberInfos'] = $memberInfos;

    // Fetch hobbies
    $sqlhobbies = "SELECT h.hobby AS hobby FROM tblmember AS m INNER JOIN tblhobbies AS h ON m.id = h.member_id WHERE m.id = $member_id;";
    $resultHobbies = $conn->query($sqlhobbies);

    $hobbiesRow = [];

    if($resultHobbies->num_rows > 0) {
        while($rowhobby = $resultHobbies->fetch_assoc()) {
            $hobbiesRow[] = $rowhobby;
        }
    }
    $response['hobbies'] = $hobbiesRow;

    $conn->close();
} else {
    $response['error'] = 'No Data Received';
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
