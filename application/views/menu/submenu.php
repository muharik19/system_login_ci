<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#NewSubmenuModal">Add New Submenu</a>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Submenu</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Submenu</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Submenu</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($submenu as $sm) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $sm['title']; ?></td>
                                        <td><?= $sm['menu']; ?></td>
                                        <td><?= $sm['url']; ?></td>
                                        <td><?= $sm['icon']; ?></td>
                                        <?php if ($sm['is_active'] !== 1) : ?>
                                            <td><?= '<a href="" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-exclamation-triangle"></i></a>'; ?></td>
                                        <?php else : ?>
                                            <td><?= '<a href="" class="btn btn-success btn-circle btn-sm"><i class="fas fa-check"></i></a>'; ?></td>
                                        <?php endif; ?>
                                        <td>
                                            <a href="<?= base_url('menu/editsubmenu/') . $sm['id']; ?>" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#editSubmenuModal<?= $sm['id']; ?>">
                                                <i class="fas fa-pen-square"></i>
                                            </a>
                                            <a href="<?= base_url('menu/trashsubmenu/') . $sm['id']; ?>" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#deleteSubmenuModal<?= $sm['id']; ?>">
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
    <div class="modal fade" id="NewSubmenuModal" tabindex="-1" role="dialog" aria-labelledby="addSubmenu" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSubmenu">Add New Submenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('menu/submenu'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Submenu Name">
                        </div>
                        <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control custom-select">
                                <option value="">Select Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="is_active" id="is_active">
                                <label class="custom-control-label" for="is_active">Active ?</label>
                            </div>
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
    <?php foreach ($submenu as $sm) : ?>
        <div class="modal fade" id="editSubmenuModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editSubmenu" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSubmenu">Edit Submenu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('menu/editsubmenu'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="<?= $sm['id']; ?>">
                                <input type="text" class="form-control" id="title" name="title" value="<?= $sm['title']; ?>">
                            </div>
                            <div class="form-group">
                                <select name="menu_id" id="menu_id" class="form-control custom-select">
                                    <option value="">Select Menu</option>
                                    <?php foreach ($menu as $m) : ?>
                                        <option value="<?= $m['id']; ?>" <?php if ($m['id'] == $sm['menu_id']) echo 'selected="selected"'; ?>><?= $m['menu']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="url" name="url" value="<?= $sm['url']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="icon" name="icon" value="<?= $sm['icon']; ?>">
                            </div>
                            <div class=" form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="1" name="is_active" id="is_active" checked>
                                    <label class="custom-control-label" for="is_active">Active ?</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Delete Modal-->
    <?php foreach ($submenu as $sm) : ?>
        <div class="modal fade" id="deleteSubmenuModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteSubmenu" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteSubmenu">Delete Submenu</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete "<?= $sm['title']; ?>" ?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="<?= base_url('menu/trashsubmenu/') . $sm['id'];; ?>">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>