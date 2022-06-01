const controlador = {}
const { DataTypes, UUIDV4 } = require('sequelize');
const sequelize = require('../../database/models/index').sequelize;
const Cursos = require('../../database/models/cursos')(sequelize, DataTypes);

controlador.all = async (req, res) => {
    res.send(await Cursos.findAll());
}

controlador.create = async (req, res) => {
    console.log(req.body.nombre, req.body.descripcion, req.body.modalidad);
    if (req.body.nombre != null && req.body.descripcion != null && req.body.modalidad != null) {
        var cursos = await Cursos.findOne({
            where: {
                nombre: req.body.nombre,
            }
        });

        if (!cursos) {
            cursos = await Cursos.create({
                nombre: req.body.nombre,
                descripcion: req.body.descripcion,
                modalidad: req.body.modalidad == 0? 0: 1
            });

            res.send(cursos);
        } else {
            res.status(401).send({ err: "el curso ya tiene ese nombre" });
        }
    } else {
        res.status(400).send({ err: "no se proporciono el nombre, o la descripcion, o la modalidad" });
    }
}

controlador.put = async (req, res) => {
    if (req.body.legajo && req.body.nuevonombre || req.body.nuevadescripcion || req.body.nuevamodalidad) {
        var curso = await Cursos.findOne({
            legajo: req.body.legajo
        });
        if (curso) {
            var update = {};
            req.body.nuevonombre != null ? update.nombre = req.body.nuevonombre : null;
            req.body.nuevadescripcion != null ? update.descripcion = req.body.nuevadescripcion : null;
            req.body.nuevamodalidad != null ? update.modalidad = req.body.nuevamodalidad : null;
            if(update != {}){
                update = await Cursos.update(update,{
                    where: {
                        legajo: req.body.legajo
                    }
                });
                res.status(202).send(update);
            }else{
                res.status(204).send("no se actualizo ningun dato.");
            }
        }else{
            res.status(401).send({err: "el legajo no existe."});
        }
    }else{
        res.status(400).send({err: "no se proporciono el legajo."})
    }
}

controlador.delete = async(req, res)=>{
    if(req.body.legajo){
        var curso = await Cursos.findOne({
            where:{
                legajo: req.body.legajo
            }
        });

        if(curso){
            await Cursos.delete({
                where:{
                    legajo: req.body.legajo
                }
            });
            res.status(202).send();
        }else{
            res.status(204).send();
        }
    }else{
        res.status(400).send({err: "no se proporciono el legajo."})
    }
}

module.exports = controlador;