<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>大城口2017赛季五人制足球超超超超级联赛积分榜</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="CKcss/style.css">

</head>
<body>
	<nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand blue" id="homeLogo" href="CKindex.php">城超</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="nav-bar-right-link" href="CKknockoutMatches.php">淘汰赛战况</a></li>
                <li><a class="nav-bar-right-link" href="scorersList.php">射手榜</a></li>
            </ul>
        </div>
    </nav>

    <h1><span class="yellow">小组赛战况</span></h1>

<table class="container">
    <caption><h1>A 组</h1></caption>
    <thead>
        <tr>

<?php
// $tableHead = array('', '凝聚力传媒', '政府办', '九龙洞佰锶', '实验小学', '兴发电器', '公安局', '胜', '平', '负', '进球', '失球', '净胜球', '积分', '排名');
$tableHead = array('', '凝聚力传媒', '政府办', '九龙洞佰锶', '实验小学', '兴发电器', '公安局', '胜', '平', '负', '进球', '失球', '净胜球', '积分');
$teams = array('凝聚力传媒', '政府办', '九龙洞佰锶', '实验小学', '兴发电器', '公安局');
$tableHeadTeamInfo = array('胜', '平', '负', '进球', '失球', '净胜球', '积分', '排名');
$numCols = sizeof($tableHead);
$teamPointsGroup = array();

for ($i=0; $i < $numCols; $i++) { 
    echo "<th><h1>" . $tableHead[$i] . "</h1></th>";
}

echo "
        </tr>
    </thead>
    <tbody>
    ";

require_once('CKdbVars.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die("Error when connecting to database.");
mysqli_query($dbc, "set character set 'utf8'") or die('Error in setting character.');

for ($rowPostion = 0; $rowPostion < sizeof($teams); $rowPostion++) {
    echo "<tr><td>" . $teams[$rowPostion] . "</td>";

    $wins = 0;
    $draws = 0;
    $losses = 0;
    $goalsScored = 0;
    $goalsAgainst = 0;
    $goalsDifference = 0;

    $query = "
                SELECT id, homeTeam, awayTeam, homeTeamScored, awayTeamScored
                FROM groupMatchesInfo
                WHERE homeTeam =  '" . $teams[$rowPostion] . "'
                UNION ALL 
                SELECT id, awayTeam AS homeTeam, homeTeam AS awayTeam, awayTeamScored AS homeTeamScored, homeTeamScored AS awayTeamScored
                FROM groupMatchesInfo
                WHERE awayTeam =  '" . $teams[$rowPostion] . "' ORDER BY id
            ";

    $result = mysqli_query($dbc, $query) or die('Error when querying database.');
    $isBlankCell = false;    

    for ($columnPosition=1; $columnPosition < $numCols; $columnPosition++) {
        if ($teams[$rowPostion] == $tableHead[$columnPosition]) {
            echo "<td class='crossed'></td>";
        } elseif (in_array($tableHead[$columnPosition], $teams)) {
            if (!$isBlankCell) {
                $row = mysqli_fetch_assoc($result);
                $awayTeam = $row['awayTeam'];
            }
            
            // echo "alwayTeam=".$awayTeam."<br><br>";

            if ($tableHead[$columnPosition] == $awayTeam) {
                $isBlankCell = false;
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

                echo "<td>$homeTeamScored : $awayTeamScored</td>";
            } else {
                $isBlankCell = true;
                echo "<td></td>";
            }
        } elseif (in_array($tableHead[$columnPosition], $tableHeadTeamInfo)) {
            if ($tableHead[$columnPosition] == '胜') {
                echo "<td>$wins</td>";
            } elseif ($tableHead[$columnPosition] == '平') {
                echo "<td>$draws</td>";
            } elseif ($tableHead[$columnPosition] == '负') {
                echo "<td>$losses</td>";
            } elseif ($tableHead[$columnPosition] == '进球') {
                echo "<td>$goalsScored</td>";
            } elseif ($tableHead[$columnPosition] == '失球') {
                echo "<td>$goalsAgainst</td>";
            } elseif ($tableHead[$columnPosition] == '净胜球') {
                echo "<td>$goalsDifference</td>";
            } elseif ($tableHead[$columnPosition] == '积分') {
                $points = $wins*3 + $draws;
                echo "<td>$points</td>";

                $teamPointsGroup["'$teams[$rowPostion]'"] = $points;

                $insertion = "
                    UPDATE groupTeamInfo 
                    SET points = $points, wins = $wins, draws = $draws, losses = $losses, goalsScored = $goalsScored, goalsAgainst = $goalsAgainst, goalsDifference = $goalsDifference 
                    WHERE teamName = '".$teams[$rowPostion]."'
                ";
                // echo $insertion."<br>";
                mysqli_query($dbc, $insertion) or die('Error when inserting database.');
            }
            //  elseif ($tableHead[$columnPosition] == '排名') {
            //     echo "<td>$wins</td>";
            // }

            
            
            
        }
    }

    echo "</tr>";


}
?>
    </tbody>
</table>

<table class="container">
    <caption><h1>B 组</h1></caption>
    <thead>
        <tr>
<?php
// $tableHead = array('', '税务联队', '城乡建委', '职教中心', '国土局', '复兴街道', '胜', '平', '负', '进球', '失球', '净胜球', '积分', '排名');
$tableHead = array('', '税务联队', '城乡建委', '职教中心', '国土局', '复兴街道', '胜', '平', '负', '进球', '失球', '净胜球', '积分');
$teams = array('税务联队', '城乡建委', '职教中心', '国土局', '复兴街道');
$numCols = sizeof($tableHead);

for ($i=0; $i < $numCols; $i++) { 
    echo "<th><h1>" . $tableHead[$i] . "</h1></th>";
}

echo "
        </tr>
    </thead>
    <tbody>
    ";

mysqli_query($dbc, "set character set 'utf8'") or die('Error in setting character.');

for ($rowPostion = 0; $rowPostion < sizeof($teams); $rowPostion++) {
    echo "<tr><td>" . $teams[$rowPostion] . "</td>";

    $wins = 0;
    $draws = 0;
    $losses = 0;
    $goalsScored = 0;
    $goalsAgainst = 0;
    $goalsDifference = 0;

    $query = "
                SELECT id, homeTeam, awayTeam, homeTeamScored, awayTeamScored
                FROM groupMatchesInfo
                WHERE homeTeam =  '" . $teams[$rowPostion] . "'
                UNION ALL 
                SELECT id, awayTeam AS homeTeam, homeTeam AS awayTeam, awayTeamScored AS homeTeamScored, homeTeamScored AS awayTeamScored
                FROM groupMatchesInfo
                WHERE awayTeam =  '" . $teams[$rowPostion] . "' ORDER BY id
            ";

    $result = mysqli_query($dbc, $query) or die('Error when querying database.');
    $isBlankCell = false;    

    for ($columnPosition=1; $columnPosition < $numCols; $columnPosition++) {
        if ($teams[$rowPostion] == $tableHead[$columnPosition]) {
            echo "<td class='crossed'></td>";
        } elseif (in_array($tableHead[$columnPosition], $teams)) {
            if (!$isBlankCell) {
                $row = mysqli_fetch_assoc($result);
                $awayTeam = $row['awayTeam'];
            }
            
            // echo "alwayTeam=".$awayTeam."<br><br>";

            if ($tableHead[$columnPosition] == $awayTeam) {
                $isBlankCell = false;
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

                echo "<td>$homeTeamScored : $awayTeamScored</td>";
            } else {
                $isBlankCell = true;
                echo "<td></td>";
            }
        } elseif (in_array($tableHead[$columnPosition], $tableHeadTeamInfo)) {
            if ($tableHead[$columnPosition] == '胜') {
                echo "<td>$wins</td>";
            } elseif ($tableHead[$columnPosition] == '平') {
                echo "<td>$draws</td>";
            } elseif ($tableHead[$columnPosition] == '负') {
                echo "<td>$losses</td>";
            } elseif ($tableHead[$columnPosition] == '进球') {
                echo "<td>$goalsScored</td>";
            } elseif ($tableHead[$columnPosition] == '失球') {
                echo "<td>$goalsAgainst</td>";
            } elseif ($tableHead[$columnPosition] == '净胜球') {
                echo "<td>$goalsDifference</td>";
            } elseif ($tableHead[$columnPosition] == '积分') {
                $points = $wins*3 + $draws;
                echo "<td>$points</td>";

                $teamPointsGroup["'$teams[$rowPostion]'"] = $points;

                $insertion = "
                    UPDATE groupTeamInfo 
                    SET points = $points, wins = $wins, draws = $draws, losses = $losses, goalsScored = $goalsScored, goalsAgainst = $goalsAgainst, goalsDifference = $goalsDifference 
                    WHERE teamName = '".$teams[$rowPostion]."'
                ";

                // echo $insertion;
                mysqli_query($dbc, $insertion) or die('Error when inserting database.');
            }
            //  elseif ($tableHead[$columnPosition] == '排名') {
            //     echo "<td>$wins</td>";
            // }
        }
    }
    echo "</tr>";

    // $query = "
    //     SELECT teamName, points FROM groupTeamInfo ORDER BY points DESC
    // ";
    // $result = mysqli_query($dbc, $query) or die("Error when querying database.");
    // $row = mysqli_fetch_assoc($result);
}

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
}

// print_r($rank);

mysqli_close($dbc) or die('Error when closing database connection.');
?>
    </tbody>
</table>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
    <script src="CKjs/scripts.js"></script>
</body>
</html>