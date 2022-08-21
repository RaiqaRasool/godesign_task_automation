<div class="form-group">
    <label for="user_fname">User's First Name</label>
    <input class="form-control" type="text" id="user_fname" value="<?= $is_edit ? $user_data["first_name"] : "" ?>" name="user_fname" placeholder="Enter User First Name" required />
</div>
<div class="form-group">
    <label for="user_lname">User's Last Name</label>
    <input class="form-control" type="text" id="user_lname" value="<?= $is_edit ? $user_data["last_name"] : "" ?>" name="user_lname" placeholder="Enter User Last Name" required />
</div>
<div class="form-group">
    <label for="user_email">User's Email</label>
    <input class="form-control" type="email" id="user_email" value="<?= $is_edit ? $user_data["email"] : "" ?>" name="user_email" placeholder="Enter User's Email" required />
</div>
<div class="form-group">
    <label for="user_password">User's Password</label>
    <input class="form-control" type="text" id="user_password" name="user_password" placeholder="Enter User's Password" required />
</div>
<div class="form-group">
    <label for="user_role">Choose User Role</label>
    <select class="form-control form-control-sm" id="user_role" name="admin">
        <?php if ($is_edit) : ?>
            <?php if ($user_data["admin"] == 1) : ?>
                <option value="1" selected>Admin</option>
                <option value="0">Normal User</option>
            <?php else :
            ?>
                <option value="1">Admin</option>
                <option value="0" selected>Normal User</option>
            <?php
            endif;
            ?>
        <?php
        else :
        ?>
            <option value="1">Admin</option>
            <option value="0" selected>Normal User</option>
        <?php
        endif;
        ?>
    </select>
</div>
<div class="my-5"><button type="submit" class="w-100 btn btn-primary" id="form-btn" name='submit'><?= $btn_text ?></button></div>