<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if (!$this->input->get('kejuruan')) : ?>
    <div class="col-md-12 row">
        <?php foreach ($data['data'] as $key => $value) : ?>
            <?php $color = ['rpl' => '#000000', 'otkp' => '#00DCFF', 'tbsm' => '#004DFF', 'akl' => '#F9B100', 'bdp' => '#001640'] ?>
            <?php
                $k = $value['nama'];
            ?>
            <div class="col-md-3" style="padding-top:1%;">
                <a href="<?php echo base_url('siswa/opsi?kejuruan=') ?><?php echo $value['nama'] ?>" class="btn btn-lg btn-info btn-block" style="color:white;background-color: <?php echo $color[strtolower($k)] ?>;font-size: -webkit-xxx-large;font-weight: bold;"><?php echo $value['nama'] ?></a>
            </div>
        <?php endforeach ?>
    </div>
<?php elseif ($this->input->get('kejuruan')) : ?>
    <div class="col-md-12 row">
        <?php $color = [ 'x' => '#001C52', 'xi' => '#520051', 'xii' => '#520000'] ?>

        <?php foreach ($kelas as $key => $value) : ?>
            <?php
                $kejuruan = $this->input->get('kejuruan');
                $jurusan = $value['nama'];
                $jurusan = explode(' ', $jurusan);
                $jurusan = $jurusan[1];
                $color_k = $value['nama'];
                $color_k = explode(' ', $color_k);
                $color_k = $color_k[0];
            ?>
            <?php if ($jurusan == $kejuruan) : ?>
                <div class="col-md-3" style="padding-top:1%;">
                    <a href="<?php echo base_url('siswa/list?k=') ?><?= $value['id']; ?>" class="btn btn-lg btn-info btn-block" style="color:white;background-color: <?php echo $color[strtolower($color_k)] ?>;"><?= str_replace(' ', '<br>', $value['nama']) ?></a>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
<?php else : ?>
<?php endif ?>