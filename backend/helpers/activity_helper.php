<?php
function saveActivity($connect, $user_id, $activity, $description = null) {
    $user_id = (int)$user_id;
    $activity = mysqli_real_escape_string($connect, $activity);
    $description = $description ? mysqli_real_escape_string($connect, $description) : null;

    $q = "INSERT INTO user_activity (user_id, activity, description) 
          VALUES ('$user_id', '$activity', " . ($description ? "'$description'" : "NULL") . ")";
    mysqli_query($connect, $q) or die(mysqli_error($connect));
}
