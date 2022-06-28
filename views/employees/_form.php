<?php if(!empty($errors)): ?>
      <div class="alert alert-danger"> 
        <?php foreach($errors as $error) : ?>
          <div> <?php echo $error ?> </div>
        <?php endforeach; ?>  
      </div>
<?php endif; ?>

  <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>Employee First Name</label>
            <input type="text" name="FirstName" value="<?php echo $Employee['FirstName'] ?>" class="form-control">
            <br>
        </div>
        <div class="form-group">
            <label>Employee Last Name</label>
            <input type="text" name="LastName" value="<?php echo $Employee['LastName'] ?>" class="form-control">
            <br>
        </div>
        <div class="form-group">
            <label>Company</label>
            <input type="number" name="Company" value="<?php echo $Employee['Company'] ?>" class="form-control">
            <br>
        </div>
        <div class="form-group">
            <label>Company Email</label>
            <input type="text" name="CompanyEmail" value="<?php echo $Employee['CompanyEmail'] ?>" class="form-control">
            <br>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="Phone" value="<?php echo $Employee['Phone'] ?>" class="form-control">
            <br>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>