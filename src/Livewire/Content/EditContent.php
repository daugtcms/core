<?php

namespace Daugt\Livewire\Content;

use Daugt\Enums\Content\ContentGroup;
use Daugt\Helpers\Media\MediaHelper;
use Daugt\Misc\ContentTypeRegistry;
use Daugt\Misc\ThemeRegistry;
use Daugt\Models\Blocks\BlockDefaults;
use Daugt\Models\Content\Content;
use Daugt\Models\Content\Notification;
use Daugt\Models\Content\NotificationSetting;
use Daugt\Models\Listing\ListingItem;
use Daugt\Models\User;
use Daugt\Notifications\Content\ContentUpdated;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class EditContent extends \Livewire\Component
{
    public Content $content;

    public string $title = '';
    public string $type = 'page';
    public string $template = '';
    public ?array $blocks;

    public array $contentAttributes = [];
    public string $currentTab = 'content';

    public function mount($content = null)
    {
        if ($content) {
            $this->content = $content;
            $this->title = $this->content->title;
            $this->type = $this->content->type ?? ContentTypeRegistry::getContentTypes()[0];
            $this->template = $this->content->template ?: array_key_first(ThemeRegistry::getThemeTemplatesByUsage($this->type));
            $this->contentAttributes = $this->content->attributes ?? [];
            $this->blocks = $this->content->blocks;
        }
    }

    #[Layout('daugt::components.layouts.admin')]
    public function render()
    {
        return view('daugt::livewire.content.edit-content');
    }

    public function delete() {
        $this->content->delete();
        return redirect()->route('daugt.admin.content.index');
    }

    public function setTab($tab) {
        $this->currentTab = $tab;
    }

    public function save() {
        $this->validate([
            'title' => 'nullable',
            'type' => 'required',
            'template' => 'required'
        ]);

        if (isset($this->content)) {
            $this->content->update([
                'title' => $this->title,
                'type' => $this->type,
                'template' => $this->template,
                'attributes' => $this->contentAttributes,
                'user_id' => Auth::id(),
                'blocks' => $this->blocks,
            ]);
        } else {
            Content::create([
                'title' => $this->title,
                'type' => $this->type,
                'template' => $this->template,
                'attributes' => $this->contentAttributes,
                'blocks' => $this->blocks,
                'user_id' => Auth::id(),
                'published_at' => now(),
            ]);
        }

        return redirect()->route('daugt.admin.content.index');
    }

    public function sendNotification() {
        if(!$this->content->exists()) {
            return;
        }
        if(ContentTypeRegistry::getContentType($this->type)->group == ContentGroup::EMAIL) {
            // TODO: Implement newsletter logic
        } else {
            $listings = ListingItem::whereIn('id', $this->contentAttributes['courseSections'])->get()->map(function ($courseSection) {
                return $courseSection->listing_id;
            });

            $user_ids = NotificationSetting::whereIn('notifiable_id', $listings)->where('notifiable_type', 'listing')->get()->map(function ($notificationSetting) {
                return $notificationSetting->user_id;
            })->unique();

            $users = User::whereIn('id', $user_ids)->get();

            $contentType = ContentTypeRegistry::getContentType($this->type);
            $users = $users->filter(fn ($user) => $contentType->isAccessible($this->content, $user));

            $image = MediaHelper::getMediaById($this->contentAttributes['image'][0]['id'], $this->contentAttributes['image'][0]['variant']) ?? null;

            $title = 'Posting - ' . $this->content->title;

            // whether the notification should be an update or a new content notification
            $updated = Notification::where('notifiable_id', $this->content->id)->where('notifiable_type', $this->content->getMorphClass())->exists();

            $emailNotification = new ContentUpdated($this->content, $title, $image, $this->content->getUrl(), $updated);

            $users->each(fn ($user) => $user->notify($emailNotification) );

            // also send the notification to the current user
            Auth::user()->notify($emailNotification);

            Notification::create([
                'notifiable_id' => $this->content->id,
                'notifiable_type' => $this->content->getMorphClass(),
                'title' => $title,
                'recipients_count' => $users->count(),
                'preview' => $emailNotification->toMail(Auth::user())->render(),
            ]);
        }
    }
}
