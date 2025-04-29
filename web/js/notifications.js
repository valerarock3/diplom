function showNotification(message, type = 'success') {
    // Создаем элемент уведомления
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    
    // Добавляем иконку в зависимости от типа уведомления
    const icon = type === 'success' ? 'check-circle' : 'exclamation-circle';
    
    // Формируем содержимое уведомления
    notification.innerHTML = `
        <i class="fas fa-${icon}"></i>
        <div class="notification-message">${message}</div>
        <div class="notification-close">&times;</div>
    `;
    
    // Добавляем уведомление на страницу
    document.body.appendChild(notification);
    
    // Показываем уведомление с небольшой задержкой (для анимации)
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // Добавляем обработчик для кнопки закрытия
    const closeButton = notification.querySelector('.notification-close');
    closeButton.addEventListener('click', () => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    });
    
    // Автоматически скрываем уведомление через 3 секунды
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
} 