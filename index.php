<?php include '../config.php';
if (!isset($_SEESION['username'])) {
    header ("location:../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyApp</title>
    <link rel="stylesheet" href="../assets/css/bottstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://cdn.datables.net/1.11.3/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">MyApp</a>
                <button class="navbar-toggler"  type="button" data-bstoggle="collapse"
                data-bs-target="#navbarSupportedContent" ariacontrols="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Hero</a>
                    </li>
                </ul>
                <?php
                if (!isset($_SESSION['username'])) {
                ?>
                   <a class="nav-link btn btn-primary btn-sm d-flex justify-content-ened" style="color:
                   white;" aria-current="page" href="login.php">Login</a>
                <?php } else { ?>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdowntoogle" type="button"
                    id="dropdownMenuButton1"data-bstoggle="dropdown"aria-expanded="false">
                <b><?php echo $_SESSION['nmUser']; ?></b>
            </button>
            <ul class="dropdown-menu" arialabelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="../">Halaman Utama</a></li>
                <li><a class="dropdown-item" href="..logout.php">Logout</a></li>
            </ul>
                </div>
             <?php   } ?>
            </div>
            </div>
        </nav>
        <div class="row">
            <div class="col mt-3">
                <h4>Manajemen Hero</h4>
            </div>
        </div>
        <nav style="--bs-breadcrumb-divider:url(&#34;data:image/svg+xml,%3Csvg xmls='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;)" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" ariacurrent="page">Hero</li>
            </ol>
    </nav>
    <div class="row">
        <div class="col">
            <?php if (isset($_GET['gagal'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-exclamatipontriangle"></i></strong> <?= $_SESSSION ['gagalposting']; ?>
                <button type="button" class="btn-close" data-bsdismiss="alert" aria-label="Close"></button>
            </div> <?php } ?>
            <a href="#" class="btn btn-primary btn-sm float-end mb-2" data-bs-toggle="modal" data-bs-target="#tambahdata"><i class="fas faplus"></i> Tambah Data </a>
        </div>
    </div>
    <table class="table table-striped table-sm mt-1" id="tabel">
        <tread>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th width=30%>Sub Judul</th>
                <th>Status</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </tread>
        <?php
        $no = 1;
        $panggil = $koneksi->query("SELECT * FROM hero order by idHero desc ");
        ?>
        <?php while ($row = $panggil->fetch_array()) { ?>
        <tbody>
            <tr>
                <td class="align-middle"><?= $no++?></td>
                <td class="align-middle"><?= $row['judul']; ?></td>
                <td class="align-middle"><?= $row['subjudul']; ?></td>
                <td class="align-middle"><?= $row['status']; ?></td>
                <td class="align-middle"><img src="../assets/img/<?= $row['gambar']; ?>"
                width="100" height="100"></td>
                <td class="align-middle"><a data-href="#" class="btn btn-warning btn-sm update"
                data-bs-toggle="modal" data-bstarget="#editdata" data-idHero="<?= $row['idHero'] ?>"
                data-judul="<?= $row['judul'] ?>" data-subjudul="<?= $row['subjudul'] ?>"><i
                class="fas fa-pen"></i></a> <a href="konfigurasi.php?delete<?= $row['idHero']; ?>"
                class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></td>
            </tr>
        </tbody>
        <?php } ?>
    </table>
    </div>

    <!-- MODAL TAMBAH DATA-->
    <div class="modal fade" id="tambahdata" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria- labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdroplabel">Buar Hero</h5>
                <button type="button" class="btn-close" data-bsdismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <form action="konfigurasi.php" method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="judul" class="col-sm-3 col-formlabel">Judul</label>
                        <div class="col-sm-9">
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="deskripsi" class="col-sm-3 colform-label">Sub Judul</label>
                        <div class="col-sm-9">
                            <textarea name="subjudul" id="subjudul" cols-"5" rows="3"
                            class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="gambar" class="col-sm-3 col-formlabel">Gambar</label>
                        <div class="col mb-9">
                            <input type="file" name="gambar" class="form-control" id="gambar" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="status" class="col-sm-3 col-formlabel">Status</label>
                        <div class="col-sm-9">
                            <select name="status" id="status" class="form-control">
                                <option value="">Pilih</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="sumbit" name="simpan" class="btn btnprimary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <!--Modal Edit-->
    <div class=""
</body>
</html>