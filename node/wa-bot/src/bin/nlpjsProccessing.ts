import path from 'path';

const { dockStart } = require('@nlpjs/basic');

export async function Nlp() {
  const dock = await dockStart({
    settings: {
      nlp: {
        corpora: [path.join(__dirname, '../etc/corpus.json')],
        autoSave: false,
      },
    },
    use: ['Basic', 'LangEs', 'ConsoleConnector'],
  });
  const nlp = dock.get('nlp');
  await nlp.train();
  nlp.save(path.join(__dirname, '../etc/model.nlp'));
}
