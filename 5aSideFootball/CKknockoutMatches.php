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
                <li><a class="nav-bar-right-link" href="CKindex.php">小组赛战况</a></li>
                <li><a id="scorerListLink" href="scorersList.php">射手榜</a></li>
            </ul>
        </div>
    </nav>

    <h1><span class="yellow">城口2017赛季五人制足球超级联赛积分榜</span></h1>

<table class="container">
    <thead>
        <tr>
            <th><h1>排名</h1></th>
            <th><h1>球队</h1></th>
            <th><h1>场次</h1></th>
            <th><h1>积分</h1></th>
            <th><h1>胜</h1></th>
            <th><h1>平</h1></th>
            <th><h1>负</h1></th>
            <th><h1>进球</h1></th>
            <th><h1>失球</h1></th>
            <th><h1>净胜球</h1></th>
        </tr>
    </thead>
    <tbody>

<?php 
    require_once('CKdbVars.php');
    $rank = 0;

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die("Error when connecting to database.");
    $query = "SELECT *, (knockOutTeamInfo.goalsScored - knockOutTeamInfo.goalsAgainst) AS goalsDifference FROM knockOutTeamInfo WHERE 1 ORDER BY knockOutTeamInfo.points DESC, goalsDifference DESC, goalsScored DESC;";
    // echo $query;
    mysqli_query($dbc, "set character set 'utf8'") or die('Error in setting character.');
    $result = mysqli_query($dbc, $query) or die('Error when querying database.');

    while ($row = mysqli_fetch_assoc($result)) {
        $rank++;
        $teamName = $row['teamName'];
        $gamesPlayed = $row['gamesPlayed'];
        $points = $row['points'];
        $wins = $row['wins'];
        $draws = $row['draws'];
        $losses = $row['losses'];
        $goalsScored = $row['goalsScored'];
        $goalsAgainst = $row['goalsAgainst'];
        $goalsDifference = $row['goalsDifference'];

echo "
    <tr>
        <td>$rank</td>
        <td>$teamName</td>
        <td>$gamesPlayed</td>
        <td>$points</td>
        <td>$wins</td>
        <td>$draws</td>
        <td>$losses</td>
        <td>$goalsScored</td>
        <td>$goalsAgainst</td>
        <td>$goalsDifference</td>
    </tr>
";
    }
?>

    </tbody>
</table>




	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
    <script src="CKjs/scripts.js"></script>
</body>
</html>