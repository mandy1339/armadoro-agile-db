
<?php ini_set('display_errors', 1); ?>
<?php include(realpath($_SERVER["DOCUMENT_ROOT"]) . '/service/session.php'); ?>
<?php $_SESSION['page'] = 'TASK DASHBOARD'; ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/header.php');?>
<head><title>TASK DASHBOARD</title></head>
<?php $e_id = $_SESSION['e_id']; ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/view/task_dashboard/task_dashboard.php');?>


<br>
<!-- ADD PROJECT SECTION/////////////////////////// -->
<!-- ////////////////////////////////////////////// -->
<div class="container">
<div class="row well">

<!-- LEFT SIDE FOR TASKS PER PROJECT -->
<div id="toledo-left" class="col-md-6">
    <h3>Tasks per project</h3>
    <div class="toledo-dash-long well pre-scrollable">


        <form action="/view/task_dashboard" method="GET">
            <div class="form-group">
                <label for="submit1">Select project to view tasks:</label>
                <!-- Project ID -->
                <div class="form-group">
                    <select class="form-control" id="sel1" name="project_id">
                        <?php populate_projects($e_id)?>
                    </select>
                    <input id="submit1" type="submit" value="View Tasks">
                </div>
                <div class="card-body">
                    <?php if(isset($_GET['project_id'])) { show_all_tasks_for_project($_GET['project_id']); } ?>
                </div>
            </div>
        </form>

        
    </div>
</div>


<?php 
if($_SESSION['e_role'] == 'DEV') {
    echo show_right($e_id);
}
?>


</div>
</div>

<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>

<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>