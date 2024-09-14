/*==============================================================*/
/* DBMS name:      PostgreSQL 9.x                               */
/* Created on:     10.09.2024 8:31:30                           */
/*==============================================================*/


drop index stores_chats_users_FK;

drop index chats_PK;

drop table chats;

drop index stores_doctors_FK;

drop index store_specialization_FK;

drop index doctors_PK;

drop table doctors;

drop index stores_users_message_FK;

drop index stores_chats_message_FK;

drop index messages_PK;

drop table messages;

drop index stores_pacient_FK;

drop index pacient_PK;

drop table pacient;

drop index specialization_PK;

drop table specialization;

drop index users_PK;

drop table users;

/*==============================================================*/
/* Table: chats                                                 */
/*==============================================================*/
create table chats (
   chats_id             SERIAL               not null,
   user_id              INT4                 null,
   created_at           DATE                 null,
   updated_at           DATE                 null,
   status_chats         BOOL                 null,
   constraint PK_CHATS primary key (chats_id)
);

/*==============================================================*/
/* Index: chats_PK                                              */
/*==============================================================*/
create unique index chats_PK on chats (
chats_id
);

/*==============================================================*/
/* Index: stores_chats_users_FK                                 */
/*==============================================================*/
create  index stores_chats_users_FK on chats (
user_id
);

/*==============================================================*/
/* Table: doctors                                               */
/*==============================================================*/
create table doctors (
   doctor_id            SERIAL               not null,
   specialization_id    INT4                 null,
   user_id              INT4                 null,
   bio                  VARCHAR(255)         null,
   education            VARCHAR(200)         null,
   shchedule            DATE                 null,
   constraint PK_DOCTORS primary key (doctor_id)
);

/*==============================================================*/
/* Index: doctors_PK                                            */
/*==============================================================*/
create unique index doctors_PK on doctors (
doctor_id
);

/*==============================================================*/
/* Index: store_specialization_FK                               */
/*==============================================================*/
create  index store_specialization_FK on doctors (
specialization_id
);

/*==============================================================*/
/* Index: stores_doctors_FK                                     */
/*==============================================================*/
create  index stores_doctors_FK on doctors (
user_id
);

/*==============================================================*/
/* Table: messages                                              */
/*==============================================================*/
create table messages (
   messages_id          SERIAL               not null,
   chats_id             INT4                 null,
   user_id              INT4                 null,
   message              VARCHAR(255)         null,
   "timestamp"          DATE                 null,
   messages_image       VARCHAR(200)         null,
   constraint PK_MESSAGES primary key (messages_id)
);

/*==============================================================*/
/* Index: messages_PK                                           */
/*==============================================================*/
create unique index messages_PK on messages (
messages_id
);

/*==============================================================*/
/* Index: stores_chats_message_FK                               */
/*==============================================================*/
create  index stores_chats_message_FK on messages (
chats_id
);

/*==============================================================*/
/* Index: stores_users_message_FK                               */
/*==============================================================*/
create  index stores_users_message_FK on messages (
user_id
);

/*==============================================================*/
/* Table: pacient                                               */
/*==============================================================*/
create table pacient (
   patient_id           SERIAL               not null,
   user_id              INT4                 null,
   fio                  VARCHAR(200)         null,
   constraint PK_PACIENT primary key (patient_id)
);

/*==============================================================*/
/* Index: pacient_PK                                            */
/*==============================================================*/
create unique index pacient_PK on pacient (
patient_id
);

/*==============================================================*/
/* Index: stores_pacient_FK                                     */
/*==============================================================*/
create  index stores_pacient_FK on pacient (
user_id
);

/*==============================================================*/
/* Table: specialization                                        */
/*==============================================================*/
create table specialization (
   specialization_id    SERIAL               not null,
   name_specialization  VARCHAR(255)         not null,
   constraint PK_SPECIALIZATION primary key (specialization_id)
);

/*==============================================================*/
/* Index: specialization_PK                                     */
/*==============================================================*/
create unique index specialization_PK on specialization (
specialization_id
);

/*==============================================================*/
/* Table: users                                                 */
/*==============================================================*/
create table users (
   user_id              SERIAL               not null,
   fio                  VARCHAR(200)         not null,
   login                VARCHAR(200)         not null,
   email                VARCHAR(200)         null,
   hash_password        VARCHAR(255)         null,
   role                 VARCHAR(100)         null,
   constraint PK_USERS primary key (user_id)
);

/*==============================================================*/
/* Index: users_PK                                              */
/*==============================================================*/
create unique index users_PK on users (
user_id
);

alter table chats
   add constraint FK_CHATS_STORES_CH_USERS foreign key (user_id)
      references users (user_id)
      on delete restrict on update restrict;

alter table doctors
   add constraint FK_DOCTORS_STORE_SPE_SPECIALI foreign key (specialization_id)
      references specialization (specialization_id)
      on delete restrict on update restrict;

alter table doctors
   add constraint FK_DOCTORS_STORES_DO_USERS foreign key (user_id)
      references users (user_id)
      on delete restrict on update restrict;

alter table messages
   add constraint FK_MESSAGES_STORES_CH_CHATS foreign key (chats_id)
      references chats (chats_id)
      on delete restrict on update restrict;

alter table messages
   add constraint FK_MESSAGES_STORES_US_USERS foreign key (user_id)
      references users (user_id)
      on delete restrict on update restrict;

alter table pacient
   add constraint FK_PACIENT_STORES_PA_USERS foreign key (user_id)
      references users (user_id)
      on delete restrict on update restrict;

