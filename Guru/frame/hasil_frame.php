  A<!-- Berfungsi sebagai input gambar -->
    <?php
        $nis = $_SESSION['username'];
    ?>
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
                                    <img src="../Assets/img/frame_jadi/<?php echo $nis;?>.jpg" width="600px" height="600px">
                                    <br><br>
                                     <h2><b>Silahkan download klik <a class="btn btn-success" href="../Assets/img/frame_jadi/<?php echo $nis;?>.jpg" download> disini</a></b></h2>
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
