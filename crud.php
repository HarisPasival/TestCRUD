<?php
session_start();
include('conn.php');

if(isset($_POST['save_cus']))
{
    $name_ct = $_POST['name_ct'];
    $surname_ct = $_POST['surname_ct'];
    $phone_ct = $_POST['phone_ct'];
    $email_ct = $_POST['email_ct'];
    $adress_ct = $_POST['adress_ct'];

    $query = "INSERT INTO customer(name_ct,surname_ct,phone_ct,email_ct,adress_ct) VALUES(:name_ct,:surname_ct,:phone_ct,:email_ct,:adress_ct)";
    $query_run = $conn->prepare($query);

    $data = [
        ':name_ct' => $name_ct,
        ':surname_ct' => $surname_ct,
        ':phone_ct' => $phone_ct,
        ':email_ct' => $email_ct,
        ':adress_ct' => $adress_ct
    ];
    $query_execute = $query_run->execute($data);

    if($query_execute)
    {
        $_SESSION['message'] = "เพิ่มข้อมูลสำเร็จ";
        header('Location: Add_Cus.php');
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "เพิ่มข้อมูลไม่สำเร็จ";
        header('Location: Add_Cus.php');
        exit(0);
    }
}

if(isset($_POST['edit_cus'])){
    $customer_id = $_POST['customer_id'];
    $name_ct = $_POST['name_ct'];
    $surname_ct = $_POST['surname_ct'];
    $phone_ct = $_POST['phone_ct'];
    $email_ct = $_POST['email_ct'];
    $adress_ct = $_POST['adress_ct'];

    try{
        $query = "UPDATE customer SET name_ct = :name_ct, surname_ct = :surname_ct, phone_ct = :phone_ct, email_ct = :email_ct, adress_ct = :adress_ct WHERE customer_id = :customer_id";
        $stmt = $conn->prepare($query);

        $data = [
            ':name_ct' => $name_ct,
            ':surname_ct' => $surname_ct,
            ':phone_ct' => $phone_ct,
            ':email_ct' => $email_ct,
            ':adress_ct' => $adress_ct,
            ':customer_id' => $customer_id
        ];
        $query_execute = $stmt->execute($data);
        if($query_execute){
            $_SESSION['message'] = "แก้ไขข้อมูลสำเร็จ";
            header('Location: index.php');
            exit(0);
        }
        else{
            $_SESSION['message'] = "แก้ไขข้อมูลไม่สำเร็จ";
            header('Location: index.php');
            exit(0);
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>