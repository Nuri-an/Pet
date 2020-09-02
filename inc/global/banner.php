<div class="row align-items-end" id="banner" style="margin: 0px;">
        <?php
        file_exists("../assets/media/capa.png") ? $src = "../assets/media/capa.png" : $src = "../assets/media/capa.jpeg";

        echo '<img src="'. $src .'" style="margin: 0px; width: 100vw; background-position: center; background-repeat: no-repeat; " class="img-fluid" alt="Responsive image">';
        ?>
</div>

