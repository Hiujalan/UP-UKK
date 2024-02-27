<!-- Start Footer Section -->
<footer class="footer-section">
    <div class="container relative">

        <div class="sofa-img " style="margin-top: 250px;">
            <img src="<?= base_url(); ?>/assetsApp/images/flat-home.png" alt="Image" class="img-fluid">
        </div>

        <div class="row g-5 mb-5">
            <div class="col-lg-4">
                <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo"><?= $settingsData['nama']; ?><span>.</span></a></div>
                <p class="mb-4">SMK Negeri 1 Jenangan Ponorogo adalah sebuah sekolah menengah kejuruan yang fokus pada bidang keteknikan. Sekolah ini merupakan sekolah teknik tertua di Ponorogo. Terdapat 9 Kompetensi keahlian yang diselenggarakan oleh sekolah ini.</p>

                <ul class="list-unstyled custom-social">
                    <?php $medsos = json_decode($settingsData['medsos']) ?>
                    <li><a href="<?= $medsos->facebook; ?>"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                    <li><a href="<?= $medsos->twitter; ?>"><span class="fa fa-brands fa-twitter"></span></a></li>
                    <li><a href="<?= $medsos->instagram; ?>"><span class="fa fa-brands fa-instagram"></span></a></li>
                    <li><a href="<?= $medsos->linkedin; ?>"><span class="fa fa-brands fa-linkedin"></span></a></li>
                </ul>
            </div>

            <div class="col-lg-8">
                <div class="row links-wrap">
                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a href="<?= base_url('app/home'); ?>">Home</a></li>
                            <li><a href="<?= base_url('app/shop/produk'); ?>">Produk</a></li>
                            <li><a href="<?= base_url('app/pesananSaya'); ?>">Pesanan Saya</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a href="<?= base_url('app/home'); ?>">Support</a></li>
                            <li><a href="<?= base_url('app/home'); ?>">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="border-top copyright">
            <div class="row pt-4">
                <div class="col-lg-6">
                    <p class="mb-2 text-center text-lg-start">Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a> <!-- License information: https://untree.co/license/ -->
                    </p>
                </div>

                <div class="col-lg-6 text-center text-lg-end">
                    <ul class="list-unstyled d-inline-flex ms-auto">
                        <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</footer>
<!-- End Footer Section -->