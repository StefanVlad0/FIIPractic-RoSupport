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
                        a.textContent = user.name;
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
