import axios from 'axios';
import * as whatsapp from 'wa-multi-session';

export const reQRasaAi = async (props: any) => {
  try {
    const response: any = await axios.post(
      'http://localhost:5048/webhooks/rest/webhook',
      {
        sender: props?.sender,
        message: props?.message,
      }
    );
    const responseData = response.data[0];
    await whatsapp.sendTextMessage({
      sessionId: props?.sessionId,
      to: parseInt(props?.to),
      isGroup: false,
      text: responseData?.text,
    });
  } catch (error) {
    console.error(error);
  }
};
