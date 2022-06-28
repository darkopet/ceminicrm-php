<h1>Companies AdminPanel</h1>
    <p>
        <a href="/companies/create" class="btn btn-success">Insert New Company</a>
    </p>
    <p>
        <a href="/companies/update" class="btn btn-success">Update Company</a>
    </p>

    <form>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search For companies" name="search" value="<?php echo $search ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">CompanyEmail</th>
                <th scope="col">Logo</th>
                <th scope="col">Website</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($companies as $i => $company) : ?>
                <tr>
                    <th scope="row"><?php echo $i + 1 ?></th>
                    <td><?php echo $company['Name'] ?></td>
                    <td><?php echo $company['CompanyEmail'] ?></td>
                    <td><?php echo $company['logo'] ?></td>
                    <td><?php echo $company['website'] ?></td>
                    <td>
                        <a href="/companies/update?id=<?php echo $company['id'] ?>" class="btn btn-sm btn-outline-secondary">Edit</a>

                        <form style="display: inline-block" method="post" action="companies/delete">
                            <input type="hidden" name="id" value="<?php echo $company['id'] ?> ">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>