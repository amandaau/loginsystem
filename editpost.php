<?php 
    require "header.php"
?>
<main class="container p-4 bg-light mt-3">
    <?php 
        require './includes/connect.inc.php';
        // Strings must be escaped to prevent SQL injection attack.
        $id = mysqli_real_escape_string($conn, $_GET['id']); 
        $id = intval($id);
        //$sql = "SELECT id, title, imageurl ,comment, websiteurl, websitetitle FROM posts";
        $sql = "SELECT title, imageurl ,comment, websiteurl, websitetitle FROM posts WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        //print_r($row);

        if(isset($_GET['error'])){
            if($_GET['error'] == "emptyfields")
            {
                $errorMsg = "Please fill in all fields";
                echo '<div class="alert alert-danger" role="alert">'
                    .$errorMsg.
                '</div>';
            }
        }
    ?>

    <!-- editpost.inc.php - Will process the data from this form-->
    <form action="includes/editpost.inc.php?id=<?php echo $id ?>" method="post">
        <h2>Edit Post</h2>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" placeholder="title" value="<?php echo $row["title"]?>">
        </div>
        <div class="form-group">
            <label for="imageurl">Image URL</label>
            <input type="text" class="form-control" name="imageurl" placeholder="imageurl" value="<?php echo $row["imageurl"]?>">
        </div>
        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea class="form-control" name="comment"  rows="3" placeholder="comment"><?php echo $row["comment"]?></textarea>
        </div>
        <div class="form-group">
            <label for="websiteurl">Website URL</label>
            <input type="text" class="form-control" name="websiteurl" placeholder="website url" value="<?php echo $row["websiteurl"]?>">
        </div>
        <div class="form-group">
            <label for="websitetitle">Website Title</label>
            <input type="text" class="form-control" name="websitetitle" placeholder="website title" value="<?php echo $row["websitetitle"]?>">
        </div>

        <button type="submit" name="edit-submit" class="btn btn-primary w-100">Edit</button>

    </form>
</main>

<?php 
    require "footer.php"
?>