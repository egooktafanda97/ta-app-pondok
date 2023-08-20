import { Request, Response, NextFunction } from 'express';
import { toDataURL } from 'qrcode';
import * as whatsapp from 'wa-multi-session';
import ValidationError from '../../utils/error';
import {
  responseSuccessWithMessage,
  responseSuccessWithData,
} from '../../utils/response';
import UserConnection from '../models/UserConnections';
import MessageConnection from '../models/Message';

export const createSession = async (
  req: Request,
  res: Response,
  next: NextFunction
): Promise<void> => {
  try {
    const scan = req.query.scan;
    const sessionName =
      req.body.session || req.query.session || req.headers.session;
    if (!sessionName) {
      throw new Error('Bad Request');
    }
    whatsapp.onQRUpdated(async (data: any) => {
      if (res && !res.headersSent) {
        const qr = await toDataURL(data.qr);
        if (scan && data.sessionId === sessionName) {
          res.status(200).json({
            status: true,
            data: {
              qr: qr,
            },
          });
        } else {
          res.status(200).json(
            responseSuccessWithData({
              qr: qr,
            })
          );
        }
      }
    });
    await whatsapp.startSession(sessionName, { printQR: true });
  } catch (error) {
    next(error);
  }
};

export const getSession = async (
  req: Request,
  res: Response,
  next: NextFunction
): Promise<void> => {
  try {
    const sessions = whatsapp.getAllSession();

    await UserConnection.create({
      phone: '123456789',
      session_name: 'Session 1',
      status_connecting: true,
    });

    const dummyData: any = {
      remoteJid: '6281234567890@s.whatsapp.net',
      name: 'John Doe',
      fromMe: false,
      from: '6289876543210@s.whatsapp.net',
      to: '6281234567890@s.whatsapp.net',
      text: 'Hello, how are you?',
      status_connecting: false,
      messageTimestamp: Math.floor(Date.now() / 1000),
      UserConnectionId: 1, // Assign user connection ID
    };

    await MessageConnection.create(dummyData);

    res.status(200).json(sessions);
  } catch (error) {
    next(error);
  }
};

export const deleteSession = async (
  req: Request,
  res: Response,
  next: NextFunction
): Promise<void> => {
  try {
    const sessionName =
      req.body.session || req.query.session || req.headers.session;
    if (!sessionName) {
      throw new ValidationError('session Required', 500);
    }
    whatsapp.deleteSession(sessionName);
    res
      .status(200)
      .json(responseSuccessWithMessage('Success Deleted ' + sessionName));
  } catch (error) {
    next(error);
  }
};
