/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     30/07/2018 6:58:04                           */
/*==============================================================*/


drop table if exists cubiculos;

drop table if exists dias;

drop table if exists estado_turno;

drop table if exists estudiantes;

drop table if exists historial_turnos;

drop table if exists horarios;

drop table if exists notifications;

drop table if exists password_resets;

drop table if exists turnos;

drop table if exists users;

/*==============================================================*/
/* Table: cubiculos                                             */
/*==============================================================*/
create table cubiculos
(
   id_cu                int not null auto_increment,
   detalle_cu           varchar(100),
   codigo_cu            varchar(10),
   primary key (id_cu)
);

/*==============================================================*/
/* Table: dias                                                  */
/*==============================================================*/
create table dias
(
   id_di                char(8) not null,
   fecha_di             date not null,
   primary key (id_di)
);

/*==============================================================*/
/* Table: estado_turno                                          */
/*==============================================================*/
create table estado_turno
(
   id_et                int not null auto_increment,
   nombre_et            varchar(100) not null,
   primary key (id_et)
);

/*==============================================================*/
/* Table: estudiantes                                           */
/*==============================================================*/
create table estudiantes
(
   cedula_es            varchar(10) not null,
   nombres_es           varchar(200),
   apellidos_es         varchar(200),
   celular_es           varchar(50),
   email_es             varchar(200),
   telefono_es          varchar(50),
   validado_es          bool default 0,
   primary key (cedula_es)
);

/*==============================================================*/
/* Table: historial_turnos                                      */
/*==============================================================*/
create table historial_turnos
(
   id_tu                char(32),
   id_et                int,
   id                   bigint,
   detalle_ht           varchar(500),
   fecha_ht             timestamp
);

/*==============================================================*/
/* Table: horarios                                              */
/*==============================================================*/
create table horarios
(
   id_ho                char(8) not null,
   id_di                char(8) not null,
   id                   bigint not null,
   inicio_ho            time not null,
   fin_ho               time not null,
   creado_ho            timestamp,
   primary key (id_ho)
);

/*==============================================================*/
/* Table: notifications                                         */
/*==============================================================*/
create table notifications
(
   id                   char(36) not null,
   notifiable_id        bigint,
   type                 varchar(300),
   notifiable_type      varchar(300),
   data                 text,
   read_at              datetime,
   updated_at           timestamp,
   created_at           timestamp,
   primary key (id)
);

/*==============================================================*/
/* Table: password_resets                                       */
/*==============================================================*/
create table password_resets
(
   email2               varchar(100),
   token                varchar(300),
   created_at           datetime
);

/*==============================================================*/
/* Table: turnos                                                */
/*==============================================================*/
create table turnos
(
   id_tu                char(32) not null,
   cedula_es            varchar(10),
   id_et                int not null,
   id_us                bigint,
   id_ho                char(8),
   creado_tu            timestamp default current_timestamp,
   actualizado_tu       timestamp default current_timestamp on update current_timestamp,
   qa_tu                int,
   inicio_tu            time not null,
   fin_tu               time not null,
   fecha_tu             date not null,
   nu_tu                int,
   primary key (id_tu)
);

/*==============================================================*/
/* Table: users                                                 */
/*==============================================================*/
create table users
(
   id                   bigint not null auto_increment,
   id_cu                int,
   name                 varchar(300),
   password             char(61),
   remember_token       varchar(100),
   created_at           datetime,
   updated_at           timestamp,
   email                varchar(100),
   status               bool default false,
   enabled              bool default false,
   queued               bool default false,
   primary key (id)
);

alter table historial_turnos add constraint fk_historial_estado_turno foreign key (id_et)
      references estado_turno (id_et) on delete restrict on update restrict;

alter table historial_turnos add constraint fk_historial_turno foreign key (id_tu)
      references turnos (id_tu) on delete restrict on update restrict;

alter table historial_turnos add constraint fk_usuario_historial foreign key (id)
      references users (id) on delete restrict on update restrict;

alter table horarios add constraint fk_dias_horas foreign key (id_di)
      references dias (id_di) on delete restrict on update restrict;

alter table horarios add constraint fk_usuario_horarios foreign key (id)
      references users (id) on delete restrict on update restrict;

alter table notifications add constraint fk_usuario_notificaciones foreign key (notifiable_id)
      references users (id) on delete restrict on update restrict;

alter table turnos add constraint fk_atendido foreign key (id_us)
      references users (id) on delete restrict on update restrict;

alter table turnos add constraint fk_estudiante_turno foreign key (cedula_es)
      references estudiantes (cedula_es) on delete restrict on update restrict;

alter table turnos add constraint fk_horarios_turnos foreign key (id_ho)
      references horarios (id_ho) on delete restrict on update restrict;

alter table turnos add constraint fk_turno_estado foreign key (id_et)
      references estado_turno (id_et) on delete restrict on update restrict;

alter table users add constraint fk_usuario_cubiculos foreign key (id_cu)
      references cubiculos (id_cu) on delete restrict on update restrict;

