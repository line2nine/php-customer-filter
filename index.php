<?php
$customerList = array(
    "1" => array("ten" => "Nguyen Van An", "ngaysinh" => "01/01/1990", "diachi" => "Ha Noi", "anh" => "1.jpg"),
    "2" => array("ten" => "Tran Thi Be", "ngaysinh" => "01/12/2015", "diachi" => "Ha Noi", "anh" => "2.jpg"),
    "3" => array("ten" => "Truong Doan Hoa", "ngaysinh" => "15/06/1944", "diachi" => "Ha Noi", "anh" => "3.jpg"),
    "4" => array("ten" => "Duong Du", "ngaysinh" => "31/01/2019", "diachi" => "Ha Noi", "anh" => "4.jpg"),
    "5" => array("ten" => "Kieu Manh Linh", "ngaysinh" => "01/08/1980", "diachi" => "Ha Noi", "anh" => "5.jpg")
);
function searchByDate($customers, $from_date, $to_date)
{
    if (empty($from_date) && empty($to_date)) {
        return $customers;
    }
    $filtered_customers = [];
    foreach ($customers as $customer) {
        if (!empty($from_date) && (strtotime($customer['ngaysinh']) < strtotime($from_date)))
            continue;
        if (!empty($to_date) && (strtotime($customer['ngaysinh']) > strtotime($to_date)))
            continue;
        $filtered_customers[] = $customer;
    }
    return $filtered_customers;
}

$from_date = Null;
$to_date = Null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST["from"];
    $to_date = $_POST["to"];
}
$filtered_customers = searchByDate($customerList, $from_date, $to_date);
?>
<html lang="en">
<head>
    <title>
        Customer Filter
    </title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border-bottom: 1px solid black;
            text-align: left;
        }

        .image {
            height: 60px;
            width: 80px;
            overflow: hidden;
        }

        .image img {
            width: 100%;
        }
    </style>
</head>
<body>
<form method="post">
    From: <input id="from" type="text" name="from" placeholder="dd/mm/yyyy"
                 value="<?php echo isset($from_date) ? $from_date : ''; ?>"/>
    To: <input id="to" type="text" name="to" placeholder="dd/mm/yyyy"
               value="<?php echo isset($to_date) ? $to_date : ''; ?>"/>
    <input type="submit" id="submit" value="Search"/>
</form>
<h1>Customer List</h1>
<table>
    <thead>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày Sinh</th>
        <th>Địa Chỉ</th>
        <th>Ảnh</th>
    </tr>
    <tbody>
    <?php
    foreach ($filtered_customers as $key => $value) {
        echo "<tr>";
        echo "<td>" . $key . "</td>";
        echo "<td>" . $value["ten"] . "</td>";
        echo "<td>" . $value["ngaysinh"] . "</td>";
        echo "<td>" . $value["diachi"] . "</td>";
        echo "<td><div class='image'><img src=" . $value["anh"] . " " . "</div></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
    </thead>

</table>
</body>
</html>