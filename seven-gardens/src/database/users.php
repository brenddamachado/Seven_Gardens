<?php
function list_users_from_db($conn) {
    $users = [];

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    $result_check = mysqli_num_rows($result);

    if($result_check > 0)
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_close($conn);
    return $users;
}