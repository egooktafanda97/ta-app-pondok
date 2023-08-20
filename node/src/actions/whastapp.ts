import axios from 'axios';
import * as whatsapp from 'wa-multi-session';
import { reQRasaAi } from './aiactions';
interface params {
  sessionId: string;
  to: any;
  text: string;
  botMethod: string;
}
export const sendText = async (props: any) => {
  const { botMethod } = props;
  try {
    switch (botMethod) {
      case 'rasa':
        const { sessionId, to, text }: params = props;
        const args = {
          sender: `${parseInt(to)}`,
          message: text,
          sessionId: sessionId,
          to: to,
        };
        const sendX = reQRasaAi(args);
        return sendX;
        break;

      default:
        break;
    }
  } catch (error) {
    return false;
  }
};
