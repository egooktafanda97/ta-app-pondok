import { Request, Response, NextFunction } from 'express';
import * as whatsapp from 'wa-multi-session';
import { responseSuccessWithData } from '../../utils/response';
import ValidationError from '../../utils/error';

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

export const sendMessage = async (
  req: Request,
  res: Response,
  next: NextFunction
) => {
  try {
    let to = req.body.to || req.query.to;
    let text = req.body.text || req.query.text;
    let isGroup = req.body.isGroup || req.query.isGroup;
    const sessionId =
      req.body.session || req.query.session || req.headers.session;

    if (!to || !text) throw new ValidationError('Missing Parameters', 401);

    const receiver = to;
    if (!sessionId) throw new ValidationError('Session Not Found', 404);

    console.log({
      sessionId,
      to: receiver,
      isGroup: !!isGroup,
      text,
    });

    const send = await whatsapp.sendTextMessage({
      sessionId,
      to: receiver,
      isGroup: !!isGroup,
      text,
    });

    res.status(200).json(
      responseSuccessWithData({
        id: send?.key?.id,
        status: send?.status,
        message: send?.message?.extendedTextMessage?.text || 'Not Text',
        remoteJid: send?.key?.remoteJid,
      })
    );
  } catch (error) {
    next(error);
  }
};

export const SessionAutoSendMessage = async (
  req: Request,
  res: Response,
  next: NextFunction
) => {
  try {
    let to = req.body.to || req.query.to;
    let text = req.body.text || req.query.text;
    let isGroup = req.body.isGroup || req.query.isGroup;
    const sessions = whatsapp.getAllSession();

    const sessionId = !isEmpty(sessions) ? sessions[0] : false;

    if (!to || !text) throw new ValidationError('Missing Parameters', 401);

    const receiver = to;
    if (!sessionId) throw new ValidationError('Session Not Found', 404);

    const send = await whatsapp.sendTextMessage({
      sessionId,
      to: receiver,
      isGroup: !!isGroup,
      text,
    });

    res.status(200).json(
      responseSuccessWithData({
        id: send?.key?.id,
        status: send?.status,
        message: send?.message?.extendedTextMessage?.text || 'Not Text',
        remoteJid: send?.key?.remoteJid,
      })
    );
  } catch (error) {
    next(error);
  }
};

export const sendBulkMessage = async (
  req: Request,
  res: Response,
  next: NextFunction
) => {
  try {
    const sessionId =
      req.body.session || req.query.session || req.headers.session;
    const delay = req.body.delay || req.query.delay || req.headers.delay;

    if (!sessionId) {
      return res.status(400).json({
        status: false,
        data: {
          error: 'Session Not Found',
        },
      });
    }

    res.status(200).json({
      status: true,
      data: {
        message: 'Bulk Message is Processing',
      },
    });

    for (const dt of req.body.data) {
      const to = dt.to;
      const text = dt.text;
      const isGroup = !!dt.isGroup;

      await whatsapp.sendTextMessage({
        sessionId,
        to: to,
        isGroup: isGroup,
        text: text,
      });

      await whatsapp.createDelay(delay ?? 1000);
    }

    console.log('SEND BULK MESSAGE WITH DELAY SUCCESS');
  } catch (error) {
    next(error);
  }
};
