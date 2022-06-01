const controlador = {}
const { DataTypes } = require('sequelize');
const sequelize = require('../../database/models/index').sequelize;
const Persona = require('../../database/models/persona')(sequelize, DataTypes);
const Curso = require('../../database/models/cursos')(sequelize, DataTypes);

Persona.hasOne(Curso, { as: 'curso_individual', foreignKey: 'id', sourceKey: 'cursoindividual' });
Persona.hasOne(Curso, { as: 'curso_grupal', foreignKey: 'id', sourceKey: 'cursogrupal' })

const moment = require('moment');
const Moment = new moment();

controlador.all = async (req, res) => {
    res.send(await Persona.findAll({
        include: [
            {
                model: Curso,
                as: 'curso_individual'
            },
            {
                model: Curso,
                as: 'curso_grupal'
            }
        ]
    }));
}

controlador.create = async (req, res) => {
    console.log(req.body)
    if (req.body.dni && req.body.nombre && req.body.apellido && req.body.genero && req.body.fechanacimiento && req.body.legajocurso) {
        try {
            var persona = await Persona.findOne({
                where: {
                    dni: req.body.dni
                }
            });

            if (!persona) {
                persona = await Persona.create({
                    dni: req.body.dni,
                    nombre: req.body.nombre,
                    apellido: req.body.apellido,
                    genero: req.body.genero,
                    fechanacimiento: req.body.fechanacimiento,
                    cursoindividual: null,
                    cursogrupal: null,
                    createdAt: new Date(),
                    updatedAt: new Date()
                });
                res.status(200).send(persona);
            } else {
                res.status(401).send();
            }
        } catch (error) {
            console.log(error);
        }
    } else {
        res.status(400).send();
    }
}

controlador.agregar_curso_individual = async (req, res) => {
    if (req.body.dni && req.body.legajocurso) {
        var curso = await Curso.findOne({
            where: {
                id: req.body.legajocurso
            }
        });
        var persona = await Persona.findOne({ where: { dni: req.body.dni } });

        if (persona && !persona.getDataValue('cursoindividual') && curso && curso.getDataValue('modalidad') == 0) {
            await Persona.update({
                cursoindividual: req.body.legajocurso
            },{
                where:{
                    dni: persona.getDataValue('dni')
                }
            });
            res.status(200).send(persona);
        }else{
            res.status(401).send();
        }
    }else{
        res.status(401).send();
    }
}

controlador.agregar_curso_grupal = async(req, res)=>{
    if (req.body.dni && req.body.legajocurso) {
        var curso = await Curso.findOne({
            where: {
                id: req.body.legajocurso
            }
        });
        var persona = await Persona.findOne({ where: { dni: req.body.dni } });

        if (persona && !persona.getDataValue('cursogrupal') && curso && curso.getDataValue('modalidad') == 1) {
            await Persona.update({
                cursogrupal: req.body.legajocurso
            },{
                where:{
                    dni: persona.getDataValue('dni')
                }
            });
            res.status(200).send(persona);
        }else{
            res.status(401).send();
        }
    }else{
        res.status(401).send();
    }
}

module.exports = controlador 