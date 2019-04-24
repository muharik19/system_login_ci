<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Role User</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($role as $r) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $r['role']; ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="btn btn-info btn-circle btn-sm">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <a href="<?= base_url('admin/edit/') . $r['id']; ?>" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#editRoleModal<?= $r['id']; ?>">
                                                <i class="fas fa-pen-square"></i>
                                            </a>
                                            <a href="<?= base_url('admin/delete/') . $r['id']; ?>" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#deleteRoleModal<?= $r['id']; ?>">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Insert Modal -->
    <div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="addNewRole" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewRole">Add New Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/role'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <?php foreach ($role as $r) : ?>
        <div class="modal fade" id="editRoleModal<?= $r['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="UpdateRole" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="UpdateRole">Update Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('admin/edit'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="<?= $r['id']; ?>">
                                <input type="text" class="form-control" id="role" name="role" value="<?= $r['role']; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Delete Modal-->
    <?php foreach ($role as $r) : ?>
        <div class="modal fade" id="deleteRoleModal<?= $r['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteRole" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteRole">Delete Role</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete "<?= $r['role']; ?>" ?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="<?= base_url('admin/delete/') . $r['id']; ?>">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>