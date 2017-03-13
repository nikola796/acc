<?php require 'partials/header.php' ?>
<h2>Type Your Name</h2>

<form method="post" action="/router/users">

    <input type="text" name="name">

    <button type="submit">Submit</button>


</form>
<?php if(count($users) > 0): ?>
    <h3>Потребители</h3>
    <ul>

        <?php foreach($users as $user): ?>

            <li><?= $user->name; ?></li>

        <?php endforeach ?>

    </ul>
<?php else: ?>

    <h3>Няма създадени потребители</h3>

<?php endif; ?>

<?php require 'partials/footer.php';