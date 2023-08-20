// router.ts
import { Router } from 'express';
import {
  createSession,
  deleteSession,
  getSession,
} from '../app/controllers/SessionController';

const MainRouter: Router = Router();

MainRouter.all('/start-session', createSession);
MainRouter.all('/all-session', getSession);
MainRouter.all('/delete-session', deleteSession);

export default MainRouter;
