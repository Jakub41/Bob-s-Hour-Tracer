function deleteProject(id) { // send request to ajax.php to delete the project and remove it from the table
    $.ajax({
        url: "ajax.php?action=delete_project&id=" + id,
        success: function(result) {
            $("tr#" + id).remove();
            window.location.reload();
        }
    });
}

function deleteEntry(id) { // to remove the row from the html table if it's deleted in the html table
    $.ajax({
        url: "ajax.php?action=delete_entry&id=" + id,
        success: function(result) {
            $("tr#" + id).remove();
            window.location.reload();
        }
    });
}

function addProject() { //send request to ajax.php to add new project and add it to the table
    var name = $('#newproject').val();
    var deadline = $('#newprojectdeadline').val();
    if (name.trim()) {
        $.ajax({
            url: "ajax.php?action=add_project&name=" + name + "&deadline=" + deadline,
            success: function(result) {
              if(result){ // Project name not exist so success add new
                //console.log("Great!!!")
                {
                  $(".success").css("color","green").show();
                  $(".error").hide();
                  $('#newproject').val('');
                }
                  window.location.reload();
              }else{ // Project name exist so erro show error
                //console.log("Error!!!")
                {
                  $(".error").css("color","red").show();
                  $(".success").hide();
                }
              }

            }
        });
    }
}

function time(id) { //send request to ajax.php to get start or stop the timer and update the start/stop button according to the current action
    $.ajax({
        url: "ajax.php?action=time&id=" + id,
        success: function(result) {

            window.location.reload();
        }
    });
}

function finishProject(id) { // to remove the row from the html table if it's deleted in the html table
    $.ajax({
        url: "ajax.php?action=finished&id=" + id,
        success: function(result) {
            // $("tr#"+id).remove();
            window.location.reload();
        }
    });
}

function finishProject(id) { // to remove the row from the html table if it's deleted in the html table
    $.ajax({
        url: "ajax.php?action=finished&id=" + id,
        success: function(result) {
            // $("tr#"+id).remove();
            window.location.reload();
        }
    });
}
