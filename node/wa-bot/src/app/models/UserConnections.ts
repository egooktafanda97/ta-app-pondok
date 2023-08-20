import { DataTypes, Model, Optional } from 'sequelize';
import sequelize from '../../config/db';

interface UserConnectionAttributes {
  id: number;
  phone: string;
  session_name: string;
  status_connecting: boolean;
}
interface UserConnectionCreationAttributes
  extends Optional<UserConnectionAttributes, 'id'> {}

class UserConnection
  extends Model<UserConnectionAttributes, UserConnectionCreationAttributes>
  implements UserConnectionAttributes
{
  public id!: number;
  public phone!: string;
  public session_name!: string;
  public status_connecting!: boolean;
}

UserConnection.init(
  {
    id: {
      type: DataTypes.INTEGER,
      primaryKey: true,
      autoIncrement: true,
    },
    phone: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    session_name: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    status_connecting: {
      type: DataTypes.BOOLEAN,
      allowNull: false,
      defaultValue: false,
    },
  },
  {
    sequelize,
    modelName: 'UserConnection',
    tableName: 'user_connections', // Nama tabel yang digunakan di database
  }
);

export default UserConnection;
