#!/bin/bash
# ==============================================================================
# Скрипт автоматического бэкапа informnews.kz на Google Диск
# Создает дамп MySQL из Docker-контейнера и архивирует медиа (public/uploads)
# ==============================================================================

set -e

# Настройки путей
PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
BACKUP_TMP_DIR="/tmp/informnews_backup"
DATE=$(date +"%Y-%m-%d_%H-%M-%S")
BACKUP_NAME="informnews_backup_${DATE}"
ARCHIVE_PATH="${BACKUP_TMP_DIR}/${BACKUP_NAME}.tar.gz"

# Настройки Google Диска (rclone remote:папка)
RCLONE_REMOTE="gdrive:informnews_backups"

# Сколько дней хранить бэкапы на Google Диске (например, 180 дней = полгода еженедельных бэкапов)
RETENTION_DAYS="180d"

# Загружаем переменные окружения (.env)
if [ -f "${PROJECT_DIR}/.env" ]; then
    export $(grep -v '^#' "${PROJECT_DIR}/.env" | xargs)
fi

DB_CONTAINER="informnews_db"
DB_NAME="${DB_NAME:-qyzylorda_times}"
DB_ROOT_PASS="${DB_ROOT_PASS:-qyzylorda_root_pass_2026}"

echo "=================================================="
echo "🕒 Начало бэкапа: $(date)"
echo "📁 Проект: $PROJECT_DIR"
echo "=================================================="

# 1. Создаем временную папку
mkdir -p "${BACKUP_TMP_DIR}/${BACKUP_NAME}"

# 2. Создаем дамп базы данных MySQL из контейнера
echo "📦 1/4. Создание дампа базы данных ($DB_NAME)..."
docker exec "$DB_CONTAINER" mysqldump -u root -p"$DB_ROOT_PASS" "$DB_NAME" > "${BACKUP_TMP_DIR}/${BACKUP_NAME}/database.sql"

# 3. Копируем папку с загруженными медиафайлами и .env
echo "🖼️ 2/4. Копирование медиафайлов и конфигурации..."
if [ -d "${PROJECT_DIR}/public/uploads" ]; then
    cp -r "${PROJECT_DIR}/public/uploads" "${BACKUP_TMP_DIR}/${BACKUP_NAME}/"
fi
if [ -f "${PROJECT_DIR}/.env" ]; then
    cp "${PROJECT_DIR}/.env" "${BACKUP_TMP_DIR}/${BACKUP_NAME}/env_backup"
fi

# 4. Упаковываем всё в один сжатый архив
echo "🗜️ 3/4. Сжатие в архив ${BACKUP_NAME}.tar.gz..."
tar -czf "$ARCHIVE_PATH" -C "$BACKUP_TMP_DIR" "$BACKUP_NAME"

# 5. Отправка на Google Диск через rclone
echo "☁️ 4/4. Загрузка архива на Google Диск (${RCLONE_REMOTE})..."
rclone copy "$ARCHIVE_PATH" "$RCLONE_REMOTE" --progress

# 6. Очистка старых копий на Google Диске
echo "🧹 Очистка бэкапов старше ${RETENTION_DAYS} на Google Диске..."
rclone delete --min-age "$RETENTION_DAYS" "$RCLONE_REMOTE" 2>/dev/null || true

# 7. Очистка временных файлов на сервере
echo "✨ Удаление временных файлов на сервере..."
rm -rf "${BACKUP_TMP_DIR}"

echo "=================================================="
echo "✅ Бэкап успешно завершен и загружен на Google Диск!"
echo "🕒 Завершено: $(date)"
echo "=================================================="
