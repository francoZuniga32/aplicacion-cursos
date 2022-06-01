const rutas = require('express').Router();

rutas.get('/', require('./controlador').all);
rutas.post('/', require('./controlador').create);

module.exports = rutas;