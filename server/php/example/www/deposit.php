<?php

/* 
 * This example script implements the EnvayaSMS API. 
 *
 * It sends an auto-reply to each incoming message, and sends outgoing SMS
 * that were previously queued by example/send_sms.php .
 *
 * To use this file, set the URL to this file as as the the Server URL in the EnvayaSMS app.
 * The password in the EnvayaSMS app settings must be the same as $PASSWORD in config.php.
 */

require_once dirname(__DIR__)."/config.php";
require_once dirname(dirname(__DIR__))."/EnvayaSMS.php";

$request = EnvayaSMS::get_request();

header("Content-Type: {$request->get_response_type()}");

if (!$request->is_validated($PASSWORD))
{
    header("HTTP/1.1 403 Forbidden");
    error_log("Invalid password");    
    echo $request->render_error_response("Invalid password");
    return;
}

$action = $request->get_action();

switch ($action->type)
{
    case EnvayaSMS::ACTION_INCOMING:    
        
        $con = mysqli_connect('localhost', 'root', '', 'db_smm');

        if ($action->from == '858' AND preg_match('/Anda mendapatkan penambahan pulsa/', $action->message)) {

            $query = mysqli_query($con, "SELECT * FROM tb_deposit WHERE status = 'PENDING'");

            while ($result = mysqli_fetch_array($query)) {

                $deposit_id = $result['deposit_id'];
                $from_number = $result['from_number'];
                $query2 = mysqli_query($con, "SELECT * FROM tb_deposit WHERE from_number = '$from_number' AND deposit_id = '$deposit_id'");

                while ($result2 = mysqli_fetch_array($query2)) {

                    $deposit_id2 = $result2['deposit_id'];
                    $user_id = $result2['user_id'];
                    $from_number2 = $result2['from_number'];
                    $total_deposit = $result2['total_deposit'];
                    $total_balance = $result2['total_balance'];

                    $check = preg_match("/Anda mendapatkan penambahan pulsa Rp $total_deposit dari nomor $from_number2/", $action->message);
                    
                    if ($check == TRUE) {

                        mysqli_query($con, "UPDATE tb_users SET balance = balance + $total_balance WHERE user_id = '$user_id'");
                        mysqli_query($con, "UPDATE tb_deposit SET status = 'SUCCESS' WHERE deposit_id = '$deposit_id2'");

                    }              
                }
            }
        }

        return;
}