CREATE DATABASE IF NOT EXISTS laravel_master;
USE laravel_master;
CREATE TABLE users(
    id int(255) AUTO_INCREMENT NOT NULL ,
    role varchar(20),
    name varchar(100),
    surname varchar(200),
    nick varchar(100),
    email varchar(255),
    password varchar(255),
    image varchar(255),
    created_at DATETIME,
    updated_at DATETIME,
    remember_token varchar(255),
    CONSTRAINT pk_users PRIMARY KEY (id),
    CONSTRAINT uq_email UNIQUE (email)
)ENGINE = InnoDB;

INSERT INTO users VALUES (
    NULL,
  'user',
  'Jhon',
  'Doe',
  'JhonD',
  'jhon.d@mail.com',
  '123456',
  NULL,
  CURTIME(),
  CURTIME(),
  NULL
);
INSERT INTO users VALUES (
    NULL,
  'user',
  'Jane',
  'Smith',
  'JaneS',
  'jane.s@mail.com',
  '123456',
  NULL,
  CURTIME(),
  CURTIME(),
  NULL
);
INSERT INTO users VALUES (
    NULL,
  'user',
  'Michael',
  'Johnson',
  'MichaelJ',
  'michael.j@mail.com',
  '123456',
  NULL,
  CURTIME(),
  CURTIME(),
  NULL
);

CREATE TABLE IF NOT EXISTS images(
    id int(255) AUTO_INCREMENT NOT NULL,
    user_id int(255),
    image_path varchar(255),
    description TEXT,
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT pk_images PRIMARY KEY (id),
    CONSTRAINT fk_images_uers FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE IF NOT EXISTS comments(
    id int(255) AUTO_INCREMENT NOT NULL,
    user_id int(255),
    image_id int(255),
    content TEXT,
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT pk_comments PRIMARY KEY (id),
    CONSTRAINT fk_comments_users FOREIGN KEY (image_id) REFERENCES users(id),
    CONSTRAINT fk_comments_images FOREIGN KEY (user_id) REFERENCES images(id)
)ENGINE = InnoDb;

CREATE TABLE IF NOT EXISTS likes(
    id int(255) AUTO_INCREMENT NOT NULL,
    user_id int(255),
    image_id int(255),
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT pk_likes PRIMARY KEY (id),
    CONSTRAINT fk_likes_users FOREIGN KEY (image_id) REFERENCES users(id),
    CONSTRAINT fk_likes_images FOREIGN KEY (user_id) REFERENCES images(id)
)ENGINE = InnoDb;
