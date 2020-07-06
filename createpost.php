<?php 
    require "header.php"
?>
<main class="container p-4 bg-light mt-3">
    <?php
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
    <!-- createpost.inc.php - Will process the data from this form-->
    <form action="includes/createpost.inc.php" method="post">
        <h2>Create Post</h2>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" placeholder="title" value="">
        </div>
        <div class="form-group">
            <label for="imageurl">Image URL</label>
            <input type="text" class="form-control" name="imageurl" placeholder="imageurl" value="">
        </div>
        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea class="form-control" name="comment"  rows="3" placeholder="comment"></textarea>
        </div>
        <div class="form-group">
            <label for="websiteurl">Website URL</label>
            <input type="text" class="form-control" name="websiteurl" placeholder="website url" value="">
        </div>
        <div class="form-group">
            <label for="websitetitle">Website Title</label>
            <input type="text" class="form-control" name="websitetitle" placeholder="website title" value="">
        </div>

        <button type="submit" name="post-submit" class="btn btn-primary w-100">Post</button>

    </form>
</main>

<?php 
    require "footer.php"
?>