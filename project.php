<?php
include 'db_connect.php'; // include database connection

include 'app/projectModel.php'; // include project model

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
      <?php echo $project_row['name']; ?>
    </title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/main.css">
    <style>

    </style>
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">Homepage</a>
        </div>
      </div>
      <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">
        <div class="col-lg-12 text-center">
          <h1><?php echo $project_row['name']; ?></h1>

          <div class="table-responsive" style="padding-top:20px;">
            <center>
              <?php

                        echo '<h4>Total Time Spent: '.$sumtime.'</h4><br>';
                    ?>
                <table style="border-bottom: 2px solid #CCC;">
                  <tr>
                    <th style="width: 10%; border-left: 0;"></th>
                    <th style="width: 35%; border: 2px solid #CCC;" colspan="2">Start</th>
                    <th style="width: 35%; border: 2px solid #CCC;" colspan="2">Stop</th>
                    <th style="width: 10%; border-right: 0"></th>
                    <th style="width: 10%; border-right: 0"></th>
                  </tr>
                  <tr class="second">
                    <th style="width: 10%; border: 2px solid #CCC;">ID</th>
                    <th style="width: 17%; border: 2px solid #CCC;">Date</th>
                    <th style="width: 17%; border: 2px solid #CCC;">Time</th>
                    <th style="width: 17%; border: 2px solid #CCC;">Date</th>
                    <th style="width: 17%; border: 2px solid #CCC;">Time</th>
                    <th style="width: 10%; border: 2px solid #CCC;">Total Time</th>
                    <th style="width: 10%; border: 2px solid #CCC;">Delete</th>
                  </tr>
                  <?php

                        if (isset($time_row[0])) {

                            for ($i = 0;$i < count($time_row);++$i) {
                                $j = $i + 1;
                                ?>
                    <tr class="rows" id="<?php echo $time_row[$i]['id'];
                                ?>">
                      <td style="width: 10%; border-right: 2px solid #CCC; border-left: 2px solid #CCC;">
                        <?php echo $j;
                                ?>
                      </td>
                      <td style="width: 17%; background-color:#bcffcc;">
                        <?php echo date('d/m/Y', strtotime($time_row[$i]['start']));
                                ?>
                      </td>
                      <td style="width: 17%; border-right: 2px solid #CCC; background-color:#bcffcc;">
                        <?php echo date('H:i:s', strtotime($time_row[$i]['start']));
                                ?>
                      </td>
                      <td style="width: 17%; border-right: 2px solid #CCC; background-color:#ffbcbc;">
                        <?php if (!empty($time_row[$i]['finish'])) { //check if the time record is still running or stopped (date)
                                        echo date('d/m/Y', strtotime($time_row[$i]['finish']));
} else {
    echo 'Still Running';
}
                                ?>
                      </td>
                      <td style="width: 17%; border-right: 2px solid #CCC; background-color:#ffbcbc;">

                        <?php if (!empty($time_row[$i]['finish'])) { //check if the time record is still running or stopped (time)
                                        echo date('H:i:s', strtotime($time_row[$i]['finish']));
} else {
    echo 'Still Running';
}
                                ?>
                      </td>
                      <td style="width: 10%; border-right: 2px solid #CCC;">
                        <?php
                        $Temp2 = explode('.', $time_row[$i]['spent']);
                        $sumtimelog = $Temp2[0];
                        echo $sumtimelog;

                                ?>
                      </td>

                      <td style="width: 10%; border-right: 2px solid #CCC;"><img src="public/img/delete.png" style="cursor: pointer;" width="20" height="20" onClick="deleteEntry('<?php echo $time_row[$i]['id'];
                                ?>')" /></td>
                    </tr>
                    <?php
                            }
                        } else {
                            ?>
                      <tr>
                        <td colspan="7" style="width: 10%; border: 2px solid #CCC; color:red;">No Time Records Found !</td>
                      </tr>
                      <?php
                        }    ?>
                </table>

            </center>

          </div>
        </div>
        <!-- /.row -->
        <a href="index.php" class="btn btn-warning" style="margin-top: 30px;">Back</a>
      </div>
      <!-- /.container -->

      <!-- jQuery Version 1.11.1 -->
      <script src="public/js/jquery.js"></script>
      <script src="public/js/bootstrap.min.js"></script>
      <script src="public/js/main.js" charset="utf-8"></script>

  </body>

  </html>
