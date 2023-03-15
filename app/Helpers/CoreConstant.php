<?php

#region [Admin table constants]
const ADMIN__ACTIVE = 1;
const ADMIN__INACTIVE = 0;
#endregion

#region [Reset Password table constants]

const USER__ACTIVE = 1;
const USER__DEACTIVATE = 0;
const FORGET_PASSWORD_USED = 1;
const FORGET_PASSWORD_NOT_USED = 0;

const FORGET_PASSWORD_TYPE_ADMIN = 2;
const FORGET_PASSWORD_TYPE_USER = 2;

const FOR_USER = 1;

const USER_TYPE__DEFAULT = 1;
const USER_TYPE__REGISTRATION = 2;

#endregion



const GATEWAY_PROVIDER_TYPE_IS_ONESIGNAL = 1;
const GATEWAY_PROVIDER_TYPE_IS_SENDGRID = 2;
const DEFAULT_LIMIT_PACKAGE_TYPE__DEFAULT = 1;

#endregion




#region [Web App table constants]
const STATUS__ACTIVE = 1;
const STATUS__INACTIVE = 0;
#endregion

#region [Default Limits table constants]
//const DEFAULT_LIMIT_PACKAGE_TYPE__DEFAULT = 1;
#endregion

#region [Broadcasts table constants]
//1 = running, 2 = send, 3 = `delivered, 4 = failed',
const BROADCAST_STATUS_PENDING = 0;
const BROADCAST_STATUS_RUNNING = 1;
const BROADCAST_STATUS_SEND = 2;
const BROADCAST_STATUS_DELIVERED = 3;
const BROADCAST_STATUS_FAILED = 4;

const BROADCAST_SEND_TYPE_INSTANT = 1;
const BROADCAST_SEND_TYPE_SCHEDULE = 2;
const BROADCAST_SEND_TYPE_DRAFT= 2;

// Compare constant
const BROADCAST_TYPE_SENT= 2;
const BROADCAST_TYPE_SCHEDULE= 3;
#endregion


const SENDGRID = 2;


