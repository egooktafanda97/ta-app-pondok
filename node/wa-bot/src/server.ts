import express, { Express, Request, Response } from 'express';
import dotenv from 'dotenv';

import cookieParser from 'cookie-parser';
import cors from 'cors';
import path from 'path';
import errorHandlerMiddleware from './app/middleware/error_middleware';
import sequelize from './config/db';
import MainRouter from './router';
import app_modules from './bin/app_modules';
import { logicx } from './actions/botmode';
import { Nlp } from './bin/nlpjsProccessing';
const { dockStart } = require('@nlpjs/basic');

dotenv.config();
const port: number = 5040;

const app: Express = express();
app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
Nlp();
app.use('/p', express.static(path.resolve('public')));
app.use('/p/*', (req, res) => res.status(404).send('Media Not Found'));

app.use(errorHandlerMiddleware);
app.use(MainRouter);

sequelize
  .sync()
  .then(() => {
    app.listen(port, () => {
      console.log(`⚡️[server]: Server is running at http://0.0.0.0:${port}`);
    });
    app_modules();
    // logicx();
  })
  .catch((error) => {
    console.error('Error synchronizing database:', error);
  });
