<!-- Begin Page Content -->
<div class="container-fluid">


  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

  <?php if (session()->get('err')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <?= session()->get('err'); ?>
    </div>
  <?php endif; ?>

  <div class="swall" data-swall="<?= session()->get('message'); ?>"></div>

  <div class="card">
    <div class="card-header">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
        Tambah Anggota
      </button>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr?>
              <th>No</th>
              <th>NPM</th>
              <th>Nama</th>
              <th>Prodi</th>
              <th>Action</th>
              </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($mahasiswa as $row) : ?>
              <tr>
                <td scope="row"><?= $i; ?></td>
                <td><?= $row['npm']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['nama_prodi']; ?></td>
                <td>
                  <button type="button" data-toggle="modal" data-target="modalUbah" class="btn btn-sm btn-warning" id="btn-edit" data-id="< $row['id']; ?>" data-npm="<? $row['npm']; ?>" data-nama="<? $row['nama']; ?>"> <i class="fa fa-edit"></i> </button>
                  <button type="button" data-toggle="modal" data-target="#modalHapus" class="btn btn-sm btn-danger"> <i class="fa fa-trash-alt"></i> </>
              </tr>
              <?php $i++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <br />
  <!-- Page Heading -->
  <div class="card">
    <div class="card-header">
      <center>
        <h1 class="h3 mb-4 text-gray-800">User Anggota</h1>
      </center>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
        Tambah User
      </button>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr?>
              <th>No</th>
              <th>Username</th>
              <th>email</th>
              <th>Action</th>
              </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php
            foreach ($user as $row) : ?>
              <tr>
                <td scope="row"><?= $i; ?></td>
                <td><?= $row['username']; ?></td>
                <td><?= $row['email']; ?></td>
                <td>
                  <button type="button" data-toggle="modal" data-target="modalUbah" class="btn btn-sm btn-warning" id="btn-edit" data-id="< $row['id']; ?>" data-npm="<? $row['npm']; ?>" data-nama="<? $row['nama']; ?>"> <i class="fa fa-edit"></i> </button>
                  <button type="button" data-toggle="modal" data-target="#modalHapus" class="btn btn-sm btn-danger"> <i class="fa fa-trash-alt"></i> </>
              </tr>
              <?php $i++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- End of Main Content -->

  <!-- Modal -->
  <div class="modal fade" id="modalTambah">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah <?= $judul; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('mahasiswa/tambah'); ?>" method="post">
            <div class="form-group" mb-0>
              <label for="npm"></label>
              <input type="text" name="npm" id="npm" class="form-control" placeholder="Masukkan NPM">

              <label for="nama"></label>
              <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Mahasiswa">

              <label for="">Jurusan</label>
              <select name="jurusan" class="form-control" id="jurusan">
                <option>Pilih jurusan....</option>
                <?php foreach ($jurusan as $j) : ?>
                  <option value="<?= $j->id ?>"><?= $j->nama ?></option>
                <?php endforeach; ?>
              </select>

              <label for="">Prodi</label>
              <select name="prodi" class="form-control" id="prodi">
                <option>Pilih prodi....</option>
              </select>
            </div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
        </div>
      </div>
      </form>
    </div>
  </div>

  <!-- Modal Hapus data Mahasiswa -->
  <div class="modal fade" id="modalHapus">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          Apakah anda yakin ingin menghapus data ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <a href="/mahasiswa/hapus/<?= $row['id'] ?>" class="btn btn-primary">Yakin</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal ubah -->
  <div class="modal fade" id="modalUbah">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">ubah <?= $judul; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('mahasiswa/ubah'); ?>" method="post">
            <div class="form-group" mb-0>
              <label for="npm"></label>
              <input type="text" name="npm" id="npm" class="form-control" placeholder="Masukkan NPM">

              <label for="nama"></label>
              <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Mahasiswa">

              <label for="">Jurusan</label>
              <select name="jurusan" class="form-control" id="jurusan">
                <option>Pilih jurusan....</option>
                <?php foreach ($jurusan as $j) : ?>
                  <option value="<?= $j->id ?>"><?= $j->nama ?></option>
                <?php endforeach; ?>
              </select>

              <label for="">Prodi</label>
              <select name="prodi" class="form-control" id="prodi">
                <option>Pilih prodi....</option>
              </select>
            </div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" name="Ubah" class="btn btn-primary">Ubah Data</button>
        </div>
      </div>
      </form>
    </div>
  </div>

  <script>
    $(document).ready(function() {

      // alert('aaaaaa'); 
      $.ajaxSetup({
        type: 'POST',
        url: `<?= base_url('/mahasiswa/loadData') ?>`,
        caches: false
      });
      $('.modal-body #jurusan').change(function() {
        var value = $(this).val();
        if (value > 0) {
          $.ajax({
            data: {
              module: 'prodi',
              id: value
            },
            success: function(response) {
              $("#prodi").html(response);
            }
          })
        }
      })

      const swall = $('.swall').data('swall');
      if (swall) {
        Swal.fire({
          title: 'Data Berhasil!',
          text: swall,
          icon: 'success'
        });
      }
    });
  </script>