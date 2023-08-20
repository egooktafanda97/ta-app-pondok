import moment from 'moment';
import BotModel from '../app/models/BotModel';
import MessageConnection from '../app/models/Message';
import UserConnection from '../app/models/UserConnections';
import { sendText } from './whastapp';
import Rolers from './chat_roler';
import * as whatsapp from 'wa-multi-session';
function generateRandomNumber() {
  const randomNumber = Math.floor(Math.random() * 10 ** 20);
  return randomNumber.toString().padStart(5, '0');
}

function isEmpty(value: any): boolean {
  if (Array.isArray(value)) {
    return value.length === 0;
  } else if (typeof value === 'object' && value !== null) {
    return Object.keys(value).length === 0;
  } else if (typeof value === 'string') {
    return value.trim().length === 0;
  }
  return !value;
}

export const saveMsg = async (msg: any) => {
  try {
    const sessionId = msg?.sessionId ?? '';
    const checkUs = await UserConnection.findOne({
      where: {
        session_name: sessionId,
      },
    });
    const phoneNumber = msg.key?.remoteJid;
    const regex = /\d+/;
    const matches: any = phoneNumber.match(regex);
    console.log(checkUs);

    if (checkUs) {
      const remoteJid = msg.key?.remoteJid;
      const fromMe = msg.key?.fromMe;

      const text = !isEmpty(msg.message?.extendedTextMessage)
        ? msg.message?.extendedTextMessage?.text
        : msg.message.conversation;

      const messageTimestamp = msg.messageTimestamp?.low;
      const name = msg?.pushName ?? '';
      const data: any = {
        chart_session: generateRandomNumber(),
        remoteJid: remoteJid,
        name: name,
        fromMe: fromMe,
        from: remoteJid,
        to: sessionId,
        text: text,
        status_connecting: false,
        bot: true,
        messageTimestamp: Math.floor(Date.now() / 1000),
        UserConnectionId: checkUs.id,
      };
      await MessageConnection.create(data).catch((err) => {
        console.log(err);
      });

      const read = await BotModel.findOne({
        where: {
          session_name: sessionId,
          client: `${matches}`,
          status_bot: true,
        },
      });
      if (!read) {
        await BotModel.create({
          UserConnectionId: checkUs.id,
          session_name: sessionId,
          client: `${matches}`,
          bot_start: Math.floor(Date.now() / 1000),
          bot_end: Math.floor(Date.now() / 1000),
          boot_type: 'AI',
          status_bot: true,
        });
      }
      // const now = moment();
      // const timestamp = Math.floor(Date.now() / 1000);
      // const dt = moment.unix(timestamp);
      // const time_difference = now.diff(dt, 'seconds');
      // if (time_difference > 180) {
      //   await BotModel.update(
      //     {
      //       bot_end: Math.floor(Date.now() / 1000),
      //       status_bot: false,
      //     },
      //     {
      //       where: {
      //         id: read?.id,
      //       },
      //     }
      //   );
      // } else {
      //   await BotModel.update(
      //     {
      //       bot_end: Math.floor(Date.now() / 1000),
      //     },
      //     {
      //       where: {
      //         id: read?.id,
      //       },
      //     }
      //   );
      // }
      console.log({
        sessionId: sessionId,
        to: matches[0],
        text: text,
      });

      if (msg.key?.fromMe != true) {
        const RolesProps = {
          data: {
            msg_trigger: '127226362_ceksaldo',
            args: {
              sessionId: sessionId,
              to: matches[0],
              text: text,
            },
          },
          roles: 'logic',
        };
        Rolers(RolesProps);
        // RunBot();
        // sendText({
        //   sessionId: sessionId,
        //   to: matches[0],
        //   text: text,
        //   bot: true,
        // });
      }
    }
  } catch (error) {
    // console.log(error);
  }
};

export const sendWaText = async (props: any) => {
  await whatsapp.sendTextMessage({
    sessionId: props?.sessionId,
    to: parseInt(props?.to),
    isGroup: false,
    text: props?.text,
  });
};
