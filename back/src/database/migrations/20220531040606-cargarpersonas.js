'use strict';

const axios = require('axios');

module.exports = {
  async up(queryInterface, Sequelize) {

    console.log('creamos tres cursos iniciales');
    await queryInterface.bulkInsert('Cursos', [{
      nombre: 'Carpinteria',
      descripcion: "Podra crear magnificas obras de arte en madera",
      modalidad: 1,
      createdAt: new Date(),
      updatedAt: new Date()
    }, {
      nombre: "Telar",
      descripcion: 'Creara maginifa ropa con el telar',
      modalidad: 1,
      createdAt: new Date(),
      updatedAt: new Date()
    }, {
      nombre: "Cocina",
      descripcion: "Aprender un monton de recetas y como usar los utencilios de cocina",
      modalidad: 2,
      createdAt: new Date(),
      updatedAt: new Date()
    }, {
      nombre: "Electricidad",
      descripcion: "Aprendera a realizar instalaciones electricas",
      modalidad: 2,
      createdAt: new Date(),
      updatedAt: new Date()
    }])
    console.log('cargamos los 100 usuario al sistema');
    try {
      var personas = [];
      var personasGet = await axios.get("http://weblogin.muninqn.gov.ar/api/examen");
      personasGet = personasGet.data.value;
      for (let i = 0; i < personasGet.length; i++) {
        const persona = personasGet[i];
        await queryInterface.bulkInsert("Personas", [{
          dni: persona.dni,
          nombre: persona.razonSocial.split(',')[1],
          apellido: persona.razonSocial.split(',')[0],
          genero: persona.genero.value,
          fechanacimiento: new Date(persona.fechaNacimiento),
          cursoindividual: (Math.floor(Math.random() * (1 - 0)) + 0) == 0 ? null : Math.floor(Math.random() * (1 - 0)) + 0,
          cursogrupal: (Math.floor(Math.random() * (1 - 0)) + 0) == 0 ? null : Math.floor(Math.random() * (3 - 2)) + 2,
          createdAt: new Date(),
          updatedAt: new Date()
        }])
      }
      console.log(personas);
    } catch (error) {
      console.log(error);
    }
  },

  async down(queryInterface, Sequelize) {
    await queryInterface.bulkDelete('Personas');
    await queryInterface.bulkDelete('Cursos');
  }
};
