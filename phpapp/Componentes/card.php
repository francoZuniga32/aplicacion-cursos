<?php

class Card
{
    public function cardCurso($nombre, $descripcion, $modalidad)
    {
?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $nombre ?></h5>
                <p class="card-text">
                    <?php echo $descripcion ?>
                </p>
                <h4><?php if ($modalidad == 0) echo "<span class=\"badge text-bg-success\">Individual</span>";
                    else echo "<span class=\"badge text-bg-primary\">Grupal</span>";
                    ?>
                </h4>
            </div>
        </div>
    <?php
    }

    public function card_curso_admin($nombre, $descripcion, $modalidad, $inscriptos)
    {
    ?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $nombre ?></h5>
                <p class="card-text">
                    <?php echo $descripcion ?>
                </p>
                <h4><?php if ($modalidad == 0) echo "<span class=\"badge text-bg-success\">Individual</span>";
                    else echo "<span class=\"badge text-bg-primary\">Grupal</span>";
                    ?>
                </h4>
                <button type="button" class="btn btn-ligth">
                    Inscriptos <span class="badge text-bg-secondary"><?php echo $inscriptos ?></span>
                </button>
            </div>
        </div>
<?php
    }
}
?>