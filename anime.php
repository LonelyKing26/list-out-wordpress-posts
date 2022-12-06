<?php include('datab.php');
$title = "not found";
if(isset($_GET['id'])){
    $anime_id = $_GET['id'];

    $sql = mysqli_query($conn, "SELECT *, wpic_posts.ID as main_id
    FROM wpic_posts, wpic_users
    WHERE wpic_posts.ID = $anime_id
   ");
   $title_ = mysqli_fetch_assoc($sql);
   $title = $title_['post_title'];
}

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <title><?php echo $title; ?></title>
</head>
<style>
    .thd_anime_title h4{
        border: 1px solid #000;
        padding: 10px;
    }
</style>
<body>
    <?php include('header.php');?>
    
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-lg-9 col-sm-12 col-xs-12">
                <?php
                
                if($_GET['id']){
                    $sql = mysqli_query($conn, "SELECT *, wpic_posts.ID as main_id
                    FROM wpic_posts, wpic_users
                    WHERE wpic_posts.ID = $anime_id
                    ");
                    $post_data = mysqli_fetch_assoc($sql);
                   
                    echo '
                        <div class="thd_anime_title pb-5 text-center">
                        <h4>'.$post_data['post_title'].'</h4>
                        </div>
                        '.$post_data['post_content'].'
                    ';
                }
                else{
                    echo "NOt Found";
                }
            ?>
            </div>
            <div class="col-lg-3 col-sm-12 col-xs-12 mt-5">
                <?php
                
                if($_GET['id']){
                    $query = mysqli_query($conn, "SELECT *, wpic_posts.ID as main_id
                    FROM wpic_posts, wpic_users  
                    WHERE wpic_posts.ID = $anime_id
                    AND wpic_posts.post_author = wpic_users.ID
                    ");
                    $auth_data = mysqli_fetch_assoc($query);
                    $date = date('d-m-Y', strtotime($auth_data['post_date']));
                    echo '<b>Posted by : '.$auth_data['display_name'].'<br>Posted Date : '.$date.'</b>'
                        
                    ;
                }
                
            ?>
            </div>
        </div>
        
    </div>
    <?php include('footer.php');?>

</body>
</html>
