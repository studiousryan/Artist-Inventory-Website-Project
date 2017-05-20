<?php
header('Content-Type: text/html; charset=utf-8');

$tableHead = array('', '凝聚力传媒', '政府办', '九龙洞佰锶', '实验小学', '兴发电器', '公安局', '胜', '平', '负', '进球', '失球', '净胜球', '积分');
$teams = array('凝聚力传媒', '政府办', '九龙洞佰锶', '实验小学', '兴发电器', '公安局', '税务联队', '城乡建委', '职教中心', '国土局', '复兴街道');
$numCols = sizeof($teams);
$teamPointsGroup = array();

require_once('CKdbVars.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die("Error when connecting to database.");
mysqli_query($dbc, "set character set 'utf8'") or die('Error in setting character.');

for ($rowPostion = 0; $rowPostion < sizeof($teams); $rowPostion++) {

    $wins = 0;
    $draws = 0;
    $losses = 0;
    $goalsScored = 0;
    $goalsAgainst = 0;
    $goalsDifference = 0;
    $points = 0;
    $query = "
                SELECT id, homeTeam, awayTeam, homeTeamScored, awayTeamScored
                FROM groupMatchesInfo
                WHERE homeTeam =  '" . $teams[$rowPostion] . "'
                UNION ALL 
                SELECT id, awayTeam AS homeTeam, homeTeam AS awayTeam, awayTeamScored AS homeTeamScored, homeTeamScored AS awayTeamScored
                FROM groupMatchesInfo
                WHERE awayTeam =  '" . $teams[$rowPostion] . "' ORDER BY id
            ";

    // if ($rowPostion == 1) {
    //     echo $query."<br>";
    // }

    $result = mysqli_query($dbc, $query) or die('Error when querying database.');
    // indicates if this row data matches that of the team with current column position
    $matches = true;    

    for ($columnPosition=0; $columnPosition < $numCols; $columnPosition++) {

        if ($matches) {
            $row = mysqli_fetch_assoc($result);
            $awayTeam = $row['awayTeam'];
        }
        
        if ($teams[$columnPosition] == $awayTeam) {
            $matches = true;
            $homeTeamScored = $row['homeTeamScored'];
            $awayTeamScored = $row['awayTeamScored'];
            $goalsScored += $homeTeamScored;
            $goalsAgainst += $awayTeamScored;
            $goalsDifference = $goalsScored - $goalsAgainst;

            if ($homeTeamScored > $awayTeamScored) {
                $wins++;
            } elseif ($homeTeamScored === $awayTeamScored) {
                $draws++;
            } else {
                $losses++;
            }
        } else {
            $matches = false;
        }

        if ($columnPosition === $numCols -1) {
            $points = $wins*3 + $draws;
            $teamPointsGroup["'$teams[$rowPostion]'"] = $points;

            $update = "
                UPDATE groupTeamInfo 
                SET points = $points, wins = $wins, draws = $draws, losses = $losses, goalsScored = $goalsScored, goalsAgainst = $goalsAgainst, goalsDifference = $goalsDifference 
                WHERE teamName = '".$teams[$rowPostion]."'
            ";
            // echo $update."<br>";
            mysqli_query($dbc, $update) or die('Error when inserting database.');
        }
    }
}


// Find out rank for each team
arsort($teamPointsGroup);
// print_r($teamPointsGroup);

$rankIndex = 0;
$rank = array();
$preVal = -1;
$sameCnt = 0;

foreach ($teamPointsGroup as $key => $value) {
    if ($value != $preVal) {
        $rankIndex += $sameCnt + 1;
        $sameCnt = 0;
    } else {
        $sameCnt++;
    }

    $rank[$key] = $rankIndex;
    $preVal = $value;

    $update = "
        UPDATE groupTeamInfo 
        SET rank = $rankIndex 
        WHERE teamName = $key
    ";
    // echo $update."<br>";
    mysqli_query($dbc, $update) or die('Error when inserting database.');

}

mysqli_close($dbc) or die('Error when closing database connection.');
?>