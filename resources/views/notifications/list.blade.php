<div x-data="{
    notifications: [],
    hasNotificationsLeft: true,
    currentNotificationsPage: -1,
    nextNotificationsPageUrl: `/notifications`,
    loadNotifications() {
        if (!this.hasNotificationsLeft) {
            return;
        }

        axios
            .get(this.nextNotificationsPageUrl)
            .then((response) => {
                const { data: notifications, links, meta } = response.data;
                this.notifications = this.notifications.concat(notifications);
                this.currentNotificationsPage = meta.current_page;
                this.nextNotificationsPageUrl = links.next;

                if (meta.current_page == meta.last_page) {
                    this.hasNotificationsLeft = false;
                }
            })
            .catch((err) => {
                console.log(err);
            });
    },
    checkNotification(notification) {
        axios
            .put(`/notifications/${notification.id}`)
            .then(() => {
                $dispatch('notification-checked', {notificationId: notification.id})
            })
            .catch((err) => {
                console.log(err);
            });
    },
    markNotificationAsChecked(notificationId) {
        const notification = this.notifications.find(n => n.id === notificationId)
        if(notification) {
            notification.checked = true
        }
    }
}" x-init="loadNotifications" @notification-checked.window="markNotificationAsChecked($event.detail.notificationId)">
    <template x-for="notification in notifications" :key="notification.id">
        <div class="flex items-center border p-2 mb-3"
            :class="notification.checked ? 'bg-gray-50 border-gray-100' : 'bg-blue-50 border-blue-100'">
            <a class="mr-4" x-bind:href="notification.url">
                <img x-bind:src="notification.image_url" alt="Notificaiton image">
            </a>
            <div class="flex w-full justify-between items-center text-sm text-gray-800"
                :class="notification.checked || 'font-semibold'">
                <a x-bind:href="notification.url">
                    <p x-text="notification.text"></p>
                    <p x-text="`${timeSince(new Date(notification.created_at))} ago`" class="mt-1 text-gray-600"></p>
                </a>

                <a @click.prevent="checkNotification(notification)" class="mx-2 cursor-pointer"
                    :class="notification.checked ? 'text-gray-400 pointer-events-none' : 'text-gray-600 hover:text-blue-500'">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </template>

    @isset($showLoadMoreButton)
        <button @click="loadNotifications" x-show="hasNotificationsLeft"
            class="flex mx-auto mt-5 bg-gray-500 text-center text-white px-4 py-1 hover:bg-gray-600 cursor-pointer">
            Load more
        </button>

        <div x-show="!hasNotificationsLeft" class="bg-yellow-100 text-center text-sm py-2 mb-10">
            No more notifications available.
        </div>
    @endisset
</div>
