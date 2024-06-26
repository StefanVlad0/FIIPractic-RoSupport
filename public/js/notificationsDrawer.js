function toggleNotificationDrawer() {
    var drawer = document.getElementById('notificationDrawer');
    if (drawer.style.display === "none") {
        $.ajax({
            url: '/notifications',
            type: 'GET',
            dataType: 'json',
            success: function(notifications) {
                while (drawer.firstChild) {
                    drawer.removeChild(drawer.firstChild);
                }

                if (notifications.length === 0) {
                    var noNotifications = document.createElement('p');
                    noNotifications.textContent = 'No notifications';
                    noNotifications.className = 'no-notifications';
                    drawer.appendChild(noNotifications);
                } else {
                    for (var key in notifications) {
                        if (notifications.hasOwnProperty(key)) {
                            var notification = notifications[key];
                            var div = document.createElement('div');
                            div.className = 'notification-div';

                            var content = document.createElement('p');
                            content.textContent = notification.content;
                            content.className = 'notification-content';
                            div.appendChild(content);

                            drawer.appendChild(div);

                            markNotificationAsSeen(notification.id);
                        }
                    }
                }

                $('.notification-dot').remove();

                drawer.style.display = "block";
            },
            error: function(error) {
                console.error(error);
            }
        });

    } else {
        drawer.style.display = "none";
    }
}

function markNotificationAsSeen(notificationId) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/notifications/' + notificationId,
        type: 'PATCH',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: { seen: true },
        success: function(response) {
            console.log('Notification marked as seen:', response);
        },
        error: function(error) {
            console.error('Error marking notification as seen:', error);
        }
    });
}
