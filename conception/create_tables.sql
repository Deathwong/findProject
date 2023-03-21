/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  17/02/2023 18:13:55                      */
/*==============================================================*/

drop table if exists categorie_annonce;

drop table if exists categorie;

drop table if exists favoris;

drop table if exists message;

drop table if exists annonce;

drop table if exists user;

/*==============================================================*/
/* Table : annonce                                              */
/*==============================================================*/
create table annonce
(
    ann_id                  bigint       not NULL AUTO_INCREMENT,
    use_id                  bigint,
    ann_nom                 varchar(100) not null,
    ann_prix                int          not null,
    ann_description         text         not null,
    ann_photo               varchar(100),
    ann_nombre_consultation bigint,
    ann_create_at           datetime     not null,
    ann_update_at           datetime,
    primary key (ann_id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/*==============================================================*/
/* Table : categorie                                            */
/*==============================================================*/
create table categorie
(
    cat_id      bigint       not NULL AUTO_INCREMENT,
    cat_libelle varchar(100) not null,
    primary key (cat_id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/*==============================================================*/
/* Table : categorie_annonce                                    */
/*==============================================================*/
create table categorie_annonce
(
    ann_id bigint not null,
    cat_id bigint not null,
    primary key (ann_id, cat_id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/*==============================================================*/
/* Table : favoris                                              */
/*==============================================================*/
create table favoris
(
    fav_id bigint not null AUTO_INCREMENT,
    ann_id bigint not null,
    use_id bigint not null,
    primary key (fav_id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/*==============================================================*/
/* Table : message                                              */
/*==============================================================*/
create table message
(
    mes_id          bigint       not NULL AUTO_INCREMENT,
    ann_id          bigint(20)   not null,
    mes_sender_id   bigint       not null,
    use_receiver_id bigint       not null,
    mes_content     varchar(255) not null,
    mes_create_at   datetime     not null,
    primary key (mes_id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/*==============================================================*/
/* Table : user                                                 */
/*==============================================================*/
create table user
(
    use_id       bigint       not NULL AUTO_INCREMENT,
    use_email    varchar(100) not null,
    use_password varchar(50)  not null,
    primary key (use_id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

alter table annonce
    add constraint fk_annonce_relation__user foreign key (use_id)
        references user (use_id) on delete restrict on update restrict;

alter table categorie_annonce
    add constraint fk_categori_relation__annonce foreign key (ann_id)
        references annonce (ann_id) on delete restrict on update restrict;

alter table categorie_annonce
    add constraint fk_categori_relation__categori foreign key (cat_id)
        references categorie (cat_id) on delete restrict on update restrict;

alter table favoris
    add constraint fk_favoris_relation__user foreign key (use_id)
        references user (use_id) on delete restrict on update restrict;

alter table favoris
    add constraint fk_favoris_relation__annonce foreign key (ann_id)
        references annonce (ann_id) on delete restrict on update restrict;

alter table message
    add constraint fk_message_relation__user foreign key (mes_sender_id)
        references user (use_id) on delete restrict on update restrict;

alter table message
    add constraint fk_message_relation_receiver__user foreign key (use_receiver_id)
        references user (use_id) on delete restrict on update restrict;

alter table message
    add constraint fk_message_relation__annonce foreign key (ann_id)
        references annonce (ann_id) on delete restrict on update restrict;