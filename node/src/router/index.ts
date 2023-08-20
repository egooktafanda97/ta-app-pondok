import { Router } from 'express';
import MessageRouter from './MessageRouters';
import SessionRouter from './SessionRouters';

const MainRouter = Router();

MainRouter.use(SessionRouter);
MainRouter.use(MessageRouter);

export default MainRouter;
