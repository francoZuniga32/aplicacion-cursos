const rutas = require('express').Router();

rutas.get('/', require('./controlador').all);
rutas.post('/', require('./controlador').create);
rutas.put('/', require('./controlador').put);
rutas.delete('/', require('./controlador').delete);

module.exports = rutas;