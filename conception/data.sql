-- Suppression des anciens données dans les tables

SET FOREIGN_KEY_CHECKS = 0;

truncate table categorie_annonce;

truncate table message;

truncate table favoris;

truncate table categorie;

truncate table annonce;

truncate table user;

SET FOREIGN_KEY_CHECKS = 1;


/*==============================================================*/
/* Table : user                                              	*/
/*==============================================================*/
insert into user (use_id, use_email, use_password)
values (1, 'jean@gmail.com', '21232f297a57a5a743894a0e4a801fc3');
insert into user (use_id, use_email, use_password)
values (2, 'jean@gmail.com', '21232f297a57a5a743894a0e4a801fc3');
insert into user (use_id, use_email, use_password)
values (3, 'jean@gmail.com', '21232f297a57a5a743894a0e4a801fc3');
insert into user (use_id, use_email, use_password)
values (4, 'jean@gmail.com', '21232f297a57a5a743894a0e4a801fc3');


/*==============================================================*/
/* Table : annonce                                              */
/*==============================================================*/
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (1, 1, 'nom', 15, 'description', 'annonce1', 1, '1740-8-9 17:15:35', '1740-8-9 17:15:35');
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (2, 1, 'nom', 16, 'description', 'annonce2', 1, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (3, 1, 'nom', 17, 'description', 'annonce3', 2, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (4, 1, 'nom', 18, 'description', 'annonce4', 3, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (5, 1, 'nom', 19, 'description', 'annonce5', 3, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (6, 1, 'nom', 20, 'description', 'annonce6', 4, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (7, 2, 'nom', 21, 'description', 'annonce7', 4, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (8, 2, 'nom', 22, 'description', 'annonce8', 5, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (9, 2, 'nom', 23, 'description', 'annonce9', 5, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (10, 2, 'nom', 24, 'description', 'annonce10', 5, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (11, 2, 'nom', 25, 'description', 'annonce11', 5, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (12, 2, 'nom', 26, 'description', 'annonce12', 6, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (13, 3, 'nom', 27, 'description', 'annonce13', 6, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (14, 3, 'nom', 28, 'description', 'annonce14', 6, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (15, 3, 'nom', 29, 'description', 'annonce15', 7, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (16, 3, 'nom', 30, 'description', 'annonce16', 7, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (17, 3, 'nom', 31, 'description', 'annonce17', 7, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (18, 3, 'nom', 32, 'description', 'annonce18', 8, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (19, 4, 'nom', 33, 'description', 'annonce19', 8, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (20, 4, 'nom', 34, 'description', 'annonce20', 8, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (21, 4, 'nom', 35, 'description', 'annonce21', 9, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (22, 4, 'nom', 36, 'description', 'annonce22', 9, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (23, 4, 'nom', 37, 'description', 'annonce23', 10, now(), now());
insert into annonce (ann_id, use_id, ann_nom, ann_prix, ann_description, ann_photo, ann_nombre_consultation,
                     ann_create_at, ann_update_at)
values (24, 4, 'nom', 38, 'description', 'annonce24', 10, now(), now());



/*==============================================================*/
/* Table : categorie                                            */
/*==============================================================*/
insert into categorie (cat_id, cat_libelle)
values (1, 'Informatique');
insert into categorie (cat_id, cat_libelle)
values (2, 'Electro-ménager');
insert into categorie (cat_id, cat_libelle)
values (3, 'Immobilier');


/*==============================================================*/
/* Table : favoris                                            	*/
/*==============================================================*/
insert into favoris (fav_id, ann_id, use_id)
values (1, 1, 1);
insert into favoris (fav_id, ann_id, use_id)
values (2, 1, 2);
insert into favoris (fav_id, ann_id, use_id)
values (3, 1, 3);
insert into favoris (fav_id, ann_id, use_id)
values (4, 1, 4);
insert into favoris (fav_id, ann_id, use_id)
values (5, 1, 5);
insert into favoris (fav_id, ann_id, use_id)
values (6, 1, 6);
insert into favoris (fav_id, ann_id, use_id)
values (7, 1, 1);
insert into favoris (fav_id, ann_id, use_id)
values (8, 1, 2);
insert into favoris (fav_id, ann_id, use_id)
values (9, 1, 3);
insert into favoris (fav_id, ann_id, use_id)
values (10, 2, 4);
insert into favoris (fav_id, ann_id, use_id)
values (11, 2, 5);
insert into favoris (fav_id, ann_id, use_id)
values (12, 2, 6);
insert into favoris (fav_id, ann_id, use_id)
values (13, 2, 1);
insert into favoris (fav_id, ann_id, use_id)
values (14, 2, 2);
insert into favoris (fav_id, ann_id, use_id)
values (15, 2, 3);
insert into favoris (fav_id, ann_id, use_id)
values (16, 2, 4);
insert into favoris (fav_id, ann_id, use_id)
values (17, 3, 5);
insert into favoris (fav_id, ann_id, use_id)
values (18, 3, 6);
insert into favoris (fav_id, ann_id, use_id)
values (19, 3, 1);
insert into favoris (fav_id, ann_id, use_id)
values (20, 3, 2);
insert into favoris (fav_id, ann_id, use_id)
values (21, 3, 3);
insert into favoris (fav_id, ann_id, use_id)
values (22, 3, 4);
insert into favoris (fav_id, ann_id, use_id)
values (23, 3, 5);
insert into favoris (fav_id, ann_id, use_id)
values (24, 3, 6);


/*==============================================================*/
/* Table : message	                                            */
/*==============================================================*/
insert into message (mes_id, mes_sender_id, use_receiver_id, mes_content, mes_create_at)
values (1, 1, 2, 'message', '2023-01-14 7:0:0');
insert into message (mes_id, mes_sender_id, use_receiver_id, mes_content, mes_create_at)
values (2, 2, 1, 'message', '2023-01-18 7:0:0');
insert into message (mes_id, mes_sender_id, use_receiver_id, mes_content, mes_create_at)
values (3, 3, 4, 'message', '2023-01-20 7:0:0');
insert into message (mes_id, mes_sender_id, use_receiver_id, mes_content, mes_create_at)
values (4, 4, 3, 'message', '2023-01-26 7:0:0');



/*==============================================================*/
/* Table : categorie_annonce                                    */
/*==============================================================*/
insert into categorie_annonce (ann_id, cat_id)
values (1, 1);
insert into categorie_annonce (ann_id, cat_id)
values (2, 1);
insert into categorie_annonce (ann_id, cat_id)
values (3, 1);
insert into categorie_annonce (ann_id, cat_id)
values (4, 1);
insert into categorie_annonce (ann_id, cat_id)
values (5, 1);
insert into categorie_annonce (ann_id, cat_id)
values (6, 1);
insert into categorie_annonce (ann_id, cat_id)
values (7, 1);
insert into categorie_annonce (ann_id, cat_id)
values (8, 1);
insert into categorie_annonce (ann_id, cat_id)
values (9, 2);
insert into categorie_annonce (ann_id, cat_id)
values (10, 2);
insert into categorie_annonce (ann_id, cat_id)
values (11, 2);
insert into categorie_annonce (ann_id, cat_id)
values (12, 2);
insert into categorie_annonce (ann_id, cat_id)
values (13, 2);
insert into categorie_annonce (ann_id, cat_id)
values (14, 2);
insert into categorie_annonce (ann_id, cat_id)
values (15, 2);
insert into categorie_annonce (ann_id, cat_id)
values (16, 2);
insert into categorie_annonce (ann_id, cat_id)
values (17, 3);
insert into categorie_annonce (ann_id, cat_id)
values (18, 3);
insert into categorie_annonce (ann_id, cat_id)
values (19, 3);
insert into categorie_annonce (ann_id, cat_id)
values (20, 3);
insert into categorie_annonce (ann_id, cat_id)
values (21, 3);
insert into categorie_annonce (ann_id, cat_id)
values (22, 3);
insert into categorie_annonce (ann_id, cat_id)
values (23, 3);
insert into categorie_annonce (ann_id, cat_id)
values (24, 3);
