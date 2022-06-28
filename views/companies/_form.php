<?php if(!empty($errors)): ?>
      <div class="alert alert-danger"> 
        <?php foreach($errors as $error) : ?>
          <div> <?php echo $error ?> </div>
        <?php endforeach; ?>  
      </div>
<?php endif; ?>

  <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="Name" value="<?php echo $Company['Name'] ?>" class="form-control">
            <br>
        </div>
        <div class="form-group">
            <label>Company Email</label>
            <input type="text" name="CompanyEmail" value="<?php echo $Company['CompanyEmail'] ?>" class="form-control">
            <br>
        </div>
        <div class="form-group">
            <label>Logo</label>
            <input type="text" name="Logo" value="<?php echo $Company['logo'] ?>" class="form-control">
            <br>
        </div>
        <div class="form-group">
            <label>Website</label>
            <input type="text" name="Website" value="<?php echo $Company['website'] ?>" class="form-control">
            <br>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>