(()=>{
const notificationTypes = ['status', 'error'];
window.notify = {
    container: document.getElementById('notifications-container'),
    notifications: [],
    limit: 3,
    clear: function() {
        while(notificationsContainer.lastChild) {
            notificationsContainer.lastChild.remove();
        }
    }
};

for(const type of notificationTypes) {
    window.notify[type] = function(text, noDuplicate) {
        if(this.notifications.length == this.limit) {
            this.container.children[this.container.children.length-1].remove();
            this.notifications.pop();
        }
        this.notifications.unshift({
            type,
            text
        })

        const notifEl = document.importNode(
            document.getElementById(`notification-${type}-template`).content,
            true
        );
        notifEl.querySelector('div').textContent = text;
        this.container.prepend(notifEl);
        console.log(this.notifications);
    }
}

})();