<?php

$result = mysqli_query($connect_db,
        "SELECT *
FROM users u
INNER JOIN teams_users tu ON u.id = tu.user_id
INNER JOIN teams t ON tu.team_id = t.id;");

