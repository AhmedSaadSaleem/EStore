<?php

namespace PHPMVC\Controllers;

use PHPMVC\Models\SupplierModel;

class TestController extends AbstractController
{

    public function defaultAction(): void
    {

        phpinfo();
        
        // echo str_replace(['-', ':', ' '], '', date('y-m-d H:i:s'));
        //-- settings --//

        //brainboxes serial ports
        //on 'nix start with cu.usbserial-
        //on windows starts with com : must be lower case in windows and end with a colon

        // $portName = 'COM4:';
        // $baudRate = 9600;
        // $bits = 8;
        // $spotBit = 1;

        // header( 'Content-type: text/plain; charset=utf-8' ); 
        // Serial Port Test


        // function echoFlush($string)
        // {
        //     echo $string . "\n";
        //     flush();
        //     ob_flush();
        // }
        
            //the serial port resource
            // $bbSerialPort = '';
            
            // echoFlush(  "Connecting to serial port: {$portName}" );
            
            // $bbSerialPort = fopen($portName, "w+" );

            // var_dump($bbSerialPort);

            // if(!$bbSerialPort)
            // {
            //     echoFlush( "Could not open Serial port {$portName} ");
            //     exit;
            // }
            
            // send data
            // if(isset($_POST['send'])){
            //     $dataToSend = $_POST['data'] ?? '';
            //     echoFlush( "Writing to serial port data: {$dataToSend}" );
            //     fwrite($bbSerialPort, $dataToSend);
                // $recivedData = fread($bbSerialPort, 100);
                // echo $recivedData;
            // }

            // if(isset($_POST['send'])){
            //     $bytesRead = dio_read($bbSerialPort);
            //     echoFlush( "Reading from serial port data: {$bytesRead}" );
            // }
            
            // echoFlush(  "Closing Port" );
            // fclose($bbSerialPort);
//     }
}
}
?>

<!-- <form method="POST">
    <input type="text" name="data" id="data">
    <input type="submit" name="send" value="send">
</form> -->