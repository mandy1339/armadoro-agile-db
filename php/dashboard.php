<?php
//todo: fix it go get active projects
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
function listActiveUserProjects($id) {
    $get_projects = "select project_id, project_name from project where project_manager='" . $id ."'";
    $result = db_query($get_projects);
    $projects = mysqli_fetch_assoc($result);
    $length = count($result);
    
    echo "<ul>";
    for($i = 0; $i < $length; $i++) {
        echo "<li><button name='project' class='btn btn-link' type='submit' value='" . $projects['project_id'] ."'>". $projects['project_name'] . "</button></li>";
    }
    echo "</ul>";
    
}
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
//todo: function to grab a list of the logged in users  unread comments



// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
function listUnreadComments($id) {
    //from comment_read table
    $get_unread_comments = "select * from unread_comment_detail where emp_id = '" . $id . "'";
    $result = db_query($get_unread_comments);
    
    while($comment = mysqli_fetch_array($result)){
        
        //added by Armando
        $comment_read_pk = $comment['emp_id'] . " " . $comment['comment_id'];
        //added by Armando
    
        $author_tag = "<button name='author' class='btn btn-link' type='submit' value='". $comment['author_id']. "'>".$comment['author']. "</button>";
        echo "<div class='card mb-3 comment-card'><div class='card-header'>"; 
        echo $author_tag;

        //added by Armando
        echo "<button id=\"$comment_read_pk\" onClick=\"remove_comment(this.id)\" style=\"float: right;\">remove</button>";
        //added by Armando
        
        echo "</div><div class='card-body'>";
        echo "<p>" . $comment['comment_text'];
        echo "</p></div></div>";
    }
}
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -




// LIST ITERATIONS()
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
function listIterations($id) {
    //from active_iterations table
    $get_iterations_query = <<<MARKER
    SELECT DISTINCT project_id, iteration_id, iteration_name, date_start, date_end, project_manager, project_name
    FROM employee_active_iterations 
    WHERE project_manager = "$id" OR developer_emp_id = "$id";
MARKER;

    //$get_iterations_query = "SELECT DISTINCT * FROM employee_active_iterations WHERE project_manager = '" . $id . "' OR developer_emp_id = '" . $id . "'";
    $result = db_query($get_iterations_query);
    
    while($iteration = mysqli_fetch_array($result)){
        $iteration_pk = $iteration['iteration_id'];
        $author_tag = "<button name='author' class='btn btn-link' type='submit' value='". $iteration['iteration_id']. "'>".$iteration['iteration_name']. "</button>";
        echo "<div class='card mb-3 comment-card'><div class='card-header'>"; 
        echo $author_tag;
        echo "<button id=\"$iteration_pk\" onClick=\"iteration_button_onclick(this.id)\" style=\"float: right;\">go</button>";
        echo "</div><div class='card-body'>";
        echo "<p>" . $iteration['date_start'] . " - " . $iteration['date_end'];
        echo "</p></div></div>";
    }
}
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
?>
