<?php include "CKupdateGroupTeamInfo.php" ?>

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
$tableHead = array('', '凝聚力传媒', '政府办', '九龙洞佰锶', '实验小学', '兴发电器', '公安局', '胜', '平', '负', '进球', '失球', '净胜球', '积分', '排名');
$teams = array('凝聚力传媒', '政府办', '九龙洞佰锶', '实验小学', '兴发电器', '公安局');
$teamStatus = array('胜', '平', '负', '进球', '失球', '净胜球', '积分', '排名');
$numCols = sizeof($tableHead);

for ($colPosition=0; $colPosition < $numCols; $colPosition++) { 
    echo "<th><h1>" . $tableHead[$colPosition] . "</h1></th>";
}
?>
        </tr>
    </thead>
    <tbody>
<?php
require_once('CKdbVars.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die("Error when connecting to database.");
mysqli_query($dbc, "set character set 'utf8'") or die('Error in setting character.');

for ($rowPostion=0; $rowPostion < sizeof($teams); $rowPostion++) { 
    echo "<tr>
            <td>".$teams[$rowPostion]."</td>";

    for ($colPosition=1; $colPosition < $numCols; $colPosition++) {
        if ($teams[$rowPostion] == $tableHead[$colPosition]) {
            echo "<td class='crossed'></td>";
        } elseif (in_array($tableHead[$colPosition], $teams) ) {
            $query = "
                SELECT * 
                FROM (
                    SELECT homeTeam, awayTeam, homeTeamScored, awayTeamScored
                    FROM groupMatchesInfo
                    WHERE homeTeam = '" . $teams[$rowPostion] . "' AND awayTeam = '" . $tableHead[$colPosition] . "'
                    UNION
                    SELECT awayTeam AS homeTeam, homeTeam AS awayTeam, awayTeamScored AS homeTeamScored, homeTeamScored AS awayTeamScored
                    FROM groupMatchesInfo
                    WHERE homeTeam = '" . $tableHead[$colPosition] . "' AND awayTeam = '" . $teams[$rowPostion] . "') AS T
                WHERE T.homeTeam =  '" . $teams[$rowPostion] . "' AND T.awayTeam =  '" . $tableHead[$colPosition] . "'
            ";

            // echo $query."<br><br>";
            $result = mysqli_query($dbc, $query) or die("Error when querying database.");

            if (mysqli_num_rows($result) == 0) {
                echo "<td></td>";
            } elseif (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                echo "<td>".$row['homeTeamScored']." : ".$row['awayTeamScored']."</td>";
            } else {
                die("Error: there should not be more than one result row.");
            }
        } elseif (in_array($tableHead[$colPosition], $teamStatus)) {
            $query = "
                SELECT * FROM groupTeamInfo WHERE teamName = '".$teams[$rowPostion]."'
            ";
            $result = mysqli_query($dbc, $query) or die("Error when querying database.");

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);

                if ($tableHead[$colPosition] == '胜') {
                    echo "<td>".$row['wins']."</td>";
                } elseif ($tableHead[$colPosition] == '平') {
                    echo "<td>".$row['draws']."</td>";
                } elseif ($tableHead[$colPosition] == '负') {
                    echo "<td>".$row['losses']."</td>";
                } elseif ($tableHead[$colPosition] == '进球') {
                    echo "<td>".$row['goalsScored']."</td>";
                } elseif ($tableHead[$colPosition] == '失球') {
                    echo "<td>".$row['goalsAgainst']."</td>";
                } elseif ($tableHead[$colPosition] == '净胜球') {
                    echo "<td>".$row['goalsDifference']."</td>";
                } elseif ($tableHead[$colPosition] == '积分') {
                    echo "<td>".$row['points']."</td>";
                } elseif ($tableHead[$colPosition] == '排名') {
                    echo "<td>".$row['rank']."</td>";
                }
                
            } else {
                die("Error: there should not be more than one result row.");
            }
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
$tableHead = array('', '税务联队', '城乡建委', '职教中心', '国土局', '复兴街道', '胜', '平', '负', '进球', '失球', '净胜球', '积分', '排名');
$teams = array('税务联队', '城乡建委', '职教中心', '国土局', '复兴街道');
$numCols = sizeof($tableHead);

for ($colPosition=0; $colPosition < $numCols; $colPosition++) { 
    echo "<th><h1>" . $tableHead[$colPosition] . "</h1></th>";
}
?>
        </tr>
    </thead>
    <tbody>
<?php
require_once('CKdbVars.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die("Error when connecting to database.");
mysqli_query($dbc, "set character set 'utf8'") or die('Error in setting character.');

for ($rowPostion=0; $rowPostion < sizeof($teams); $rowPostion++) { 
    echo "<tr>
            <td>".$teams[$rowPostion]."</td>";

    for ($colPosition=1; $colPosition < $numCols; $colPosition++) {
        if ($teams[$rowPostion] == $tableHead[$colPosition]) {
            echo "<td class='crossed'></td>";
        } elseif (in_array($tableHead[$colPosition], $teams) ) {
            $query = "
                SELECT * 
                FROM (
                    SELECT homeTeam, awayTeam, homeTeamScored, awayTeamScored
                    FROM groupMatchesInfo
                    WHERE homeTeam = '" . $teams[$rowPostion] . "' AND awayTeam = '" . $tableHead[$colPosition] . "'
                    UNION
                    SELECT awayTeam AS homeTeam, homeTeam AS awayTeam, awayTeamScored AS homeTeamScored, homeTeamScored AS awayTeamScored
                    FROM groupMatchesInfo
                    WHERE homeTeam = '" . $tableHead[$colPosition] . "' AND awayTeam = '" . $teams[$rowPostion] . "') AS T
                WHERE T.homeTeam =  '" . $teams[$rowPostion] . "' AND T.awayTeam =  '" . $tableHead[$colPosition] . "'
            ";

            // echo $query."<br><br>";
            $result = mysqli_query($dbc, $query) or die("Error when querying database.");

            if (mysqli_num_rows($result) == 0) {
                echo "<td></td>";
            } elseif (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                echo "<td>".$row['homeTeamScored']." : ".$row['awayTeamScored']."</td>";
            } else {
                die("Error: there should not be more than one result row.");
            }
        } elseif (in_array($tableHead[$colPosition], $teamStatus)) {
            $query = "
                SELECT * FROM groupTeamInfo WHERE teamName = '".$teams[$rowPostion]."'
            ";
            $result = mysqli_query($dbc, $query) or die("Error when querying database.");

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);

                if ($tableHead[$colPosition] == '胜') {
                    echo "<td>".$row['wins']."</td>";
                } elseif ($tableHead[$colPosition] == '平') {
                    echo "<td>".$row['draws']."</td>";
                } elseif ($tableHead[$colPosition] == '负') {
                    echo "<td>".$row['losses']."</td>";
                } elseif ($tableHead[$colPosition] == '进球') {
                    echo "<td>".$row['goalsScored']."</td>";
                } elseif ($tableHead[$colPosition] == '失球') {
                    echo "<td>".$row['goalsAgainst']."</td>";
                } elseif ($tableHead[$colPosition] == '净胜球') {
                    echo "<td>".$row['goalsDifference']."</td>";
                } elseif ($tableHead[$colPosition] == '积分') {
                    echo "<td>".$row['points']."</td>";
                } elseif ($tableHead[$colPosition] == '排名') {
                    echo "<td>".$row['rank']."</td>";
                }
                
            } else {
                die("Error: there should not be more than one result row.");
            }
        }
    }


    echo "</tr>";
}
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