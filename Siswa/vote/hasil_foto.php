    <!-- Berfungsi sebagai input gambar -->
    <?php
        $nis = $_SESSION['username'];
        $frame = $_SESSION['sekolah'];
    ?>
    <img src="../Assets/img/foto/<?php echo $nis;?>.jpg" id="img1" width="600px" height="600px" hidden="true">
    <img src="../Assets/img/frame/<?php echo $frame;?>.png" id="img2" width="600px" height="600px" hidden="true">

    <!-- Hasil output setelah digabung -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><strong>Frame Foto</strong></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                    <div class="table-responsive">
                                <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="col-md-12" >
                                <div align="center">
                                    <h2><b>Terima Kasih Atas Partisipasi Anda</b></h2>
                                    <br><br>
                                    <canvas id="canvas"></canvas>
                                    <br><br>
                                    <h6><b>Silahkan simpan foto anda. klik <button class="btn btn-primary" onclick="uploadEx();">Download</button></b></h6>
                                    <form method="post" accept-charset="utf-8" name="form1">
                                        <input name="hidden_data" id='hidden_data' type="hidden"/>
                                    </form>
                                </div>
                            </div>
                            </td>
                        </tr>
                    </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>

<!-- // Javascript -->
<script>
    window.onload = function () {

    // Mensetting Variabel
        var img1 = document.getElementById('img1');
        var img2 = document.getElementById('img2');
        var canvas = document.getElementById("canvas");
        var context = canvas.getContext("2d");
        var width = img2.width;
        var height = img2.height;
        canvas.width = width;
        canvas.height = height;

    // Fungsi untuk men-draw gambar
        context.drawImage(img1, 0, 1, width, height);
        var image1 = context.getImageData(0, 0, width, height);
        var imageData1 = image1.data;
        context.drawImage(img2, 0, 0, width, height);
        var image2 = context.getImageData(0, 0, width, height);
        var imageData2 = image2.data;
    };

    function uploadEx() {
                var canvas = document.getElementById("canvas");
                var dataURL = canvas.toDataURL("image/png");
                document.getElementById('hidden_data').value = dataURL;
                var fd = new FormData(document.forms["form1"]);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '?page=vote&aksi=simpanfoto', true);

                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        var percentComplete = (e.loaded / e.total) * 100;
                        console.log(percentComplete + '% uploaded');
                        alert('Terima kasih atas partisipasi anda untuk memilih');
                        setTimeout("location.href='?page=vote&aksi=tampilframe'", 1000);
                    }
                };

                xhr.onload = function() {

                };
                xhr.send(fd);
            };
</script>
