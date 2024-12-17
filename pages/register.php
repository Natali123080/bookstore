<form class="border rounded p-4 w-50 mx-auto" method="POST" action="./handlers/handle_register.php">
    <h3 class="text-center">Registration</h3>
    <div class="mb-3">
        <label for="names" class="form-label">Names</label>
        <input type="names" class="form-control" id="names" name="names" value="<?php echo $flash['data']['names'] ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $flash['data']['email'] ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="mb-3">
        <label for="repeat_password" class="form-label">Repeat Password</label>
        <input type="password" class="form-control" id="repeat_password" name="repeat_password">
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-control" id="role" name="role">
            <option value="user" <?php echo (isset($flash['data']['role']) && $flash['data']['role'] == 'user') ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?php echo (isset($flash['data']['role']) && $flash['data']['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mx-auto">Register</button>
</form>
