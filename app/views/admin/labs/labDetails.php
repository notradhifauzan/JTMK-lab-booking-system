<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/admin_navbar.php'; ?>

<?php flash('addLab_success'); ?>
<?php flash('updateLab_success'); ?>
<?php flash('updateLab_fail'); ?>
<?php flash('add_inv_success'); ?>
<?php flash('update_inv_success'); ?>
<?php flash('delete_inv_success'); ?>
<?php flash('add_inv_fail'); ?>
<?php flash('delete_inv_fail'); ?>
<?php flash('update_inv_fail'); ?>

<main class="bg-light rounded-2">
    <div class="mt-4 row g-4 bg-light rounded col-12 col-lg-8 mx-auto">
        <div class="col-md-5 col-lg-4 order-md-last mb-3 rounded-2">
            <img class="rounded-2" width="100%" height="400" src="<?php echo URLROOT; ?>/img/backgrounds/laptop1.jpg" alt="">
        </div>
        
        <div class="col-md-7 col-lg-8">
            <button onclick="location.href='<?php echo URLROOT; ?>/admins/allLabs'" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left"></i> Return</button>
            <h4 class="mb-3 mt-2">Lab details</h4>
            <input type="hidden" name="lab_id" value="<?php echo $data['lab']->lab_id; ?>">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="labcode" class="form-label">Lab code</label>
                    <input disabled type="text" class="form-control" name="labcode" id="labcode" placeholder="" value="<?php echo $data['lab']->lab_code ?>" required>
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- might need update later (faculty management module) -->
                    <label for="faculty" class="form-label">Faculty</label>
                    <select disabled class="form-select" name="faculty" id="faculty" aria-label="Default select example" required>
                        <option value="">Select faculty</option>
                        <option <?php if ($data['lab']->faculty == 'FSKM') echo 'selected'; ?> value="FSKM">FSKM</option>
                        <option <?php if ($data['lab']->faculty == 'FSG') echo 'selected'; ?> value="FSG">FSG</option>
                        <option <?php if ($data['lab']->faculty == 'FPA') echo 'selected'; ?> value="FPA">FPA</option>
                    </select>
                    <div class="invalid-feedback">
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="level" class="form-label">Level</label>
                    <select disabled class="form-select" name="level" id="level" aria-label="Default select example" required>
                        <option value="">Select level</option>
                        <option <?php if ($data['lab']->level == 1) echo 'selected'; ?> value="1">1</option>
                        <option <?php if ($data['lab']->level == 2) echo 'selected'; ?> value="2">2</option>
                        <option <?php if ($data['lab']->level == 3) echo 'selected'; ?> value="3">3</option>
                        <option <?php if ($data['lab']->level == 4) echo 'selected'; ?> value="4">4</option>
                    </select>
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="capacity" class="form-label">Capacity</label>
                    <input disabled type="number" class="form-control" name="capacity" id="capacity" placeholder="" value="<?php echo $data['lab']->capacity ?>" required>
                    <div class="invalid-feedback">
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <h4>Inventories</h4>
            <button data-bs-toggle="modal" data-bs-target="#addInventory" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-plus"></i> Add inventory</button>
            <!-- Modal to add more inventories -->
            <div class="modal fade" id="addInventory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="<?php echo URLROOT; ?>/admins/addInventory/<?php echo $data['lab']->lab_id; ?>" method="POST" class="needs-validation">
                            <input type="hidden" name="lab_id" value="<?php echo $data['lab']->lab_id; ?>">

                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add inventory</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="inv_name" class="form-label">Inventory name</label>
                                        <input type="test" class="form-control" name="inv_name" id="inv_name" placeholder="" value="" required>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" name="quantity" id="quantity" placeholder="" value="" required>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- modal end -->

            <!-- Modal to update lab details -->
            <div class="modal fade" id="updateLab" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="<?php echo URLROOT; ?>/admins/updateLab/<?php echo $data['lab']->lab_id; ?>" method="POST" class="needs-validation">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Lab</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="labcode" class="form-label">Lab code</label>
                                        <input type="text" class="form-control" name="labcode" id="labcode" placeholder="" value="<?php echo $data['lab']->lab_code ?>" required>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <!-- might need update later (faculty management module) -->
                                        <label for="faculty" class="form-label">Faculty</label>
                                        <select class="form-select" name="faculty" id="faculty" aria-label="Default select example" required>
                                            <option value="">Select faculty</option>
                                            <option <?php if ($data['lab']->faculty == 'FSKM') echo 'selected'; ?> value="FSKM">FSKM</option>
                                            <option <?php if ($data['lab']->faculty == 'FSG') echo 'selected'; ?> value="FSG">FSG</option>
                                            <option <?php if ($data['lab']->faculty == 'FPA') echo 'selected'; ?> value="FPA">FPA</option>
                                        </select>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="level" class="form-label">Level</label>
                                        <select class="form-select" name="level" id="level" aria-label="Default select example" required>
                                            <option value="">Select level</option>
                                            <option <?php if ($data['lab']->level == 1) echo 'selected'; ?> value="1">1</option>
                                            <option <?php if ($data['lab']->level == 2) echo 'selected'; ?> value="2">2</option>
                                            <option <?php if ($data['lab']->level == 3) echo 'selected'; ?> value="3">3</option>
                                            <option <?php if ($data['lab']->level == 4) echo 'selected'; ?> value="4">4</option>
                                        </select>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="capacity" class="form-label">Capacity</label>
                                        <input type="number" class="form-control" name="capacity" id="capacity" placeholder="" value="<?php echo $data['lab']->capacity ?>" required>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- modal end -->

            <br>
            <div class="table-responsive mt-2">
                <table id="inventories" class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['inventories'] as $inv) : ?>
                            <!-- Modal to update inventories -->
                            <div class="modal fade" id="updateInv<?php echo $inv->inventory_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="<?php echo URLROOT; ?>/admins/updateInventory/<?php echo $inv->inventory_id; ?>" method="POST" class="needs-validation">
                                            <input type="hidden" name="lab_id" value="<?php echo $data['lab']->lab_id; ?>">

                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update inventory</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-sm-6">
                                                        <label for="inv_name" class="form-label">Inventory name</label>
                                                        <input type="test" class="form-control" name="inv_name" id="inv_name" placeholder="" value="<?php echo $inv->inventory_name ?>" required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="quantity" class="form-label">Quantity</label>
                                                        <input type="number" class="form-control" name="quantity" id="quantity" placeholder="" value="<?php echo $inv->quantity ?>" required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- modal end -->

                            <!-- Modal confirm delete inventory -->
                            <div class="modal fade" id="deleteInv<?php echo $inv->inventory_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="<?php echo URLROOT; ?>/admins/deleteInventory" method="POST" class="needs-validation">
                                            <input type="hidden" name="lab_id" value="<?php echo $data['lab']->lab_id; ?>">
                                            <input type="hidden" name="inv_id" value="<?php echo $inv->inventory_id; ?>">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete confirmation</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Proceed to delete this inventory?</h4>
                                                <br>
                                                <div class="row g-3">
                                                    <div class="col-sm-6">
                                                        <label for="inv_name" class="form-label">Inventory name</label>
                                                        <input disabled type="test" class="form-control" name="inv_name" id="inv_name" placeholder="" value="<?php echo $inv->inventory_name ?>" required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="quantity" class="form-label">Quantity</label>
                                                        <input disabled type="number" class="form-control" name="quantity" id="quantity" placeholder="" value="<?php echo $inv->quantity ?>" required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- modal end -->

                            <tr>
                                <td><?php echo $inv->inventory_id ?></td>
                                <td><?php echo $inv->inventory_name ?></td>
                                <td><?php echo $inv->quantity ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button data-bs-toggle="modal" data-bs-target="#updateInv<?php echo $inv->inventory_id; ?>" type="button" class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-pen-to-square"></i> update</button>
                                        <button data-bs-toggle="modal" data-bs-target="#deleteInv<?php echo $inv->inventory_id; ?>" type="button" class="btn btn-sm btn-outline-danger"><i class="fa-regular fa-trash-can"></i> delete</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <hr class="my-4">

            <button data-bs-toggle="modal" data-bs-target="#updateLab" class="w-100 btn btn-primary btn-sm mb-3" type="button"><i class="fa-regular fa-pen-to-square"></i> Edit lab details</button>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        $('#inventories').DataTable();
    });
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>