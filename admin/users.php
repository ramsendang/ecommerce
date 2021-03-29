<?php
require('top.inc.php');

if(isset($_GET['type']) && $_GET['type']!=''){
    if($type == 'delete'){
        $id = get_safe_value($conn, $_GET['id']);
        $delete_staus_sql = "DELETE FROM users WHERE id = '$id'";
        mysqli_query($conn, $delete_staus_sql);
    }
}

$sql = "SELECT * FROM users ORDER BY id   DESC";
$res = mysqli_query($conn, $sql);
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Users</h4>
                    <h4 class="box-link" ><a href="manage_categories.php" style="font-size: .9rem; text-decoration: underline;">Add Categories<a></h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th class="serial">#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>email</th>
                                <th>mobile</th>
                                <th>date</th>
                                <th>delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=1;
                                while($row=mysqli_fetch_assoc($res)){?>
                                    <tr>
                                        <td class="serial"><?php $i?></td>
                                        <td><?php echo $row['id'] ?></td>    
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['mobile'] ?></td>
                                        <td><?php echo $row['added_on'] ?></td>
                                        <td>
                                            <?php
                                                echo "&nbsp&nbsp&nbsp&nbsp<span class='badge badge-pending'><a href='?type=delete&id=".$row['id']."' style='color: black; backgroundcolor: red;'>&nbsp&nbsp&nbspDelete&nbsp&nbsp</a></span>";
                                                
                                            ?>
                                        </td>
                                   </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('footer.inc.php');
?>