<?php
    //Get projects detsils from database

    $sql = pg_query($db, 'SELECT * FROM project_details order by id desc'); //Select all the columns from the table project

    $data = array();

    while ($row = pg_fetch_array($sql)) {
        $data[$row['id']] = $row;
    }

    //Time result finish h - start h = total time spent
    $result_2 = pg_query($db, 'SELECT sum(finish-start) total FROM project_time as t inner join project_details as d on d.id=t.project_id');

    $row = pg_fetch_array($result_2);

    $time = $row['total'];

    $result_3 = pg_query($db, 'SELECT sum(finish-start) total FROM project_time as t inner join project_details as d on d.id=t.project_id where d.status<>3');
    $row = pg_fetch_array($result_3);
    $time_open = $row['total'];

    $result_4 = pg_query($db, 'SELECT sum(finish-start) total FROM project_time as t inner join project_details as d on d.id=t.project_id where d.status=3');
    $row = pg_fetch_array($result_4);

    //Showing the correct time hours
    $temp = explode('.', $row['total']);
    $time = $temp[0];

    $result_3 = pg_query($db, 'SELECT sum(finish-start) total FROM project_time as t inner join project_details as d on d.id=t.project_id where d.status<>3');
    $row = pg_fetch_array($result_3);
    $temp = explode('.', $row['total']);
    $time_open = $temp[0];

    $result_4 = pg_query($db, 'SELECT sum(finish-start) total FROM project_time as t inner join project_details as d on d.id=t.project_id where d.status=3');
    $row = pg_fetch_array($result_4);
    $temp = explode('.', $row['total']);
    $time_closed = $temp[0];

    $Totaltime = '<br>Time Spent on Open projects: '.(($time_open) ? $time_open : '0 hours').
                 '<br>Time Spent on Closed projects: '.(($time_closed) ? $time_closed : '0 hours').'<br><br>';
