<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Style -->
    <style>
        .table-hover tbody tr:hover {
            background-color: #f1f5f9;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .btn-outline-success:hover {
            background-color: #28a745;
            color: white;
        }

        .btn-outline-warning:hover {
            background-color: #ffc107;
            color: white;
        }

        .btn-outline-info:hover {
            background-color: #17a2b8;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                <h5 class="m-0 font-weight-bold">Daftar User</h5>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Grup</th>
                                <th>Email</th>
                                <th style="width: 60px;">Aktif</th>
                                <th style="width: 90px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $row): ?>
                                <tr>
                                    <td><?= $row->id; ?></td>
                                    <td><?= $row->username; ?></td>
                                    <td><?= !empty($row->group) ? $row->group[0]['name'] : ''; ?></td>
                                    <td><?= $row->email; ?></td>
                                    <td align="center">
                                        <a href="#"
                                            class="btn btn-sm btn-circle btn-active-users"
                                            data-id="<?= $row->id; ?>"
                                            data-active="<?= $row->active == 1 ? 1 : 0; ?>"
                                            title="Klik untuk Mengaktifkan atau Menonaktifkan">
                                            <?= $row->active == 1
                                                ? '<i class="fas fa-check-circle text-success"></i>'
                                                : '<i class="fas fa-times-circle text-danger"></i>'; ?>
                                        </a>
                                    </td>

                                    <td align="center">
                                        <a href="<?= base_url('users/changePassword/' . $row->id); ?>"
                                            class="btn btn-warning btn-circle btn-sm"
                                            title="Ubah Password">
                                            <i class="fas fa-key"></i>
                                        </a>
                                        <button class="btn btn-outline-success btn-sm btn-change-group" data-id="<?= $row->id; ?>" title="Ubah Grup">
                                            <i class="fas fa-cogs"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal for changing group -->
        <form action="<?= base_url(); ?>/users/changeGroup" method="post">
            <?= csrf_field(); ?>

            <div class="modal fade" id="changeGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Grup</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="group">Pilih Grup:</label>
                                <select name="group" id="group" class="form-control">
                                    <?php foreach ($groups as $row) : ?>
                                        <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" class="id">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="activateModalLabel">Ubah Status Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mengubah status pengguna ini?</p>
                </div>
                <div class="modal-footer">
                    <form action="<?= base_url('/users/activate'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id" class="id">
                        <input type="hidden" name="active" class="active">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= session()->getFlashdata('success'); ?>',
                showConfirmButton: false,
                timer: 3000
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: '<?= session()->getFlashdata('error'); ?>',
                showConfirmButton: true
            });
        <?php endif; ?>
    </script>


    <!-- Bootstrap and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Script -->
    <script>
        $('.btn-change-group').on('click', function() {
            const id = $(this).data('id');
            $('.id').val(id);
            $('#changeGroupModal').modal('show');
        });

        $(document).on('click', '.btn-active-users', function() {
            const id = $(this).data('id');
            const active = $(this).data('active');
            $('.id').val(id); // Set ID pengguna
            $('.active').val(active == 1 ? 0 : 1); // Toggle status
            $('#activateModal').modal('show'); // Tampilkan modal
        });
    </script>
</body>

</html>