<?php
require "header.php"
?>
<main class="container mt-3 pt-2 bg-light">

    <?php
    require './includes/connect.inc.php';
    $sql = "SELECT id, title, imageurl ,comment, websiteurl, websitetitle FROM posts";
    $result = mysqli_query($conn, $sql);
    ?>


    <?php
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $output = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $output .=
                '
        <div class="card border-0 mt-3" id="' . $row["id"] . '">
            <img src="' . $row["imageurl"] . '" class="card-img-top post-image" alt="' . $row["title"] . '">
            <div class="card-body">
                <h5 class="card-title">' . $row["title"] . '</h5>
                <p class="card-text">' . $row["comment"] . '</p>
                <a href="' . $row["websiteurl"] . '" class="btn btn-primary w-100">' . $row["websitetitle"] . '</a>';

            if (isset($_SESSION['userId'])) {

                $output .= '<div class="admin-btn">
                    <a href="editpost.php?id=' . $row["id"] . '" class="btn btn-secondary mt-2">edit</a>';
                $output .= '
                    <a href="includes/deletepost.inc.php?id=' . $row["id"] . '" class="btn btn-danger mt-2">delete</a>
                    </div>';
            }

            $output .=
                '
            </div>
        </div>
        ';
        }
        echo $output;
    } else {
        echo "0 results";
    }

    mysqli_close($conn);

    ?>
</main>
<?php
require "footer.php"
?>