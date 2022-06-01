const express = require('express');
const cors = require('cors');
const app = express();
const sequelize = require('./database/models/index').sequelize;
const bodyParser = require('body-parser')

app.use(cors());
app.use(express.urlencoded({ extended: true }));
app.use(bodyParser.json());

app.use('/cursos', require('./app/cursos/rutas'));
app.use('/personas', require('./app/personas/rutas'));

app.listen(process.env.PORT || 3000, ()=>{
    sequelize
        .authenticate()
        .then(() => {
            console.log("se conecto con exito!!");
        })
        .catch((err) => {
            console.log(err);
        });
    console.log(`listen on port ${process.env.PORT || 3000}`);
})