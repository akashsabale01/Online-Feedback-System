<?php include 'inc/header.php' ?>

<?php
$sql = 'SELECT * FROM feedback';
$result = mysqli_query($conn, $sql);
$feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<h2>Details</h2>

<?php if (empty($feedback)) : ?>
    <p class="lead mt-3">There is no feedback</p>
<?php endif; ?>

<div class="card-body text-white bg-dark mt-3 mb-3 rounded  " style="background-image: linear-gradient(to right, #434343 0%, black 100%);">
    <h5 class="card-title mt-0 card-title ">Total Attendees</h5>
    <h4 class="card-text mt-3 mb-3 text-center">
    </h4>
    <?php
    if ($total_attendees = mysqli_num_rows($result)) {
        echo '<h4 class="card-text mt-3 mb-3 text-center">' . $total_attendees  . '
            </h4>';
    } else {
        echo '<h4 class="card-text mt-3 mb-3 text-center"> No Data Found
            </h4>';
    }

    ?>
</div>

<table class="table table-hover table-striped table-bordered">
    <thead>
        <tr class="table-dark">
            <th scope="col">Name</th>
            <th scope="col">Date Attended</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($feedback as $item) : ?>
            <tr>
                <td><?php echo $item['name']; ?> </td>
                <td><?php echo $item['date_attended']; ?></td>
                <td><?php echo $item['phoneNo']; ?> </td>
                <td><?php echo $item['email']; ?> </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'inc/footer.php' ?>