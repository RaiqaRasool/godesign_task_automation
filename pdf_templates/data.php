<?php
$jsonData = file_get_contents('data.json');
$data = json_decode($jsonData);
#address
$gd_street = $data->gd_street;
$gd_city = $data->gd_city;
$gd_country = $data->gd_country;
$gd_postalCode = $data->gd_postalCode;

#contact
$gd_phone = $data->gd_phone;
$gd_email = $data->gd_email;
$gd_website = $data->gd_website;

#account details
$gd_accountName = $data->gd_accountName;
$gd_bankName = $data->gd_bankName;
$gd_bankStreet = $data->gd_bankStreet;
$gd_bankPostal = $data->gd_bankPostal;
$gd_bankCity = $data->gd_bankCity;
$gd_bankCountry = $data->gd_bankCountry;

$gd_bankSwiftCode = $data->gd_bankSwiftCode;
$gd_bankIBAN = $data->gd_bankIBAN;
$gd_bankBranchCode = $data->gd_bankBranchCode;
$gd_bankAccountNumber = $data->gd_bankAccountNumber;

#registration no.
$gd_registrationNo = $data->gd_registrationNo;
