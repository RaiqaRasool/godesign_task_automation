<div class="form-group">
    <label for="client_name">Client Name</label>
<input class="form-control" type="text" id="client_name"  name="client_name" placeholder="Enter Client Name" required />
</div>
<div class="form-group">
    <label for="company_name">Client Company</label>
<input class="form-control" type="text" id="company_name" name="company_name" placeholder="Enter Company Name" required />
</div>
<div class="form-group">
    <label for="client_street">Client Street</label>
<input class="form-control" type="text" id="client_street"  name="client_street" placeholder="Enter Client Street Address" required />
</div>
<div class="form-group">
    <label for="client_city">Client City</label>
<input class="form-control" type="text" id="client_city"  name="client_city" placeholder="Enter Client city Address" required />
</div>
<div class="form-group">
    <label for="client_state">Client State</label>
<input class="form-control" type="text" id="client_state" name="client_state" placeholder="Enter Client state Address" required />
</div>
<div class="form-group">
    <label for="client_country">Client Country</label>
<input class="form-control" type="text" id="client_country"  name="client_country" placeholder="Enter Client country Address" required />
</div>
<div class="form-group">
    <label for="client_zipcode">Client Zipcode</label>
<input class="form-control" type="text" id="client_zipcode"  name="client_zipcode" placeholder="Enter Client zipcode Address" required />
</div>
<div class="form-group">
    <label for="due_date">Invoice Due</label>
<input class="form-control" type="date" id="due_date"  name="due_date" placeholder="Select Due Date"required/>
<div>
    <h2 class="mt-3">Details:</h2>
    <table border="1" id='dataTable'class="table table-striped">
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
        </tbody>
    </table>
    <div class="d-flex justify-content-end gap-3">
    <input type="button" class="btn btn-success" value="Add Row" onClick="addRow('dataTable')" />
    <input type="button" class="btn btn-danger"value="Delete Row" onClick="deleteRow('dataTable')" />
    </div>
    <div class="my-5"><button type="submit" class="w-100 btn btn-primary" id="form-btn" name='submit'>Submit</button></div>
    <script>
        function addRow(tableID){
            let table=document.getElementById(tableID);
            let rowCount=table.rows.length;

            let row=table.insertRow(rowCount);
            let colCount=table.rows[1].cells.length;
            for(let i=0;i<colCount;i++){
                let newcell=row.insertCell(i);
                newcell.innerHTML=table.rows[1].cells[i].innerHTML;
            }
        }

        function deleteRow(tableID){
            let table=document.getElementById(tableID);
            let rowCount=table.rows.length;
            console.log(rowCount);
            if(rowCount>2)
            {table.deleteRow(rowCount-1)};

        }
    </script>
</div>

<?php
