import { Router } from 'express';
import {
  sendMessage,
  sendBulkMessage,
  SessionAutoSendMessage,
} from '../app/controllers/MessageController';

const MessageRouter: Router = Router();

MessageRouter.all('/send-message', sendMessage);
MessageRouter.all('/send-bulk-message', sendBulkMessage);
MessageRouter.all('/session-auto-send-message', SessionAutoSendMessage);

export default MessageRouter;
