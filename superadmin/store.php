
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
?>
<body>
    <div class="left">
        <img class="superadminstorelogo" src="../resources/foodparklogo.png" alt="hhee">
        <div class="options">
            <ul class="options">
                <li class="options">
                    <a href="overview.php">Overview</a>
                </li>
                <li class="options">
                    <a href="overview.php">Accounts</a>
                </li>
                <li class="options">
                    <a href="overview.php">Sales</a>
                </li>
                <li class="options">
                    <a href="overview.php">Settings</a>
                </li>
                <li class="options logout">
                    <a href="overview.php">Logout</a>
                </li>
            </ul>
            
        </div>
    </div>
    <div class="right">
        <h1>Stores</h1>
        <table id="myTable" class="table storetable stafftable table-hover">
            <?php 
                require_once('../database/datafetch.php');
            ?>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Picture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($stores) {
                    foreach ($stores as $store) {
                ?>  
                <tr>
                    <td><?php echo $store['id']?></td>
                    <td><?php echo $store['name'] ?></td>
                   
                    <td><?php echo $store['description'] ?></td>
                    <td><?php echo $store['status'] ?></td>
                    <td><?php echo $store['pic'] ?></td>
                    <td><div class="action"><a href="staff.php?id=<?php echo $item['id']; ?>"><i class='bx bx-show-alt'></i></a><a href="editstaff.php?id=<?php echo $item['id']; ?>"><i class='bx bx-edit-alt'></i></a></div>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            
            
        </div>
            </form>
        </div>
    </div>
    </div>

</body>
</html>