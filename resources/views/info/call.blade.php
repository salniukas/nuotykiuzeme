@extends('layouts.app')
@php
    require_once ('database.php');
    require_once('WebToPay.php');
     
    try {
        $response = WebToPay::checkResponse($_GET, array(
            'projectid'     => 91781,
            'sign_password' => 'a6c3c6da1dcdb03db03585d453d1d9b2',
        ));
     
        if ($response['test'] !== '0') {
            throw new Exception('Testing, real payment was not made');
        }
        if ($response['type'] !== 'macro') {
            throw new Exception('Only macro payment callbacks are accepted');
        }
     
        $orderId = $response['orderid'];
        $amount = $response['amount'];
        $currency = $response['currency'];

        $sql = $conn->query("UPDATE orders SET approved='done' WHERE id=$orderId");
     
        echo 'OK';
    } catch (Exception $e) {
        echo get_class($e) . ': ' . $e->getMessage();
    }
@endphp