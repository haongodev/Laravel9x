# Hướng Dẫn Cài Đặt và Chạy Dự Án Training Management với Node.js, Socket, và Docker

## Mục Lục
1. [Yêu Cầu](#yêu-cầu)
2. [Cài Đặt Docker và Docker Compose](#cài-đặt-docker-và-docker-compose)
3. [Cài đặt các thư viện và cấu hình môi trường](#cấu-hình-môi-trường)
4. [Chạy WebSocket Server với Node.js](#chạy-websocket-server-với-nodejs)

---

## Yêu Cầu

Trước khi bắt đầu, hãy chắc chắn rằng bạn đã cài đặt các công cụ sau:

- **PHP 8.0.1** hoặc cao hơn.
- **Laravel 9.19**.
- **Docker** và **Docker Compose** (tải từ [Docker website](https://www.docker.com/get-started)).
- **Node.js v16** (với Laravel Mix).
- **Redis**, **MySQL**, **Meilisearch**, **Mailpit**, **Selenium**.

## Cài Đặt Docker và Docker Compose

1. Cài đặt **Docker** và **Docker Compose** từ các liên kết chính thức:
   - [Docker Download](https://www.docker.com/get-started)
   - [Docker Compose](https://docs.docker.com/compose/install/)

2. Kiểm tra phiên bản Docker và Docker Compose:

   ```bash
   docker --version
   docker-compose --version
   
3. Build và tạo các image:

   ```bash
   docker-compose up -d --build

## Cài đặt các thư viện và cấu hình môi trường

1. Cấu hình môi trường:
    
   ```bash
    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=training_management
    DB_USERNAME=root
    DB_PASSWORD=   
2. Cài đặt các thư viện:
    
   ```bash
    composer i
    
2. Cài Đặt và Cấu Hình Laravel Mix:
    
   ```bash
    npm i 
    npm run build

## Chạy WebSocket Server với Node.js
    

Mở thư mục /resources/js/bootstrap.js và thay đổi thông tin port

    ``` bash
    window.Echo = new Echo({
        broadcaster: "socket.io",
        host: window.location.hostname + ':6001',
        client: io
    });
    
    
    
