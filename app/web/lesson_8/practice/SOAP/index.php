<?php

// Создание SOAP-клиента по WSDL-документу
$client = new SoapClient("http://users.bugred.ru/tasks/soap/WrapperSoapServer.php?wsdl");
// Поcылка SOAP-запроса и получение результата
$result = $client->doRegister("test23@test.test", "test23", "test23");
var_dump($result);
