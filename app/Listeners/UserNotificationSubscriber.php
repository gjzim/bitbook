<?php

namespace App\Listeners;

use App\Events\AcceptedFriendRequest;
use App\Events\CommentedOnPost;
use App\Events\LikedPost;
use App\Events\SentFriendRequest;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserNotificationSubscriber
{
    /**
     * Handle a SentFriendRequest event.
     *
     * @return void
     */
    public function handleSentFriendRequest(SentFriendRequest $event)
    {
        $notification = new Notification([
            'type' => 'action',
            'text' => "{$event->sender->name} sent a friend request to you.",
            'url' => route('users.show', ['user' => $event->sender], false),
            'image_url' => $event->sender->getAvatarUrl('small')
        ]);

        $event->receiver->notifications()->save($notification);
    }

    /**
     * Handle a AcceptedFriendRequest event.
     *
     * @return void
     */
    public function handleAcceptedFriendRequest(AcceptedFriendRequest $event)
    {
        $notification = new Notification([
            'type' => 'action',
            'text' => "{$event->receiver->name} accepted your friend request.",
            'url' => route('users.show', ['user' => $event->receiver], false),
            'image_url' => $event->receiver->getAvatarUrl('small')
        ]);

        $event->sender->notifications()->save($notification);
    }

    /**
     * Handle a LikedPost event.
     *
     * @return void
     */
    public function handleLikedPost(LikedPost $event)
    {
        if ($event->actor->id === $event->post->author->id) {
            return;
        }

        $notification = new Notification([
            'type' => 'action',
            'text' => "{$event->actor->name} liked your post.",
            'url' => route('posts.show', ['post' => $event->post], false),
            'image_url' => $event->actor->getAvatarUrl('small')
        ]);

        $event->post->author->notifications()->save($notification);
    }

    /**
     * Handle a LikedPost event.
     *
     * @return void
     */
    public function handleCommentedOnPost(CommentedOnPost $event)
    {
        $this->notifyPostAuthorOnNewComment($event);
        $this->notifyOtherCommentersOnNewComment($event);
    }

    /**
     * Notify the post author on new comment.
     *
     * @return void
     */
    private function notifyPostAuthorOnNewComment($event)
    {
        if ($event->actor->id === $event->post->author->id) {
            return;
        }

        $notification = new Notification([
            'type' => 'action',
            'text' => "{$event->actor->name} commented your post.",
            'url' => route('posts.show', ['post' => $event->post], false),
            'image_url' => $event->actor->getAvatarUrl('small')
        ]);

        $event->post->author->notifications()->save($notification);
    }

    /**
     * Notify the other commenters of a post on new comment.
     *
     * @return void
     */
    private function notifyOtherCommentersOnNewComment($event)
    {
        $commenters = $event->post->commenters()
            ->filter(fn ($user) => $user->id !== $event->post->author->id);

        foreach ($commenters as $commenter) {
            $notification = new Notification([
                'type' => 'action',
                'text' => "{$event->actor->name} commented {$event->post->author->name}'s post.",
                'url' => route('posts.show', ['post' => $event->post], false),
                'image_url' => $event->actor->getAvatarUrl('small')
            ]);

            $commenter->notifications()->save($notification);
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        return [
            SentFriendRequest::class => 'handleSentFriendRequest',
            AcceptedFriendRequest::class => 'handleAcceptedFriendRequest',
            LikedPost::class => 'handleLikedPost',
            CommentedOnPost::class => 'handleCommentedOnPost',
        ];
    }
}
