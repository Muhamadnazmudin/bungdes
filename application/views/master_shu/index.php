<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">

            <?= $title ?>

        </h1>

        <a href="<?= base_url('master_shu/tambah') ?>"
           class="btn btn-primary">

            <i class="fas fa-plus"></i>

            Tambah Data

        </a>

    </div>

    <?php if($this->session->flashdata('success')): ?>

        <div class="alert alert-success">

            <?= $this->session->flashdata('success') ?>

        </div>

    <?php endif; ?>


    <div class="card shadow">

        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-primary">

                Data Master SHU

            </h6>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="bg-light">

                    <tr>

                        <th width="50">No</th>

                        <th>Nama</th>

                        <th>Dasar</th>

                        <th>Akun</th>

                        <th width="120">Persentase</th>

                        <th width="80">Urutan</th>

                        <th width="150">Aksi</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php

                    $no=1;

                    foreach($data as $row):

                    ?>

                    <tr>

                        <td class="text-center">

                            <?= $no++ ?>

                        </td>

                        <td>

                            <?= $row->nama ?>

                        </td>

                        <td>

                            <?=
                            $row->dasar=='LABA_USAHA'
                            ?
                            'Laba Usaha'
                            :
                            'Sisa SHU'
                            ?>

                        </td>

                        <td>

                            <?= $row->kode ?>

                            -

                            <?= $row->nama_akun ?>

                        </td>

                        <td class="text-center">

                            <?= number_format($row->persentase,2) ?>

                            %

                        </td>

                        <td class="text-center">

                            <?= $row->urutan ?>

                        </td>

                        <td class="text-center">

                            <a href="<?= base_url('master_shu/edit/'.$row->id) ?>"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </a>

                            <a href="<?= base_url('master_shu/hapus/'.$row->id) ?>"
                               onclick="return confirm('Hapus data?')"
                               class="btn btn-danger btn-sm">

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