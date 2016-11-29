<?php
include 'db_connect.php';// include database connection

include 'app/indexModel.php';// include index model

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Bob's Hour Tracer</title>
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/main.css" rel="stylesheet">
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">Hour Tracer</a>
        </div>
      </div>
      <!-- /.container -->
    </nav>
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1>Projects</h1>
        <div class=col-lg-12 text-center>
          <?php
                echo '<h4>'.$Totaltime.'</h4>';
                if (count($data)) { //check if there's a project
                    echo '<h5>Total Projects:</h5> '.count($data);
                  }else{
                    echo '<h5>Total Projects: 0</h5>';
                  }
          ?>
            <div class="table-responsive">
              <center>
                <div style="text-align: center; width: 400px; padding-bottom: 50px; padding-top: 20px;display:inline-block;">
                  <span style="float:left;">Add New Project</span>
                  <span style="float:right;">Add New Deadline</span>
                  <br>
                  <input id="newproject" style="width:200px; float:left;" type="text" class="form-control" name="projectName" />
                  <input id="newprojectdeadline" style="width:200px; float:left;" type="text" class="form-control" value="<?php echo date('Y/m/d');?>" />
                  <br><br>
                  <button type="button" class="btn btn-info" style="width:80px; float:right;" onClick="addProject();">Add</button>
                  <span class= "error">Project name is already present.</span>
                  <span class= "success">Project name can be assigned.</span>
                  <br>
                  <span style="color:red; text-style:bold;" id="add"></span>
                </div>
                <table class="table1">
                  <tr class="border_bottom">
                    <th style="width: 20%; padding-right:20px;">Remove project</th>
                    <th style="text-align:left;">Project</th>
                    <th style="width: 30%;">Status</th>
                    <th style="width: 30%;">Deadline</th>
                    <th style="width: 10%;">Action</th>
                  </tr>
                  <?php
                            if (count($data)) { //check if there's a project
                                // echo 'Total Projects: '.count($data);


                                if (isset($data)) { //check if there's a project
                                  foreach ($data as $key => $val) {
                  ?>

                    <tr class="border" id="<?php echo $val['id']; ?>">
                      <td style="width: 20%;padding-right:20px; vertical-align: middle;">
                        <img onClick="deleteProject('<?php echo $val['id']; ?>');" style="cursor: pointer; " src="public/img/delete.png" width="32" height="32" />
                      </td>
                      <td style="vertical-align: middle;text-align:left;">
                        <a href="project.php?id=<?php echo $val['id']; ?>">

                          <?php echo $val['name']; ?>

                        </a>
                      </td>

                      <?php
                                    $status = pg_query($db, $s = 'SELECT name FROM project_status WHERE id = '.$val['status']);
                                    $status_result = 'undefined';
                                    $project_status = pg_fetch_array($status);
                                    $status_result = $project_status['name'];

                                    echo "<td style='width: 10%; vertical-align: middle; ' id='time".$val['id']."'> ".$status_result." </td>
															<td style='width: 10%; vertical-align: middle'>".date('d/m/Y', strtotime($val['deadline']))."</td>
															<td style='width: 10%; vertical-align: middle;display: flex;'>
															".($val['status'] != 3 ? "<button type='button' id='button".$val['id']."' onClick='finishProject(".$val['id'].");' class='btn btn-warning'> Close </button> " : '');

                                    if ($val['status'] != 3) {
                                        echo ($val['status'] != 2 ? "<button type='button' id='button".$val['id']."' onClick='time(".$val['id'].");' class='btn btn-success'>Start</button>" : "<button type='button' id='button".$val['id']."' onClick='time(".$val['id'].");' class='btn btn-alert'>Stop</button>");
                                    }
                                }
                                    ?>
                        </td>
                    </tr>
                    <?php
                                }
                            } else { // if no display no projects found
                                echo '<tr id="noproject">
										<th colspan="4" style="color:red;">No Project Found !</th>
									  </tr>';
                            }
                        ?>
                </table>

              </center>

            </div>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.container -->

      <!-- jQuery Version 1.11.1 -->
      <script src="public/js/jquery.js"></script>
      <script src="public/js/bootstrap.min.js"></script>
      <script src="public/js/main.js " charset="utf-8"></script>

  </body>

  </html>
