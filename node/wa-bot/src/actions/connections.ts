import UserConnection from '../app/models/UserConnections';

interface UserConnectionAttributes {
  phone: string;
  session_name: string;
  status_connecting: boolean;
}
export const insert_new_session = async ({
  session_name,
}: UserConnectionAttributes) => {
  const checkUs = await UserConnection.findOne({
    where: {
      session_name: session_name,
    },
  });
  if (!checkUs)
    await UserConnection.create({
      phone: '6282284733404',
      session_name: session_name,
      status_connecting: true,
    });
};

export const disconnet = async ({ session_name }: UserConnectionAttributes) => {
  const checkUs: any = await UserConnection.findOne({
    where: {
      session_name: session_name,
    },
  });
  if (!checkUs)
    await UserConnection.update(
      {
        phone: '6282284733404',
        session_name: session_name,
        status_connecting: false,
      },
      {
        where: checkUs.id,
      }
    );
};
