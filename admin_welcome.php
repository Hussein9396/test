<?php
session_start();
include("connection.php");
$user = $_SESSION['user'];
$balance = $_SESSION['balance'];
$userID = $_SESSION['ID'];



$sqlFetchUsers = "SELECT * From user";
$resultFetchUsers = mysqli_query($conn, $sqlFetchUsers);
$sqlFetchProducts = "SELECT * From product";
$resultFetchProducts = mysqli_query($conn, $sqlFetchProducts);


$userList = '';
while ($row = mysqli_fetch_assoc($resultFetchUsers)) {
    $userName = $row['Name'];
    $userList .= '<li>' . $userName . ' ----- Balance: ' . number_format($row['Balance'], 2) . '€';
    $userList .= '<button onclick="window.location.href = \'edit_user.php?name=' . $userName . '\'">Edit</button>';
    $userList .= '<button onclick="deleteUser(\'' . $userName . '\')">Delete</button>';
    $userList .= '<button onclick="window.location.href = \'charge_user.php?name=' . $userName . '\'">Charge</button>';
    $userList .= '</li>';
}
$productList = '';
while ($row = mysqli_fetch_assoc($resultFetchProducts)) {
    $productName = $row['Name'];
    $productList .= '<li>' . $productName . ' ----- Price: ' . number_format($row['Price'], 2) . '€';
    $productList .= '<button onclick="window.location.href = \'edit_product.php?name=' . $productName . '\'">Edit</button>';
    $productList .= '<button onclick="deleteProduct(\'' . $productName . '\')">Delete</button>';
    $productList .= '</li>';
}

?>


<head>
    <h1>
        Hello <?php echo $user . ". Your balance is " . number_format($balance, 2) . "€"; ?>.
    </h1>
</head>

<p></p>
<button onclick="navigateTo('admin_welcome.php')">home</button>
<button onclick="navigateTo('add_user.php')">add user</button>
<button onclick="navigateTo('add_product.php')">add product</button>
<button onclick="navigateTo('index.php')"> log out</button>
<button onclick="navigateTo('change_password.php')"> change password</button>


<br><br>

<script>
    function deleteUser($userName) {
        if (confirm("Are you sure you want to delete " + $userName + " ?")) {
            navigateTo("delete_user_process.php?name="+$userName);
        } else {
            alert("deleting process failed !");
        }
    }

    function navigateTo(url) {
        window.location.href = url;
    }
    function deleteProduct($productName){
        if (confirm("Are you sure you want to delete " + $productName + " ?")){
            navigateTo("delete_product_process.php?name=" + $productName);
        } else {
            alert("deleting process failed !");
        }
    }
</script>
<p></p>
<!--
<button onclick="updateBalance(5)">charge 5</button>
<button onclick="updateBalance(10)">charge 10</button>
<button onclick="pay(0.5)">pay 0.5€</button>
<button onclick="setBalanceToZero()">clear</button>
-->

<ul>
    <h3>Users:</h3>
    <?php
    echo $userList;
    echo "<br><br><br>";
    ?>
   <h3>Products:</h3>
    <?php
    echo $productList;
    echo "<br><br><br>";
    ?>
</ul>