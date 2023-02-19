<?php
#currency selection check
$currency_arr = array(
    "AFN" => "Afghan Afghani",
    "ALL" => "Albanian Lek",
    "DZD" => "Algerian Dinar",
    "AOA" => "Angolan Kwanza",
    "ARS" => "Argentine Peso",
    "AMD" => "Armenian Dram",
    "AWG" => "Aruban Florin",
    "AUD" => "Australian Dollar",
    "AZN" => "Azerbaijani Manat",
    "BSD" => "Bahamian Dollar",
    "BHD" => "Bahraini Dinar",
    "BDT" => "Bangladeshi Taka",
    "BBD" => "Barbadian Dollar",
    "BYR" => "Belarusian Ruble",
    "BEF" => "Belgian Franc",
    "BZD" => "Belize Dollar",
    "BMD" => "Bermudan Dollar",
    "BTN" => "Bhutanese Ngultrum",
    "BTC" => "Bitcoin",
    "BOB" => "Bolivian Boliviano",
    "BAM" => "Bosnia-Herzegovina Convertible Mark",
    "BWP" => "Botswanan Pula",
    "BRL" => "Brazilian Real",
    "GBP" => "British Pound Sterling",
    "BND" => "Brunei Dollar",
    "BGN" => "Bulgarian Lev",
    "BIF" => "Burundian Franc",
    "KHR" => "Cambodian Riel",
    "CAD" => "Canadian Dollar",
    "CVE" => "Cape Verdean Escudo",
    "KYD" => "Cayman Islands Dollar",
    "XOF" => "CFA Franc BCEAO",
    "XAF" => "CFA Franc BEAC",
    "XPF" => "CFP Franc",
    "CLP" => "Chilean Peso",
    "CNY" => "Chinese Yuan",
    "COP" => "Colombian Peso",
    "KMF" => "Comorian Franc",
    "CDF" => "Congolese Franc",
    "CRC" => "Costa Rican ColÃ³n",
    "HRK" => "Croatian Kuna",
    "CUC" => "Cuban Convertible Peso",
    "CZK" => "Czech Republic Koruna",
    "DKK" => "Danish Krone",
    "DJF" => "Djiboutian Franc",
    "DOP" => "Dominican Peso",
    "XCD" => "East Caribbean Dollar",
    "EGP" => "Egyptian Pound",
    "ERN" => "Eritrean Nakfa",
    "EEK" => "Estonian Kroon",
    "ETB" => "Ethiopian Birr",
    "EUR" => "Euro",
    "FKP" => "Falkland Islands Pound",
    "FJD" => "Fijian Dollar",
    "GMD" => "Gambian Dalasi",
    "GEL" => "Georgian Lari",
    "DEM" => "German Mark",
    "GHS" => "Ghanaian Cedi",
    "GIP" => "Gibraltar Pound",
    "GRD" => "Greek Drachma",
    "GTQ" => "Guatemalan Quetzal",
    "GNF" => "Guinean Franc",
    "GYD" => "Guyanaese Dollar",
    "HTG" => "Haitian Gourde",
    "HNL" => "Honduran Lempira",
    "HKD" => "Hong Kong Dollar",
    "HUF" => "Hungarian Forint",
    "ISK" => "Icelandic KrÃ³na",
    "INR" => "Indian Rupee",
    "IDR" => "Indonesian Rupiah",
    "IRR" => "Iranian Rial",
    "IQD" => "Iraqi Dinar",
    "ILS" => "Israeli New Sheqel",
    "ITL" => "Italian Lira",
    "JMD" => "Jamaican Dollar",
    "JPY" => "Japanese Yen",
    "JOD" => "Jordanian Dinar",
    "KZT" => "Kazakhstani Tenge",
    "KES" => "Kenyan Shilling",
    "KWD" => "Kuwaiti Dinar",
    "KGS" => "Kyrgystani Som",
    "LAK" => "Laotian Kip",
    "LVL" => "Latvian Lats",
    "LBP" => "Lebanese Pound",
    "LSL" => "Lesotho Loti",
    "LRD" => "Liberian Dollar",
    "LYD" => "Libyan Dinar",
    "LTL" => "Lithuanian Litas",
    "MOP" => "Macanese Pataca",
    "MKD" => "Macedonian Denar",
    "MGA" => "Malagasy Ariary",
    "MWK" => "Malawian Kwacha",
    "MYR" => "Malaysian Ringgit",
    "MVR" => "Maldivian Rufiyaa",
    "MRO" => "Mauritanian Ouguiya",
    "MUR" => "Mauritian Rupee",
    "MXN" => "Mexican Peso",
    "MDL" => "Moldovan Leu",
    "MNT" => "Mongolian Tugrik",
    "MAD" => "Moroccan Dirham",
    "MZM" => "Mozambican Metical",
    "MMK" => "Myanmar Kyat",
    "NAD" => "Namibian Dollar",
    "NPR" => "Nepalese Rupee",
    "ANG" => "Netherlands Antillean Guilder",
    "TWD" => "New Taiwan Dollar",
    "NZD" => "New Zealand Dollar",
    "NIO" => "Nicaraguan CÃ³rdoba",
    "NGN" => "Nigerian Naira",
    "KPW" => "North Korean Won",
    "NOK" => "Norwegian Krone",
    "OMR" => "Omani Rial",
    "PKR" => "Pakistani Rupee",
    "PAB" => "Panamanian Balboa",
    "PGK" => "Papua New Guinean Kina",
    "PYG" => "Paraguayan Guarani",
    "PEN" => "Peruvian Nuevo Sol",
    "PHP" => "Philippine Peso",
    "PLN" => "Polish Zloty",
    "QAR" => "Qatari Rial",
    "RON" => "Romanian Leu",
    "RUB" => "Russian Ruble",
    "RWF" => "Rwandan Franc",
    "SVC" => "Salvadoran ColÃ³n",
    "WST" => "Samoan Tala",
    "SAR" => "Saudi Riyal",
    "RSD" => "Serbian Dinar",
    "SCR" => "Seychellois Rupee",
    "SLL" => "Sierra Leonean Leone",
    "SGD" => "Singapore Dollar",
    "SKK" => "Slovak Koruna",
    "SBD" => "Solomon Islands Dollar",
    "SOS" => "Somali Shilling",
    "ZAR" => "South African Rand",
    "KRW" => "South Korean Won",
    "XDR" => "Special Drawing Rights",
    "LKR" => "Sri Lankan Rupee",
    "SHP" => "St. Helena Pound",
    "SDG" => "Sudanese Pound",
    "SRD" => "Surinamese Dollar",
    "SZL" => "Swazi Lilangeni",
    "SEK" => "Swedish Krona",
    "CHF" => "Swiss Franc",
    "SYP" => "Syrian Pound",
    "STD" => "São Tomé and Príncipe Dobra",
    "TJS" => "Tajikistani Somoni",
    "TZS" => "Tanzanian Shilling",
    "THB" => "Thai Baht",
    "TOP" => "Tongan pa'anga",
    "TTD" => "Trinidad & Tobago Dollar",
    "TND" => "Tunisian Dinar",
    "TRY" => "Turkish Lira",
    "TMT" => "Turkmenistani Manat",
    "UGX" => "Ugandan Shilling",
    "UAH" => "Ukrainian Hryvnia",
    "AED" => "United Arab Emirates Dirham",
    "UYU" => "Uruguayan Peso",
    "USD" => "US Dollar",
    "UZS" => "Uzbekistan Som",
    "VUV" => "Vanuatu Vatu",
    "VEF" => "Venezuelan BolÃ­var",
    "VND" => "Vietnamese Dong",
    "YER" => "Yemeni Rial",
    "ZMK" => "Zambian Kwacha",
);
?>
<div class="form-group">
    <label for="client_name">Client Name</label>
    <input class="form-control" type="text" value="<?= $is_edit ? $invoice_data["invoice_receiver_name"] : "" ?>" id="client_name" name="client_name" placeholder="Enter Client Name" required />
</div>
<div class="form-group">
    <label for="company_name">Client Company</label>
    <input class="form-control" type="text" id="company_name" value="<?= $is_edit ? $invoice_data["invoice_receiver_company"] : "" ?>" name="company_name" placeholder="Enter Company Name" required />
</div>
<div class="form-group">
    <label for="client_street">Client Street</label>
    <input class="form-control" type="text" id="client_street" value="<?= $is_edit ? $invoice_data["invoice_receiver_street"] : "" ?>" name="client_street" placeholder="Enter Client Street Address" required />
</div>
<div class="form-group">
    <label for="client_city">Client City</label>
    <input class="form-control" type="text" id="client_city" value="<?= $is_edit ? $invoice_data["invoice_receiver_city"] : "" ?>" name="client_city" placeholder="Enter Client city Address" required />
</div>
<div class="form-group">
    <label for="client_state">Client State</label>
    <input class="form-control" type="text" id="client_state" name="client_state" value="<?= $is_edit ? $invoice_data["invoice_receiver_state"] : "" ?>" placeholder="Enter Client state Address" required />
</div>
<div class="form-group">
    <label for="client_country">Client Country</label>
    <input class="form-control" type="text" id="client_country" name="client_country" value="<?= $is_edit ? $invoice_data["invoice_receiver_country"] : "" ?>" placeholder="Enter Client country Address" required />
</div>
<div class="form-group">
    <label for="client_zipcode">Client Zipcode</label>
    <input class="form-control" minlength="4" maxlength="10" type="text" id="client_zipcode" name="client_zipcode" value="<?= $is_edit ? $invoice_data["invoice_receiver_zip"] : "" ?>" placeholder="Enter Client zipcode Address" required />
</div>
<label for="invoice_currency">Select Currency</label>
<select class="form-select" aria-label="Default select example" id="invoice_currency" name="invoice_currency">
    <?= !$is_edit ? "<option selected>select currency</option>" : "<option>select currency</option>" ?>
    <?php
    foreach ($currency_arr as $symbol => $name) :
        if ($is_edit && $symbol == $invoice_data['invoice_currency'])
            echo '<option value="' . $symbol . '" selected>' . $name . ' (' . $symbol . ')' . '</option>';
        else
            echo '<option value="' . $symbol . '">' . $name . '</option>';
    endforeach;
    ?>
</select>
<div class="form-group">
    <label for="due_date">Invoice Due</label>
    <input class="form-control" type="date" id="due_date" value="<?= $is_edit ? date("Y-m-d", $due_date) : "" ?>" name="due_date" placeholder="Select Due Date" required />
    <div>
        <h2 class="mt-3">Details:</h2>
        <table border="1" id='dataTable' class="table table-striped">
            <thead>
                <tr>
                    <th>
                        Description
                    </th>
                    <th>
                        Hours
                    </th>
                    <th>
                        Hourly Rate
                    </th>
                    <th>
                        Amount
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if ($is_edit) :
                ?>
                    <?php
                    if (count($invoice_items_data) == 0) : ?>
                        <tr>
                            <td>
                                <input class="form-control" type="text" name="desc[]" required>
                            </td>
                            <td>
                                <input class="form-control" type="number" name="hours[]" required>
                            </td>
                            <td>
                                <input class="form-control" type="number" name="hr_rate[]" required>
                            </td>
                            <td>
                                <input class="form-control" type="number" name="amount[]" required>
                            </td>
                        </tr>
                    <?php
                    endif;
                    foreach ($invoice_items_data as $item) :
                    ?>
                        <tr>
                            <td>
                                <input value="<?= $item[2] ?>" class="form-control" type="text" name="desc[]" required>
                            </td>
                            <td>
                                <input value="<?= $item[3] ?>" class="form-control" type="number" name="hours[]" required>
                            </td>
                            <td>
                                <input value="<?= $item[4] ?>" class="form-control" type="number" name="hr_rate[]" required>
                            </td>
                            <td>
                                <input value="<?= $item[5] ?>" class="form-control" type="number" name="amount[]" required>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                <?php
                else :
                ?>
                    <tr>
                        <td>
                            <input class="form-control" type="text" name="desc[]" required>
                        </td>
                        <td>
                            <input class="form-control" type="number" name="hours[]" required>
                        </td>
                        <td>
                            <input class="form-control" type="number" name="hr_rate[]" required>
                        </td>
                        <td>
                            <input class="form-control" type="number" name="amount[]" required>
                        </td>
                    </tr>
                <?php
                endif;
                ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-end gap-3">
            <input type="button" class="btn btn-success" value="Add Row" onClick="addRow('dataTable')" />
            <input type="button" class="btn btn-danger" value="Delete Row" onClick="deleteRow('dataTable')" />
        </div>
        <div class="my-5"><button type="submit" class="w-100 btn btn-primary" id="form-btn" name='submit'>Submit</button></div>
    </div>


    <script>
        //Functions for adding and deleting rows in invoice
        function addRow(tableID) {
            let table = document.getElementById(tableID);
            let rowCount = table.rows.length;
            let row = table.insertRow(rowCount);
            let colCount = table.rows[1].cells.length;
            for (let i = 0; i < colCount; i++) {
                let newcell = row.insertCell(i);
                newcell.innerHTML = table.rows[1].cells[i].innerHTML;
            }
        }

        function deleteRow(tableID) {
            let table = document.getElementById(tableID);
            let rowCount = table.rows.length;
            // greater than 2 because there is a row as header row 
            // and we want to have only one row at least below this 
            // header row
            if (rowCount > 2) {
                table.deleteRow(rowCount - 1)
            };
        }
    </script>