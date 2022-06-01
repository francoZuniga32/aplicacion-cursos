'use strict';
const {
  Model
} = require('sequelize');
const Cursos = require('./cursos');
module.exports = (sequelize, DataTypes) => {
  class Persona extends Model {
    /**
     * Helper method for defining associations.
     * This method is not a part of Sequelize lifecycle.
     * The `models/index` file will call this method automatically.
     */
    static associate(models) {
      // define association here
    }
  }
  Persona.init({
    dni: DataTypes.INTEGER,
    nombre: DataTypes.STRING,
    apellido: DataTypes.STRING,
    genero: DataTypes.STRING,
    fechanacimiento: DataTypes.DATE,
    cursoindividual:{
      type: DataTypes.INTEGER,
      references: {
        model: Cursos,
        key: "id",
      },
    },
    cursogrupal: {
      type: DataTypes.INTEGER,
      references: {
        model: Cursos,
        key: "id",
      },
    }
  }, {
    sequelize,
    modelName: 'Persona',
  });
  return Persona;
};