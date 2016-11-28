<?php

include 'db_connect.php';

if (isset($_GET['action'])) { //check if action get paramter is set

    switch ($_GET['action']) { // if it is set check it's value and do action according to the value of action

        case 'delete_project':
            pg_query($db, 'DELETE FROM project_details WHERE id='.$_GET['id']); //Delete the project_details
            pg_query($db, 'DELETE FROM time WHERE project_id='.$_GET['id']); //Delete all time starts and stops of this project_details
            break;

        case 'add_project':
            $_GET['name'] = rtrim(ltrim($_GET['name']));
            $_GET['deadline'] = rtrim(ltrim($_GET['deadline'])); // be carefull here it may cause security

            $result = pg_query($db, "SELECT name FROM project_details WHERE name = '".$_GET['name']."'"); //check if project_details name already exists

            if (pg_num_rows($result)) { //if yes
                $projectName = 'Project already exists !'; //show project_details already exists
            } else { //if no
                $insert = pg_query($db, "INSERT INTO project_details (NAME,deadline,STATUS) VALUES ('".$_GET['name']."','".$_GET['deadline']."',1)"); //Add new project_details
                $res = pg_query($db, "SELECT id, name,'Start' as status ,deadline FROM project_details ORDER BY ID DESC LIMIT 1"); // Get ID of this inserted row

                while ($row = pg_fetch_array($res)) {
                    // $data[$row['id']] = $row;
                    $id = $row['id'];
                    $name = $row['name'];
                    $status = $row['status'];
                    $deadline = $row['deadline'];
                }
                echo $id.'|'.$name.'|'.$status.'|'.$deadline; // send back the name, id and the deadline to the homepage to add the project_details to the table
            }

            break;

        case 'time':
            $result = pg_query($db, $s = 'SELECT * FROM project_time WHERE project_id='.$_GET['id'].' and finish is null ORDER BY id DESC limit 1'); //get last project_details record in time table

            if (pg_num_rows($result) > 0) { //if there's a record

                $row = pg_fetch_array($result);
                pg_query($db, 'UPDATE project_time SET finish=CURRENT_TIMESTAMP WHERE id='.$row['id']); //add stop time

        pg_query($db, 'UPDATE project_details SET total_time = total_time + (SELECT (finish-start) AS total_time FROM project_time WHERE project_id ='.$row['project_id'].' order by id desc limit 1) WHERE id='.$_GET['id']);

                // echo 'Timer inserted: ' . $conn->affected_rows;
                pg_query($db, "UPDATE project_details set status= 1 where id='".$_GET['id']."'"); //update the status of the project
                // echo 'Project Status updated: ' . $conn->affected_rows;
            } else { //if not
                $insert_result = pg_query($db, "INSERT INTO project_time ( start, finish, project_id) VALUES ( CURRENT_TIMESTAMP , null, '".$_GET['id']."')"); //Add new time record
                // echo 'Total rows inserted: ' . $conn->affected_rows;
                $update_result = pg_query($db, "UPDATE project_details set status= 2 where id='".$_GET['id']."'"); //update the status of the project
                // echo 'Project Status updated: ' . $conn->affected_rows;
            }

            break;

        case 'delete_entry':
            pg_query($db, 'DELETE FROM project_time WHERE id='.$_GET['id']);
            break;
        case 'finished':
            pg_query($db, 'UPDATE  project_details set status = 3 WHERE id='.$_GET['id']);
            break;
    }
}
