import BotLogic from '../app/models/BotLogic';
import sequelize from '../config/db';

export const logicx = async () => {
  await sequelize.sync({ force: true });
  // Create multiple records using create method
  await BotLogic.create({
    logic_type: 'logic',
    msg_trigger: '127226362_ceksaldo',
    actions_roles: 'get saldo',
    separator: '_',
    status: true,
  });
};
