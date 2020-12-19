<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JS Daily Task</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body{
            background:#FAFCF7; 
            font-family: 'Inter', sans-serif; 
        }
        .mlr-auto {
            margin-left: auto;
            margin-right: auto;
        }
        .title{
            font-size:30px;
            color:#000; 
            font-weight:bold;  
            margin-bottom:0;  
        }
        .table-wrapper thead th {
            border-bottom: 4px solid #ddd !important;
            padding: 10px 20px;
        }
        .table-wrapper tbody td {
            border-bottom: 1px solid #ddd !important;
            padding: 17px 20px; 
            vertical-align: middle;
        }
        .table-wrapper tbody tr:last-child td {
            border-bottom: none !important;
        }
        .table { 
            margin-bottom: 0;
        }
        .table-wrapper { 
            background: #fff;
            border: 1px solid #ddd;
        }
        .table tr{
            transition:all 0.25s;  
        }
        .table tr:hover { 
            background: #fff !important;  
            box-shadow: 0 10px 23px 0 rgba(109, 134, 149, 0.16);
        }
        .mr-auto{
            margin-right:auto; 
        }
        .form-select {
            margin-right: 20px;
        }
        .logo{
            font-family: 'Abril Fatface', cursive; 
        }
    </style>
</head>
<body>
<?php
    require_once "inc/config.php";  

    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
    if(!$connect){
        throw new Exception("Can't connect to database");
    }else{
        $query = "SELECT * FROM js_task WHERE complete = 0";   
        $result = mysqli_query($connect,$query); 
        
    }
    
?>
    <div class="container pt-5 pb-5">
        <div class="mb-5 text-center"><h2 class="logo">JS TASK</h2></div> 
        <div class="row mb-5 pt-4">
            <div class="col-lg-10 mlr-auto">
                <div class="d-flex align-items-center mb-4">  
                    <h2 class="title mr-auto">Upcoming Task</h2> 
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Task</button>
                </div>
                <?php if (mysqli_num_rows($result) == 0) { ?>
                    <p>Not Result Found</p>
                <?php }else{ ?>
                <div class="table-wrapper"> 
                    <table class="table"> 
                        <thead>
                            <tr>
                                <th width="30px">Check</th>  
                                <th>Id</th> 
                                <th>Task</th>
                                <th>Date</th>
                                <th width="200px">Action</th>  
                            </tr>
                        </thead>
                        <tbody> 
                            <?php while ($data = mysqli_fetch_assoc($result)) {
                                $timestamp = strtotime($data['date']); 
                                $date = date("jS, M, Y", $timestamp);
                            ?>
                                <tr>
                                    <td> 
                                        <input class="form-check-input" type="checkbox" value="<?php echo $data['id']; ?>">
                                    </td>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['task']; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><a href="#">Delete</a> | <a href="#" data-taskid="<?php echo $data['id']; ?>">Complete</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex mt-4 col-5">
                    <select class="form-select">
                        <option selected>With Select</option>
                        <option value="Deletebulk">Delete</option>
                        <option value="completebulk">Mark Complete</option>
                    </select>
                    <input type="submit" class="btn btn-secondary" value="Submit"> 
                </div>
                <?php } ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-10 mlr-auto"> 
                <div class="d-flex align-items-center mb-4">  
                    <h2 class="title mr-auto">Complete Task</h2>
                </div>
                <div class="table-wrapper"> 
                    <table class="table"> 
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Task</th>
                                <th>Date</th>
                                <th width="200px">Action</th>  
                            </tr>
                        </thead>
                        <tbody> 
                            <tr>
                                <td>#</td>
                                <td>Lorem ipsum dolor sit amet consectetur</td>
                                <td>10th Des 2020</td>
                                <td><a href="#">Delete</a> | <a href="#">Incomplete</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>

    <!-- MODAL -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="inc/task.php" method="post">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" id="exampleFormControlInput1" placeholder="Date">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Task Details</label>
                    <textarea class="form-control" name="task" id="exampleFormControlTextarea1" rows="3" placeholder="Task Details"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <input type="hidden" name="action" value="add"> 
        </form>
        </div>
    </div>
    </div>
    <script src="js/popper.min.js"></script> 
    <script src="js/bootstrap.min.js"></script>
</body>
</html>