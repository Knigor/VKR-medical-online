import socketio
import aiohttp
from aiohttp import web
from datetime import datetime
import pytz

# Инициализация WebSocket-сервера
sio = socketio.AsyncServer(cors_allowed_origins="*")
app = web.Application()
sio.attach(app)


chats = {}  
connected_users = {}

# МСК часовой пояс
moscow_tz = pytz.timezone('Europe/Moscow')

# Подключение пользователя
@sio.event
async def connect(sid, environ):
    print(f'Клиент {sid} подключен')

# Отключение пользователя
@sio.event
async def disconnect(sid):
    username = connected_users.pop(sid, None)
    print(f'Клиент {sid} ({username}) отключен')

# Обработчик входа в чат
@sio.event
async def login(sid, data):
    username = data.get('username')
    if username:
        connected_users[sid] = username
        print(f'{username} вошел в чат')

# Обработчик входа в комнату (чат между двумя пользователями)
@sio.event
async def join_chat(sid, data):
    chat_id = data.get("chat_id")
    username = connected_users.get(sid)
    if not chat_id:
        chat_id = f"chat_{username}_{data.get('receiver')}"  # Генерация ID для чата

    await sio.enter_room(sid, chat_id)
    print(f'{username} присоединился к чату {chat_id}')

    # Отправка истории сообщений чата
    chat_history = chats.get(chat_id, [])
    await sio.emit("chat_history", {"history": chat_history}, room=sid)

# Обработчик сообщений
@sio.event
async def message(sid, data):
    sender = connected_users.get(sid, "Unknown")
    receiver = data.get("receiver")
    chat_id = data.get("chat_id")  # Используем переданный chat_id
    text = data.get("message", "")
    image = data.get("image", None)  # Опционально (если отправляется картинка)

    # Текущее время в МСК
    timestamp = datetime.now(moscow_tz).strftime('%Y-%m-%d %H:%M:%S')

    # Сохранение сообщения в истории чата
    message_data = {"username": sender, "message": text, "image": image, "timestamp": timestamp}
    chats.setdefault(chat_id, []).append(message_data)

    # Отправка сообщения всем в комнате
    await sio.emit("message", message_data, room=chat_id)

# Запуск WebSocket-сервера
if __name__ == '__main__':
    web.run_app(app, port=5000)
