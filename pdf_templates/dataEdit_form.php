<?php
require_once("../includes/header.php");
$data = file_get_contents('data.json');
$data = json_decode($data);
if (!empty($_POST)) {
    $edited_data = array(
        "gd_office" => $_POST["gd_office"],
        "gd_street" => $_POST["gd_street"],
        "gd_city" => $_POST["gd_city"],
        "gd_country" => $_POST["gd_country"],
        "gd_postalCode" => $_POST["gd_postalCode"],
        "gd_phone" => $_POST["gd_phone"],
        "gd_email" => $_POST["gd_email"],
        "gd_website" => $_POST["gd_website"],
        "gd_accountName" => $_POST["gd_accountName"],
        "gd_bankName" => $_POST["gd_bankName"],
        "gd_bankStreet" => $_POST["gd_bankStreet"],
        "gd_bankPostal" => $_POST["gd_bankPostal"],
        "gd_bankCity" => $_POST["gd_bankCity"],
        "gd_bankCountry" => $_POST["gd_bankCountry"],
        "gd_bankSwiftCode" => $_POST["gd_bankSwiftCode"],
        "gd_bankIBAN" => $_POST["gd_bankIBAN"],
        "gd_bankBranchCode" => $_POST["gd_bankBranchCode"],
        "gd_bankAccountNumber" => $_POST["gd_bankAccountNumber"],
        "gd_registrationNo" => $_POST["gd_registrationNo"]
    );
    $json_data = json_encode($edited_data);
    file_put_contents('data.json', $json_data);
}
?>
<div class="container vh-100">
    <h1 class="my-5 text-center">PDF Data</h1>
    <div class="row d-flex align-items-center vh-100">
        <form class="d-flex flex-column gap-3" name="pdf_data_form" action="" method="post">
            <div class="form-group">
                <label for="gd_office">Company Office</label>
                <input class="form-control" type="text" value='<?= $data->gd_office ?>' name="gd_street" />
            </div>
            <div class="form-group">
                <label for="gd_street">Company Street</label>
                <input class="form-control" type="text" value='<?= $data->gd_street ?>' name="gd_street" />
            </div>
            <div class="form-group">
                <label for="gd_city">Company City</label>
                <input class="form-control" type="text" value='<?= $data->gd_city ?>' name="gd_city" />
            </div>
            <div class="form-group">
                <label for="gd_country">Company Country</label>
                <input class="form-control" type="text" value='<?= $data->gd_country ?>' name="gd_country" />
            </div>
            <div class="form-group">
                <label for="gd_postalCode">Company Postal Code</label>
                <input class="form-control" type="text" value='<?= $data->gd_postalCode ?>' name="gd_postalCode" />
            </div>
            <div class="form-group">
                <label for="gd_phone">Company Phone Number</label>
                <input class="form-control" type="text" value='<?= $data->gd_phone ?>' name="gd_phone" />
            </div>
            <div class="form-group">
                <label for="gd_email">Company Email</label>
                <input class="form-control" type="text" value='<?= $data->gd_email ?>' name="gd_email" />
            </div>
            <div class="form-group">
                <label for="gd_website">Company Website</label>
                <input class="form-control" type="text" value='<?= $data->gd_website ?>' name="gd_website" />
            </div>
            <div class="form-group">
                <label for="gd_accountNumber">Bank Account Name</label>
                <input class="form-control" type="text" value='<?= $data->gd_accountName ?>' name="gd_accountName" />
            </div>
            <div class="form-group">
                <label for="gd_bankName">Bank Name</label>
                <input class="form-control" type="text" value='<?= $data->gd_bankName ?>' name="gd_bankName" />
            </div>
            <div class="form-group">
                <label for="gd_bankStreet">Bank Street</label>
                <input class="form-control" type="text" value='<?= $data->gd_bankStreet ?>' name="gd_bankStreet" />
            </div>
            <div class="form-group">
                <label for="gd_bankPostal">Bank Postal</label>
                <input class="form-control" type="text" value='<?= $data->gd_bankPostal ?>' name="gd_bankPostal" />
            </div>
            <div class="form-group">
                <label for="gd_bankCity">Bank City</label>
                <input class="form-control" type="text" value='<?= $data->gd_bankCity ?>' name="gd_bankCity" />
            </div>
            <div class="form-group">
                <label for="gd_bankCountry">Bank Country</label>
                <input class="form-control" type="text" value='<?= $data->gd_bankCountry ?>' name="gd_bankCountry" />
            </div>
            <div class="form-group">
                <label for="gd_bankSwiftCode">Bank Swift Code</label>
                <input class="form-control" type="text" value='<?= $data->gd_bankSwiftCode ?>' name="gd_bankSwiftCode" />
            </div>
            <div class="form-group">
                <label for="gd_bankIBAN">Bank IBAN</label>
                <input class="form-control" type="text" value='<?= $data->gd_bankIBAN ?>' name="gd_bankIBAN" />
            </div>
            <div class="form-group">
                <label for="gd_bankBranchCode">Bank Branch Code</label>
                <input class="form-control" type="text" value='<?= $data->gd_bankBranchCode ?>' name="gd_bankBranchCode" />
            </div>
            <div class="form-group">
                <label for="gd_bankAccountNumber">Bank Account Number</label>
                <input class="form-control" type="text" value='<?= $data->gd_bankAccountNumber ?>' name="gd_bankAccountNumber" />
            </div>
            <div class="form-group">
                <label for="gd_registrationNo">Company Registration No.</label>
                <input class="form-control" type="text" value='<?= $data->gd_registrationNo ?>' name="gd_registrationNo" />
            </div>
            <div class="my-5"><button type="submit" class="w-100 btn btn-primary" id="form-btn" name='submit'>Submit</button></div>
        </form>
    </div>
</div>

<?php
require_once("../includes/footer.php");
?>