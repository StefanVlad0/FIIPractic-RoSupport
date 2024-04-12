function toggleMessengerDrawer() {
    var drawer = document.getElementById('messengerDrawer');
    if (drawer.style.display === "none") {
        $.ajax({
            url: '/messenger/users',
            type: 'GET',
            dataType: 'json',
            success: function(users) {
                while (drawer.firstChild) {
                    drawer.removeChild(drawer.firstChild);
                }

                for (var key in users) {
                    if (users.hasOwnProperty(key)) {
                        var user = users[key];
                        var a = document.createElement('a');
                        a.href = '/message/' + user.name;
                        a.className = 'user-div';

                        var profileDiv = document.createElement('div');
                        profileDiv.className = 'profile-div';

                        if (user.profile_image) {
                            var img = document.createElement('img');
                            img.src = '/images/' + user.profile_image;
                            img.className = 'user-img';
                            profileDiv.appendChild(img);
                        } else {
                            var icon = document.createElement('i');
                            icon.className = 'fas fa-user-circle';
                            icon.style.fontSize = '30px';
                            profileDiv.appendChild(icon);
                        }

                        var name = document.createElement('p');
                        name.textContent = user.name;
                        name.className = 'user-name';
                        profileDiv.appendChild(name);

                        a.appendChild(profileDiv);

                        var messageDiv = document.createElement('div');
                        messageDiv.className = 'message-div';

                        var message = document.createElement('p');
                        message.textContent = user.last_message ? (user.last_sender_id == user.id ? user.name : 'You') + ': ' + user.last_message : '';
                        message.className = 'user-message';
                        messageDiv.appendChild(message);

                        a.appendChild(messageDiv);
                        drawer.appendChild(a);
                    }
                }
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
