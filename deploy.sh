#!/bin/bash
# Скрипт быстрой отправки проекта на VPS сервер
# Использование: ./deploy.sh [VPS_IP] [VPS_USER]
# Например: ./deploy.sh 213.155.20.184 root

VPS_IP="${1:-213.155.20.184}"
VPS_USER="${2:-root}"
REMOTE_DIR="/var/www/informnews"

echo "=================================================="
echo "🚀 Деплой проекта на VPS: $VPS_USER@$VPS_IP"
echo "📁 Директория на сервере: $REMOTE_DIR"
echo "=================================================="

# 1. Создаем директорию на сервере
echo "1️⃣  Создание директории на сервере..."
ssh "$VPS_USER@$VPS_IP" "mkdir -p $REMOTE_DIR"

# 2. Синхронизируем файлы проекта
echo "2️⃣  Синхронизация файлов..."
rsync -avz --progress \
    --exclude='.git' \
    --exclude='.vscode' \
    --exclude='.DS_Store' \
    --exclude='*.log' \
    ./ "$VPS_USER@$VPS_IP:$REMOTE_DIR/"

# 3. Запуск Docker Compose на сервере
echo "3️⃣  Сборка и запуск Docker контейнеров..."
ssh "$VPS_USER@$VPS_IP" "cd $REMOTE_DIR && docker compose up -d --build"

echo "=================================================="
echo "✅ Деплой успешно завершен!"
echo "🌐 Сайт доступен по адресу: http://$VPS_IP"
echo "🗄️  phpMyAdmin: http://$VPS_IP:8080"
echo "=================================================="

