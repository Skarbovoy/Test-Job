<?php
//TESTING
/**
 * Created by JetBrains PhpStorm.
 * User: staff
 * Date: 7/17/13
 * Time: 7:07 AM
 */

?>

<?php require_once('MPDF57/mpdf.php'); ?>

<?php

function get_domain_name()
{
    $serverName = $_SERVER['SERVER_NAME'];
    // get last two segments of host name
    preg_match('/[^.]+\.[^.]+$/', $serverName, $matches);
    return $matches[0];
}

function get_string_between($string, $start, $end)
{
    $string = " " . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;

    return substr($string, $ini, $len);
}


$orderId = strip_tags($_GET['order_id']);
$orderNumber = strip_tags($_GET['order_number']);
$orderPass = strip_tags($_GET['order_pass']);

$html = file_get_contents('http://www.domain.lt/naujas/index.php?option=com_virtuemart&view=invoice&layout=invoice&format=html&tmpl=component&virtuemart_order_id=' . $orderId . '&order_number=' . $orderNumber . '&order_pass=' . $orderPass);
$data = get_string_between($html, '<div id="WWMainPage">', '</div>');

if (strpos($data, 'anuliuotas') == false)
{
    $pdf = new mPDF();
    $pdf->WriteHTML($html);
    $pdf->Output('uploads/' . date("Y_m_d_H_i_s") . '_' . $orderId . '_' . $orderNumber .'.pdf');
}




?>
