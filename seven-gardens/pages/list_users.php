<?php
require_once '../config.php';
require_once '../pages/components/header.php';
require_once '../src/database/users.php';

$users = list_users_from_db($conn);
?>
<div class="container">
    <div class="row">
        <h1>Listar Usúarios</h1>
<!--        <a class="btn btn-success text-white" href="./create.php">New</a>-->
    </div>
    <div class="row flex-center">
<!--        --><?php //if(isset($_GET['message'])) echo(printMessage($_GET['message'])); ?>
    </div>
    <table class="table-users">
        <tr>
            <th>id</th>
            <th>NAME</th>


        </tr>
        <?php foreach($users as $row): ?>
            <tr>
                <td class="user-id"><?=htmlspecialchars($row['id'])?></td>
                <td class="user-name"><?=htmlspecialchars($row['name'])?></td>

<!--                <td>-->
<!--                    <a class="btn btn-primary text-white" href="./edit.php?id=--><?php //=$row['id']?><!--">Edit</a>-->
<!--                </td>-->
<!--                <td>-->
<!--                    <a class="btn btn-danger text-white" href="./delete.php?id=--><?php //=$row['id']?><!--">Remove</a>-->
<!--                </td>-->
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php require_once '../pages/components/footer.php'; ?>
