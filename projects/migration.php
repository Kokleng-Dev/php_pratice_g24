<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");


const CREATE_TABLE_USER = "CREATE TABLE IF NOT EXISTS users(
    id int not null auto_increment primary key,
    name varchar(100) not null,
    username varchar(100) not null,
    password varchar(100) not null,
    photo varchar(255) null
)";

const CREATE_TABLE_CUSTOMERS = "CREATE TABLE IF NOT EXISTS customers(
    id int not null auto_increment primary key,
    name varchar(100) not null,
    photo varchar(255) null
)";

const CREAT_TABLE_PRODUCT_CATEGORIES = "CREATE TABLE IF NOT EXISTS product_categories(
    id int not null auto_increment primary key,
    name varchar(100) not null,
    photo varchar(255) null
)";

const CREAT_TABLE_PRODUCTS = "CREATE TABLE IF NOT EXISTS products(
    id int not null auto_increment primary key,
    product_category_id int not null,
    name varchar(100) not null,
    price float(15,2) not null,
    photo varchar(255) null,
    created_at timestamp not null,
    created_by int not null
)";

const CREATE_TABLE_PRODUCT_ORDERS = "CREATE TABLE IF NOT EXISTS product_orders(
    id int not null auto_increment primary key,
    customer_id int not null,
    inv_code varchar(255) not null,
    grand_total float(15,2) not null,
    active int not null default 1 comment '1:active, 0:delete',
    created_at timestamp not null,
    created_by int not null,
    updated_at timestamp null,
    updated_by int null,
    deleted_at timestamp null,
    deleted_by int null
)";

const CREATE_TABLE_PRODUCT_ORDER_DETAILS = "CREATE TABLE IF NOT EXISTS product_order_details(
    id int not null auto_increment primary key,
    product_order_id varchar(255) not null,
    product_id int not null,
    price float(15,2) not null,
    qty float(15,2) not null,
    total_price float(15,2)
)";

$mysql->query(CREATE_TABLE_USER);
$mysql->query(CREATE_TABLE_CUSTOMERS);
$mysql->query(CREAT_TABLE_PRODUCT_CATEGORIES);
$mysql->query(CREAT_TABLE_PRODUCTS);
$mysql->query(CREATE_TABLE_PRODUCT_ORDERS);
$mysql->query(CREATE_TABLE_PRODUCT_ORDER_DETAILS);


?>