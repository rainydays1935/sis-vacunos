
<div class="container-full login" style="padding-top:10%" id="formContainer">
    <div class="col-lg-4 col-md-4 col-md-offset-4 col-lg-offset-4 well">
      <?php echo form_open('login/validate_user');?>
      <?php validation_errors();?>
        <div class="form-group">
          <label for="exampleInputEmail1">Usuario</label>
          <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="password"  name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
  </div>
</div>
