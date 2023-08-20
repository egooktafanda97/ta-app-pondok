import * as whatsapp from 'wa-multi-session';

import { saveMsg } from '../actions/message';
import { insert_new_session, disconnet } from '../actions/connections';

export const waAutoRun = () => {
  console.log('run');

  whatsapp.onConnected(async (session) => {
    console.log('connected => ', session);
    insert_new_session({
      phone: '123456789',
      session_name: session,
      status_connecting: true,
    });
  });

  whatsapp.onDisconnected(async (session) => {
    console.log('disconnected => ', session);
    disconnet({
      phone: '123456789',
      session_name: session,
      status_connecting: false,
    });
  });

  whatsapp.onConnecting(async (session) => {
    console.log('connecting => ', session);
    insert_new_session({
      phone: '123456789',
      session_name: session,
      status_connecting: true,
    });
  });

  whatsapp.loadSessionsFromStorage();

  whatsapp.onMessageReceived(async (msg: any) => {
    console.log(msg);
    // if (msg?.broadcast == false) saveMsg(msg);
  });
};
