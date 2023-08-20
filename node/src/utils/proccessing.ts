import axios from 'axios';
import dotenv from 'dotenv';
dotenv.config();
interface propsGetSaldo {
  path: string;
}
export async function ApiRequestGet(props: any, result: any) {
  const oncard = {
    host: process.env.HOSTONCARDSERVICE,
    keys: process.env.KEYONCARDSERVICE,
  };
  const response = await axios
    .get(`${oncard?.host}${props?.path}`, {
      headers: {
        keys: oncard?.keys,
      },
    })
    .catch((err) => {
      result.error('error internal');
    });
  result.success(response?.data?.info ?? 0);
}
