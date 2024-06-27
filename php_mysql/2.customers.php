<?php

include('./1.mysql.php');


$customers = $mysql->query("SELECT * FROM customers limit 5 offset 10");

// $count = $mysql->query("SELECT COUNT(*) as count from customers");

// echo $count->fetch_object()->count / 5;

$detail = (object) [];
if(isset($_GET['customer_id'])){
    $customer_id = $_GET['customer_id'];
    $customer_detail = $mysql->query("SELECT * from customers WHERE id = '$customer_id'");

    $detail = $customer_detail->fetch_object();
}
?>
<?php if(isset($_SESSION['sms']) && $_SESSION['sms'] != ''){ ?>
    <div style="padding:10px; font-size: 25px; background-color:blue; color: white;">
        <?php echo $_SESSION['sms'] ?>
    </div>
    <?php $_SESSION['sms'] = ''; ?>
<?php }?>

<?php if(!isset($_GET['customer_id'])) { ?>
    <!-- create customer  -->
    <div style="width:50%; float: left; zoom:1.2; background-color: grey; padding: 20px; box-sizing:border-box;">
        <h2>Create Customer</h2>
        <form action="./6.insert_customer.php" method="POST" style="zoom:2;">
            <label>Name</label> <br>
            <input type="text" name="name"> <br>

            <label>Phone</label> <br>
            <input type="text" name="phone"> <br>

            <label>Address</label> <br>
            <input type="text" name="address"> <br>

            <br><button>Submit</button>
        </form>
    </div>
<?php  } else { ?>
    <!-- edit customer  -->
    <div style="width:50%; float: left; zoom:1.2; background-color: pink; padding: 20px; box-sizing:border-box;">
        <h2>Edit Customer</h2>
        <form action="./4.update_customer.php" method="POST" style="zoom:2;">
            <input type="hidden" name="customer_id" value="<?php echo $detail->id; ?>">
            <label>Name</label> <br>
            <input type="text" name="name"  value="<?php echo $detail->name; ?>"> <br>

            <label>Phone</label> <br>
            <input type="text" name="phone"  value="<?php echo $detail->phone; ?>"> <br>

            <label>Address</label> <br>
            <input type="text" name="address"  value="<?php echo $detail->address; ?>"> <br>

            <br><button>Submit</button>
        </form>
    </div>
<?php }?>

<!-- customer list  -->
<div style="width:50%; float: right; zoom:1.5; background-color: yellow; padding: 20px; box-sizing:border-box; height:100%;">
    <h2>List Of Customers</h2>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php while($customer = $customers->fetch_object()){ ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $customer->name; ?></td>
                    <td><?php echo $customer->phone; ?></td>
                    <td><?php echo $customer->address; ?></td>
                    <td>
                        <a href="./3.edit_customer.php?customer_id=<?php echo $customer->id; ?>">Edit Form <?php echo $customer->id; ?></a> <br>
                        <a href="./2.customers.php?customer_id=<?php echo $customer->id; ?>">Edit View <?php echo $customer->id; ?></a> <br>
                        <a href="./5.delete_customer.php?customer_id=<?php echo $customer->id; ?>">Delete <?php echo $customer->id; ?></a> <br>
                    </td>
                </tr>   
                <?php  $i++; ?>
            <?php } ?>
        </tbody>
    </table>
</div>