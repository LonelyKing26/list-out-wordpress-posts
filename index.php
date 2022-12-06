<?php include('datab.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>mywp Database</title>
</head>
<header>
    <?php include('header.php');?>
</header>
<body>
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-sm">
                <div class="table-wrap">
                    <table id="mywp_dataTable" class="table table-striped table-hover w-100 display">
                        <thead>
                            <tr>
                                <th>Post</th>
                                <th>Title</th>
                                <th>Posted by</th>
                                <th>Date</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = mysqli_query($conn, "SELECT *, wpic_posts.ID as main_id
                                FROM wpic_posts, wpic_users
                                WHERE wpic_posts.post_status = 'publish'
                                AND wpic_posts.post_author = wpic_users.ID
                                AND wpic_posts.post_type = 'post'
                                
                                ");
                                while($mywp_data = mysqli_fetch_assoc($sql)){
                            ?>
                            <tr style="cursor:pointer;" onclick="window.location ='<?php $root;?>anime/<?php echo $mywp_data['main_id'];?>/<?php echo $mywp_data['post_name'];?>'">
                                <th><?php echo $mywp_data['main_id'];?></th>
                                <th style="color: blue;"><?php echo $mywp_data['post_title'];?></th>
                                <th style="color:red;"><?php echo $mywp_data['display_name'];?></th>
                                <th><?php echo date('d-m-Y', strtotime($mywp_data['post_date']));?></th>
                            </tr>
                            <?php };?>
                        </tbody>
                        <tfoot>
                        <tr>
                                <th>Post No.</th>
                                <th>Title</th>
                                <th>Posted by</th>
                                <th>date</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include('footer.php');?>
<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Datatables -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<!-- Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('#mywp_dataTable').DataTable({
            order: [[0, 'desc']],
        });
    });
</script>
</body>
</html>