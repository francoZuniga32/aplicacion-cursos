<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Cargar Curso
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cargar Cuso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="row">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control" id="nombre">
                    </div>
                    <div class="row">
                        <label for="">Descripcion</label>
                        <textarea name="" class="form-control" id="descripcion" cols="10" rows="10"></textarea>
                    </div>
                    <div class="row">
                        <label for="">Modalidad</label>
                        <select name="" class="form-select" id="modalidad">
                            <option value="0">Individual</option>
                            <option value="1">Grupal</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="cargarcurso()">Cargar Curso</button>
            </div>
        </div>
    </div>
</div>