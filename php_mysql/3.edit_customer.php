<?php
include('./1.mysql.php');

$customer_id = $_GET['customer_id'];

$customer_detail = $mysql->query("SELECT * from customers WHERE id = '$customer_id'");

$customer = $customer_detail->fetch_object();

?>

<a href="./2.customers.php" style="font-size: 30px;">Back to Customer Page</a>
<form action="./4.update_customer.php" method="POST" style="zoom:2;">
    <input type="hidden" name="customer_id" value="<?php echo $customer->id; ?>" readonly>
    <label>Name</label> <br>
    <input type="text" name="name" value="<?php echo $customer->name; ?>"> <br>

    <label>Phone</label> <br>
    <input type="text" name="phone" value="<?php echo $customer->phone; ?>"> <br>

    <label>Address</label> <br>
    <input type="text" name="address" value="<?php echo $customer->address; ?>"> <br>

    <br><button>Submit</button>
</form>