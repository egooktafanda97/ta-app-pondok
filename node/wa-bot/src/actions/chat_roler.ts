import BotLogic from '../app/models/BotLogic';
import { isJSONStringValid } from '../utils/error';
import { ApiRequestGet } from '../utils/proccessing';
import { extractNumberAfterHash } from '../utils/process-number';
import { sendWaText } from './message';
import { sendText } from './whastapp';

import path from 'path';

const { dockStart } = require('@nlpjs/basic');

interface Props {
  data: any;
  roles: string;
}
export default async function Rolers(props: Props) {
  const dock = await dockStart({
    settings: {
      nlp: {
        autoSave: false,
      },
    },
    use: ['Basic', 'LangEs', 'ConsoleConnector'],
  });
  const manager = dock.get('nlp');
  manager.load(path.join(__dirname, '../etc/model.nlp'));
  const result = await manager.process('id', props.data?.args?.text ?? '');
  let roler = '';
  let nlpResult: any = {};
  if (result?.answers.length > 0) {
    if (isJSONStringValid(result.answers[0].answer)) {
      nlpResult = JSON.parse(result.answers[0].answer);
      roler = nlpResult?.role ?? '';
    }
  }
  console.log('===>', nlpResult);

  switch (roler) {
    case 'logic':
      const accountNum = extractNumberAfterHash(props.data?.args?.text);
      const args = {
        path: `${nlpResult?.path}${accountNum}`,
      };
      const res = {
        success: (result: any) => {
          console.log(
            {
              sessionId: props.data?.args.sessionId,
              to: props.data?.args?.to,
              text: result,
            },
            result
          );
          sendWaText({
            sessionId: props.data?.args.sessionId,
            to: props.data?.args?.to,
            text: result,
          });
        },
        error: (error: any) => {
          sendWaText({
            sessionId: props.data?.args.sessionId,
            to: props.data?.args?.to,
            text: 'Maaf sistem kami tidak menemukan apa yang anda cari 🙏🏼',
          });
        },
      };
      ApiRequestGet(args, res);
      break;
    default:
      // sendWaText({
      //   sessionId: props.data?.args.sessionId,
      //   to: props.data?.args?.to,
      //   text: 'Maaf sistem kami tidak menemukan apa yang anda cari 🙏🏼',
      // });
      break;
  }
}
