<?php
require_once 'includes/Db.php';

$query = "SELECT u.id, u.first_name, u.last_name, t.name
FROM users u
INNER JOIN teams_users tu ON u.id = tu.user_id
INNER JOIN teams t ON tu.team_id = t.id
;";

$result = array();

if ($data = mysqli_query($connect_db, $query)) {

    /* fetch associative array */
    while ($row = $data->fetch_assoc()) {

        if (!array_key_exists($row["id"], $result)) {
            $result[$row["id"]] = $row;
            $result[$row["id"]]["teams"][] = $row["name"];
        } elseif (!in_array($row["name"], $result[$row["id"]]["teams"])) {
            $result[$row["id"]]["teams"][] = $row["name"];
        }
    }

    /* free result set */
    $data->free();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>

        <div class="container">
            <br /><br /><br />
            <table class="table table-bordered">

            <?php if (!empty($result)) { ?>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Teams</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $key => $row) {
                        echo '<tr>
                        <td>' . $row["id"] . '</td>
                        <td>' . $row["first_name"] . " " . $row["last_name"] . '</td>';

                        $allTeams = "";
                        foreach ($row["teams"] as $team) {
                            $allTeams .= " " . $team . ",";
                        }
                        $allTeams = rtrim($allTeams, ",");

                        echo "<td>$allTeams</td>";
                        echo '</tr>';
                    }
                    ?>

                    </tbody>      
            <?php } ?>
            </table>
        </div>

    </body>
</html>

